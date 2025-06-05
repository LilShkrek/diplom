<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:200'
            ],
            'surname' => [
                'bail',
                'required',
                'string',
                'max:200'
            ],
            'patronymic' => [
                'bail',
                'required',
                'string',
                'max:200'
            ],
            'position' => [
                'bail',
                'required',
                'string',
                'max:200'
            ],
            'service_number' => [
                'bail',
                'required',
                'integer',
            ],
        ];
    }

//    public function messages(): array         TODO:: Посмотреть, мб импакто использовать

    public function attributes(): array
    {
        return [
            ...parent::attributes(),
            'name' => 'Имя сотрудника',
            'surname' => 'Фамилия сотрудника',
            'patronymic' => 'Отчество сотрудника',
            'position' => 'Должность сотрудника',
            'service_number' => 'Табельный номер сотрудника'
        ];
    }
}
