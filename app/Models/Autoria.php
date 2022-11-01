<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autoria extends Model
{
    protected $fillable = ['autor_id','livro_id'];
    use HasFactory;
}
