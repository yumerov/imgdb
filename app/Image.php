<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title', 'file'];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
