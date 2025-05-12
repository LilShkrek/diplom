<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacilityRequest extends FormRequest
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
            'buy_date' => [
                'bail',
                'required',
                'date',
                'before_or_equal:operation_end_date',
            ],
            'operation_end_date' => [
                'bail',
                'required',
                'date',
                'after_or_equal:buy_date',
            ],
            'inventory_num' => [
                'bail',
                'required',
                'integer',
            ],
            'employee_id' => 'nullable|exists:employees,id',
        ];
    }

    public function attributes(): array
    {
        return [
            ...parent::attributes(),
            'name' => 'Название оборудования',
            'buy_date' => 'Дата покупки оборудования',
            'operation_end_date' => 'Дата примерного окончания срока службы оборудования',
            'inventory_num' => 'Инвентарный номер',
        ];
    }
}
