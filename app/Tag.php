<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @package App
 */
class Tag extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @param $value
     */
    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images() {
        return $this->belongsToMany(Image::class);
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
