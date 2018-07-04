<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Builder;

/**
 * Class Image
 *
 * @package App
 */
class Image extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'file'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @param $value
     */
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return string
     */
    public function getUrlAttribute() {
        return asset("/img/" . $this->file);
    }

    /**
     * @param Builder $query
     * @param $title
     * @return Builder
     */
    public function scopeTitle(Builder $query, $title) {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    /**
     * @param Builder $query
     * @param array $tags
     * @return Builder
     */
    public function scopeHasTags(Builder $query, array $tags) {
        return $query->whereHas('tags', function($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        });
    }

    /**
     * @param Builder $query
     * @param array $tags
     * @return Builder
     */
    public function scopeNotHasTags(Builder $query, array $tags) {
        return $query->whereDoesntHave('tags', function($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        });
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function relatedImages($limit = 99)
    {
        $tags = $this->tags()->select(['tags.id'])->get()->pluck('id')->toArray();

        return static::whereHas('tags', function($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        })->where('id', '!=', $this->id)->get()->shuffle()->take($limit);
    }
}
