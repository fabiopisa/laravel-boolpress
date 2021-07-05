<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id' // aggiungo questa voce qui
    ];

    public function category(){
        //post appartiene a category scritto così
        return $this->belongsTo('App\Category');
    }
}
