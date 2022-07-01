<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//fornecedors
//fornecedores

class Fornecedor extends Model
{
    //
    use SoftDeletes;

    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'telefone', 'email'];

    public function produtos() {

        return $this->hasmany('App\Produto', 'fornecedor_id', 'id');

    }
}
