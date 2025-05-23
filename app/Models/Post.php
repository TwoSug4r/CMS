<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Post extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\PostPresenter';
    
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'excerpt',
        'published_at',
    ];

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}
