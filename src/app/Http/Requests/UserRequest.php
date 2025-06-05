<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:200',
            ],
            'email' => [
                'bail',
                'required',
                'string',
                'email',
                'max:200',
                'unique:users,email' . ($this->user ? ',' . $this->user->id : ''),
            ],
            'password' => [
                'bail',
                $this->isMethod('post') ? 'required' : 'nullable',
                'string',
                'max:200',
            ],
            'role' => [
                'required',
                'string',
                'exists:roles,name',
            ],
        ];
    }
}
