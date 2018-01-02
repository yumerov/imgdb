<?php

namespace App\Http\Controllers\Api;


use App\Tag;
use App\Image;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;

class RecentController extends Controller
{
    public function images() {
        return ImageResource::collection(Image::orderBy('created_at', 'desc')->take(12)->get());
    }

    public function tags() {
        return TagResource::collection(Tag::orderBy('created_at', 'desc')->take(30)->get());
    }
}
