<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name'        => 'required|string|min:5|unique:projects,name',
            'description' => 'required|string|min:10',
            'valorbruto' => 'required',
            'tiempo' => 'required',
            'status'      => 'required',
            'iva'      => 'required',
            'retfuente'      => 'required',
            'ica'      => 'required',
            'retiva'      => 'required',
            'estampillas'      => 'required',
            'cree'      => 'required',
            'ica_t'      => 'required',
            'retica'      => 'required',
            'comisionreferido'      => 'required',
            'imprevistos'      => 'required',
            'apalancamiento'      => 'required',
            'obligafinancieras'      => 'required',
            'rse'      => 'required',
            'nominafija'      => 'required',
            'contratistalattitude'      => 'required',
            'arqejecutivofirma'      => 'required',
            //'marcalattitude'      => 'required',
            'tecnologia'      => 'required',
            'serviciospublicos'      => 'required',
            'recursoshumanos'      => 'required',
            'pryviaticos'      => 'required',
            'comunicaciones'      => 'required',

   
    
        ];
    }

    public function attributes()
    {
        return [
            'name'  => 'Nombre',
            'description' => 'Descripción',
            'valorbruto' => 'VALOR BRUTO $',
            'tiempo' => 'Tiempo',
            'status'  => 'estado',
            'iva'  => '%',
            'retfuente'      => '%',
            'ica'      => '%',
            'retiva'      => '%',
            'estampillas'      => '%',
            'cree'      => '%',
            'ica_t'      => '%',
            'retica'      => '%',
            'comisionreferido'      => '%',
            'imprevistos'      => '%',
            'apalancamiento'      => '%',
            'obligafinancieras'      => '%',
            'rse'      => '%',
            'nominafija'      => '%',
            'contratistalattitude'      => '%',
            'arqejecutivofirma'      => '%',
            //'marcalattitude'      => '%',
            'tecnologia'      => '%',
            'serviciospublicos'      => '%',
            'recursoshumanos'      => '%',
            'pryviaticos'      => '%',
            'comunicaciones'      => '%',
        
        ];
    }
}
