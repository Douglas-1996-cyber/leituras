<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = ['genero_id','user_id','titulo','capa','num_pags','num_pags_lidos','lido','iniciado','dt_inicial','dt_final'];
    use HasFactory;

    public function autores(){
        return $this->belongsToMany('App\Models\Autor', 'autorias', 'livro_id', 'autor_id')->withPivot('id');
    }
    public function genero(){
        return $this->belongsTo('App\Models\Genero');
    }

    public function rules(){
        return [
           'capa' => 'file|mimes:png,jpg'
       ];
       }
   
       public function feedback(){
           return [
               'capa.file' => 'A imagem precisa ser um arquivo',
               'capa.mimes' => 'O arquivo deve ser no formato PNG ou JPG'
           ];
       }
}
