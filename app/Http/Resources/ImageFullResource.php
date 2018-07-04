<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ImageFullResource
 *
 * @package App\Http\Resources
 */
class ImageFullResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $simple = (new ImageSimpleResource($this))->toArray($request);
        $additional = [
            "tags" => $this->tags->map(function ($tag) {
                return ['id' => $tag->id, 'name' => $tag->name];
            })->toArray(),
            "related_images" => ImageSimpleResource::collection(
                $this->relatedImages()
            ),
        ];
        return array_merge($simple, $additional);
    }
}
