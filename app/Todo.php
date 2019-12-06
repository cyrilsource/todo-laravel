<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['name', 'category_id', 'check'];

    //fonction pour lier les Todos aux catégories
    public function categorie() {

    	return $this->belongsTo('App\Categorie');
    }
}
