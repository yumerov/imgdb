<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\Image;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function tags(Request $request) {
        $data = Tag::where('name', 'like', '%' . $request->input('term') . '%')
            ->get();
        return TagResource::collection($data);
    }

    public function images(Request $request) {
        $data = Image::where('title', 'like', '%' . $request->input('term') . '%')
            ->paginate(2);
        return ImageResource::collection($data);
    }
}
