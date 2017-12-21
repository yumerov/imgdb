<?php

namespace App\Actions\Tags;

use App\Tag;
use App\Http\Requests\TagStoreRequest;

use Illuminate\Http\Request;

class Store {

    public function handle(TagStoreRequest $request) {
        dd($request->all());
    }
}