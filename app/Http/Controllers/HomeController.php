<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Home\Index;

class HomeController extends Controller
{
    public function index() {
        return view("index");
    }
}
