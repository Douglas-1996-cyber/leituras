<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores'; 
    protected $fillable = ['nome'];
    use HasFactory;

    public function livros(){
        return $this->belongsToMany('App\Models\Livro', 'autorias', 'autor_id', 'livro_id')->withPivot('id');
    }
}
