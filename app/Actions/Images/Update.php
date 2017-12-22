<?php

namespace App\Actions\Images;

use App\Image;
use App\Http\Requests\ImageUpdateRequest;


class Update {

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

        return redirect()->route("images.edit", [$image])
            ->with("success", "The image is updated.");
    }
}