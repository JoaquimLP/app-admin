<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateEmpresaRequest extends FormRequest
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
        $id = $this->segment(3);

        return [
            'tipo'  => ["required", Rule::in(['cliente', 'fornecedor']),],
            'nome' => "required|max:150|min:3|unique:empresas,nome,{$id},id",
            'razao_social' => "nullable|max:100|min:3|unique:empresas,razao_social,{$id},id",
            'documento' => $this->validateDocumento(),
            'ie_rg' => "required|max:18|min:8|unique:empresas,ie_rg,{$id},id",
            'nome_contato' => "required|max:150|min:3",
            'celular' => "required|size:11",
            'telfone'  => "nullable|size:10",
            'email' => "required|max:150|min:12|unique:empresas,email,{$id},id",
            'endereco' => "required",
            'bairro' => "required|max:50|min:3",
            'cidade' => "required|max:50|min:3",
            'estado' => "required|size:2",
            'cep'  => "required",
            'numero'   => "required",
            'complemento'   => "nullable",
            'observacao'  => "nullable",
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
        $data['documento'] = str_replace(['.', '/', '-'], '', $data['documento']);
        $data['telefone'] = str_replace(['(', ')', ' ', '-'], '', $data['telefone']);
        $data['celular'] = str_replace(['(', ')', ' ', '-'], '', $data['celular']);
        $data['cep'] = str_replace('-', '', $data['cep']);

        $this->replace($data);
        return $data;
    }

    public function validateDocumento()
    {
        if (strlen($this->documento) == 11) {
            return ['required', 'cpf'];
        }else{
            return ['required', 'cnpj'];
        }
    }

    public function messages() {

        if (strlen($this->documento) == 11) {
            return ['documento.cpf' => 'O campo cpf não é válido!'];
        }else{
            return ['documento.cnpj' => 'O campo cnpj não é válido!'];
        }
    }
}
