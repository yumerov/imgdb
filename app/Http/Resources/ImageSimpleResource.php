<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ImageSimpleResource
 *
 * @package App\Http\Resources
 */
class ImageSimpleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'file' => $this->url,
            "self" => route("images.show", $this->slug),
        ];
    }
}
