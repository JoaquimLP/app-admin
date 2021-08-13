<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateFinanceiroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descricao' => "required|max:150|min:3",
            'preco' => "required",
            'data_pagamento' => "required|date",
            'empresa_id' => "required|numeric",
            'tipo'  => ["required", Rule::in(['E', 'S']),],
        ];
    }

        /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        $data = $this->all();
        $data['data_pagamento'] = formatDateAndTimeIso($data['data_pagamento']);
        $data['preco'] = str_replace(['.', ','], ['', '.'], $data['preco']);

        $this->replace($data);
        return $data;
    }
}
