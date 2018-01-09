<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;

class Image extends Model
{
    protected $fillable = ['title', 'file'];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getUrlAttribute() {
        return asset("/img/" . $this->file);
    }

    public function scopeTitle(Builder $query, $title) {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    public function scopeHasTags(Builder $query, array $tags) {
        return $query->whereHas('tags', function($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        });
    }

    public function scopeNotHasTags(Builder $query, array $tags) {
        return $query->whereDoesntHave('tags', function($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        });
    }

    public function relatedImages($limit = 99)
    {
        $tags = $this->tags()->select(['tags.id'])->get()->pluck('id')->toArray();

        return static::whereHas('tags', function($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        })->where('id', '!=', $this->id)->get()->shuffle()->take($limit);
    }
}
