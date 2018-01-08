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
        $term = $request->input('term');
        $includedTags = $request->input('positive_tags');
        $excludedTags = $request->input('negative_tags');

        $query = Image::title($term);

        if ($includedTags) {
            $query = $query->hasTags($includedTags);
        }

        $data = $query->paginate(2);
        return ImageResource::collection($data);
    }
}
