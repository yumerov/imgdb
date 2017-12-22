<?php

namespace App\Actions\Tags;

use App\Tag;
use App\Http\Requests\TagUpdateRequest;


class Update {

    public function handle(TagUpdateRequest $request, Tag $tag) {
        $tag->update($request->only("name"));

        return redirect()->route("tags.edit", [$tag])
            ->with("success", "The tag is updated.");
    }
}