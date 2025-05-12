<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LicenceRequest extends FormRequest
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
            'buy_date' => [
                'bail',
                'required',
                'date',
                'before_or_equal:start_date',
            ],
            'start_date' => [
                'bail',
                'required',
                'date',
                'before:end_date',
            ],
            'end_date' => [
                'bail',
                'required',
                'date',
                'after:start_date',
            ],
            'key' => [
                'bail',
                'required',
                'string',
                'max:200',
            ],
            'facility_id' => 'nullable|exists:facilities,id',
        ];
    }

    public function attributes(): array
    {
        return [
            ...parent::attributes(),
            'name' => 'Название лицензии',
            'buy_date' => 'Дата покупки лицензии',
            'start_date' => 'Дата начала срока лицензии',
            'end_date' => 'Дата окончания срока лицензии',
            'key' => 'Ключ лицензии',
        ];
    }
}
