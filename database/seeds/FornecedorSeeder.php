<?php

use Illuminate\Database\Seeder;
use App\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //instanciando o objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 1';
        $fornecedor->telefone = '(77) 3421-0001';
        $fornecedor->email = 'contato@fornecedor1.com.br';
        $fornecedor->save();

        //o método create (atenção para o atributo fillable da classe)
        Fornecedor::create([
            'nome' => 'Fornecedor 2',
            'telefone' => '(77) 3422-0002',
            'email' => 'contato@fornecedor2.com.br'
        ]);

        //insert
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 3',
            'telefone' => '(77) 3423-0003',
            'email' => 'contato@fornecedor3.com.br'
        ]);
    }
}
