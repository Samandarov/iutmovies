<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['series_id', 'movie_id', 'body'];
    // Table name
    protected $table = "comments";
    // Primary key
    public $primaryKey = "id";
    // Timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }

    public function series()
    {
        return $this->belongsTo('App\Series');
    }
}
