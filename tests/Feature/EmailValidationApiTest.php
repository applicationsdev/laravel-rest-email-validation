<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailValidationApiTest extends TestCase
{
    // Data for testing
    protected $emailExample = [
        'doesNotExist' => 'testrandomtest@randomtest.com',
        'existsButNotValid' => 'DLRHuUS4sDpeXn1uAE',
        'existsAndValid' => 'mackenzie.block@abshire.com',
    ];
    
    public function testDoesNotExist()
    {
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/validate/email/' . $this->emailExample['doesNotExist']);
        
        $response->assertStatus(404);
    }
    
    public function testExistsButNotValid()
    {
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/validate/email/' . $this->emailExample['existsButNotValid']);
        
        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment([
                'email' => $this->emailExample['existsButNotValid'],
                'is_valid' => false,
            ]);
    }
    
    public function testExistsAndValid()
    {
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', 'api/validate/email/' . $this->emailExample['existsAndValid']);
        
        $response
            ->assertStatus(200)
            ->assertHeader('content-type', 'application/json')
            ->assertJsonFragment([
                'email' => $this->emailExample['existsAndValid'],
                'is_valid' => true,
            ]);
    }
}
