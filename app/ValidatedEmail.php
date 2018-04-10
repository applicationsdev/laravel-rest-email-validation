<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidatedEmail extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'email', 'validated_timestamp',
    ];
}
