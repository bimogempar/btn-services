<?php

namespace App\Http\Requests;

use App\Traits\BuildResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RequestRegister extends FormRequest
{
    use BuildResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->all();
        $message = implode(' ', $message);
        throw new ValidationException($validator, $this->buildResponse(99, $message), 400);
    }
}
