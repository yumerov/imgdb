<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function tags(Request $request) {
        $data = Tag::where('name', 'like', '%' . $request->input('term') . '%')
            ->get();
        return TagResource::collection($data);
    }
}
