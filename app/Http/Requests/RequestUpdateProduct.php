<?php

namespace App\Http\Requests;

use App\Traits\BuildResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RequestUpdateProduct extends FormRequest
{
    use BuildResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_product' => 'required',
            'name' => 'required|string',
            'description' => '',
            'image' => '',
            'stock' => '',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->all();
        $message = implode(' ', $message);
        throw new ValidationException($validator, $this->buildResponse(99, $message), 400);
    }
}
