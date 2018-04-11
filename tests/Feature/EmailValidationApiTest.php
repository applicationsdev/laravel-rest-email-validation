<?php

/**
 * RESTful API TESTING example for Development Environment
 * by @applicationsdev
 * https://github.com/applicationsdev
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailValidationApiTest extends TestCase
{
    /**
     * # DATA GENERATORS definition
     */
    
    // Creates one unique email & stores it in DB
    // note: unless we pass TRUE as argument, any other value will generate invalid email
    protected function createOneUniqueEmailRecord($validEmail) {
        
        // Ensures that one unique email is generated
        do {
            if ($validEmail === true) {
                $oneUniqueEmail = $this->generateValidEmail();
                
            } else {
                $oneUniqueEmail = $this->generateInvalidEmail();
            }
            
        } while ($record = DB::table('validated_emails')
            ->where('email', '=', $oneUniqueEmail)->first());
            
        // Stores generated email into DB, so that it can be accessed later via REST API
        DB::table('validated_emails')->insert([
            'email' => $oneUniqueEmail,
        ]);
        
        return $oneUniqueEmail;
    }
    
    // Simple & useful data generation helpers
    public function generateValidEmail() {
        return str_random(16) . '@' . str_random(10) . '.com';
    }

    public function generateInvalidEmail() {
        return '@invalid-structure-or-script-injection-attempt.' . str_random(8);
    }
    
    public function generateNonExistantEmail() {
        return str_random(50) . '@' . str_random(15) . '.com';
        // making this function more secure is unnecessary complexity for current version
    }
    
    
    /**
     * # API TESTS definition
     */
    
    // Simulate & test API's behavior to non-existant email
    public function testDoesNotExist()
    {
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/validate/email/' . $this->generateNonExistantEmail());
        
        $response->assertStatus(404);
    }
    
    // Simulate & test API's behavior to existant invalid email
    public function testExistsButNotValid()
    {
        $generatedData = $this->createOneUniqueEmailRecord(false);
        
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/validate/email/' . $generatedData);
        
        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment([
                'email' => $generatedData,
                'is_valid' => false,
            ]);
    }
    
    // Simulate & test API's behavior to existant valid email
    public function testExistsAndValid()
    {
        $generatedData = $this->createOneUniqueEmailRecord(true);
        
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/validate/email/' . $generatedData);
        
        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment([
                'email' => $generatedData,
                'is_valid' => true,
            ]);
    }
}
