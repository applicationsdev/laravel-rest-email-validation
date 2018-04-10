<?php

use Illuminate\Http\Request;

Route::resource('validate/email', 'ValidatedEmailController', ['only' => 'show']);
