<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function images() {
        return $this->belongsToMany(Image::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
