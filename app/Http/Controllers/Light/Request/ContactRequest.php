<?php

namespace App\Http\Controllers\Light\Request;


use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    public function rules() {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'message' => 'required|string|max:255'
        ];
    }
}
