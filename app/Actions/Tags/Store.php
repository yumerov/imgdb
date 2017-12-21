<?php

namespace App\Actions\Tags;

use App\Tag;
use App\Http\Requests\TagStoreRequest;

use Illuminate\Http\Request;

class Store {

    public function handle(TagStoreRequest $request) {
        Tag::create($request->only("name"));

        return back()->with("success", "The tag is created.");
    }
}