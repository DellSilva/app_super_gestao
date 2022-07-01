<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index() {
        
        return view('app.fornecedor.index');
    }

    public function listar(Request $request) {

        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->paginate(30);         

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all() ]);
    }

    public function adicionar(Request $request) {

        $msg = '';

        if($request->input('_token') != '' && $request->input('id') == '') {
            //validação
            $regras = [
                'nome' => 'required|min:3|max:40',                
                'telefone' => 'required|numeric',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O Campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',                
                'telefone.numeric' => 'Apenas números',               
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso!';
        }

        if($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update) {
                $msg = 'Atualizado com sucesso';
            }else {
                $msg = 'Não Atualizado';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '') {
        
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id) {
        
        Fornecedor::find($id)->delete();
        Fornecedor::find($id)->forceDelete();

        return redirect()->route('app.fornecedor');
    }

}
