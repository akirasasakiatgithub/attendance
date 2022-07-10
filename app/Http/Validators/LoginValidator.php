<?php

namespace App\Http\Validators;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class LoginValidator extends Validator
{
  public function validateHello($attribute, $value, $parameters)
  {
    return Auth::user()->email === $value;
  }
}