<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'libros';
    //protected $primaryKey = 'id';
    public $ISBN;
    public $editoriales_id;  
    public $titulo;
    public $sinopsis;  
    public $n_paginas;  
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ISBN',
        'editoriales_id',
        'titulo',
        'sinopsis',
        'n_paginas'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function editorial()
    {
        return $this->hasOne('App\Models\Editorial','id');
    }
    /*public function autor()
    {
        return $this->belongsToMany('App\Models\Autor','autores_has_libros','autores_id','autores_id');        
        
    }*/
}
