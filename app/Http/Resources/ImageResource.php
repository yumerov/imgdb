<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ImageResource extends Resource
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
            "tags" => $this->tags->map(function ($tag) {
                return ['id' => $tag->id, 'name' => $tag->name];
            })->toArray(),
        ];
    }
}
