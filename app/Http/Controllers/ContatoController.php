<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request) {

        //realizar a validação dos dados do formulário recebidos no request
        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];

        $feedback = [
            'nome.required' => 'Este campo precisa ser preenchido',
            'email.email' => 'O e-mail informado não é válido',
            'motivo_contatos_id.required' => 'Este campo precisa ser selecionado',
            'required' => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);
        
        SiteContato::create($request->all());

        return redirect()->route('site.index');

        
    }
}
