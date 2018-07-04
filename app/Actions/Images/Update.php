<?php

namespace App\Actions\Images;

use App\Image;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\ImageFullResource;

/**
 * Class Update
 *
 * @package App\Actions\Images
 */
class Update {

    /**
     * @param ImageUpdateRequest $request
     * @param Image $image
     * @return ImageFullResource
     */
    public function handle(ImageUpdateRequest $request, Image $image) {
        $file = $request->file('file');

        if ($file) {
            \File::delete(public_path("/img/" . $image->file));
            $image->update([
                'title' => $request->input('title'),
                'file' => md5(microtime()) . '.' . $file->clientExtension(),
            ]);
            $file->move(public_path('/img/'), $image->file);
        } else {
            $image->update($request->only('title'));
        }
        $image->tags()->sync($request->input("tags"));

        return new ImageFullResource($image);
    }
}