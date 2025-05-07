<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'url',
        'content'
    ];

    public function users(){
        return $this->belongsTo('\App\Models\User');
    }
}
