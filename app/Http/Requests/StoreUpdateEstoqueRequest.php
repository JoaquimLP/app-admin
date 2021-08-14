<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEstoqueRequest extends FormRequest
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
            'qtd' => "required",
            'valor' => "required",
            'produto_id' => "required|numeric",
            //'tipo'  => ["required", Rule::in(['E', 'S'])],
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
        $data['qtd'] = str_replace(['.', ','], ['', '.'], $data['qtd']);
        $data['valor'] = str_replace(['.', ','], ['', '.'], $data['valor']);

        $this->replace($data);
        return $data;
    }
}
