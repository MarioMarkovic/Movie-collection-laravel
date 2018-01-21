<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
    	'title', 'genre_id', 'year', 'duration', 'image'
    ];

    public function genre()
    {
    	return $this->belongsTo(Genre::class);
    }
}
