<?php

namespace App\Actions\Images;

use App\Image;

/**
 * Class Destroy
 *
 * @package App\Actions\Images
 */
class Destroy {

    /**
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function handle(Image $image) {
        \File::delete(public_path("/img/" . $image->file));
        $image->delete();

        return response()->json();
    }
}