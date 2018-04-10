<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ValidatedEmail;

class ValidatedEmailController extends Controller
{
    // Since value setters are used below, setting value here can be considered redundant
    // but if that property becomes critical, this can be a good security practice
    // for future updates of this unit
    private $validationState = false;
    
    private function setValidationStateTrue() {
        return $this->validationState = true;
    }
    
    private function setValidationStateFalse() {
        return $this->validationState = false;
    }
    
    public function getValidationState() {
        return $this->validationState;
    }
    
    /**
    * Display the specified resource.
    *
    * @param  str  $email
    * @return \Illuminate\Http\Response
    */
    public function show($email)
    {
        
        $this->setValidationStateFalse();
        
        // Check if Email exists
        if (!$validatedEmail = ValidatedEmail::where('email', '=', $email)->first()) {
            
            return response('Email was not found', 404);
            
        } else {
            
            // Check if Email has been already validated during current date
            $lastValidationTimestampArray = explode(' ', $validatedEmail->validated_timestamp);
            
            if ($lastValidationTimestampArray[0] == date('Y-m-d')) {
               
               $this->setValidationStateTrue();
               
               return response()->json([
                    'email' => $validatedEmail->email,
                    'validated_at' => $validatedEmail->validated_timestamp,
                    'is_valid' => $this->getValidationState(),
                ], 200);
            
            // Else validate Email now
            } else {
                
                $this->setValidationStateFalse();
                
                if (!filter_var($validatedEmail->email, FILTER_VALIDATE_EMAIL)) {
                
                    return response()->json([
                        'email' => $validatedEmail->email,
                        'is_valid' => $this->getValidationState(),
                    ]); // when resource is found & HTTP status code is undefined,
                        // then we receive code 200 anyway
                
                } else {
            
                    $validatedEmail->validated_timestamp = date("Y-m-d H:i:s");
                    $validatedEmail->save();
                    
                    $this->setValidationStateTrue();
                    
                    /**
                     * Distributed data - replication feature
                     * 
                     * Example: replicate/distribute validated "clean" data
                     * (assuming that destination DB & tabe exists)
                     * 
                     * use Illuminate\Support\Facades\DB;
                     * 
                     * // Check if data is already replicated
                     * if (!$record = DB::table('dbname.replicated_clean_data')
                     * ->where('email', '=', $validatedEmail->email)->first()) {
                     * 
                     *   // Store new clean data
                     *   DB::table('dbname.replicated_clean_data')->insert([
                     *     'email' => $validatedEmail->email,
                     *     'validated_at' => $validatedEmail->validated_timestamp,
                     *   ]);
                     * }
                     * 
                     */
            
                    return response()->json([
                        'email' => $validatedEmail->email,
                        'validated_at' => $validatedEmail->validated_timestamp,
                        'is_valid' => $this->getValidationState(),
                    ], 200);
                }
            }
        }
    }
}
