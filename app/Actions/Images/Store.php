<?php

namespace App\Actions\Images;

use App\Image;
use App\Http\Requests\ImageStoreRequest;
use App\Http\Resources\ImageFullResource;
use Illuminate\Http\Request;

/**
 * Class Store
 *
 * @package App\Actions\Images
 */
class Store {

    /**
     * @param ImageStoreRequest $request
     * @return ImageFullResource
     */
    public function handle(ImageStoreRequest $request) {
        $file = $request->file('file');
        $image = new Image;
        $image->title = $request->input('title');
        $image->file = md5(microtime()) . '.' . $file->clientExtension();
        $file->move(public_path('/img/'), $image->file);
        $image->save();
        $image->tags()->sync($request->input("tags"));

        return new ImageFullResource($image);
    }
}