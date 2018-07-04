<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Home\Index;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view("index");
    }
}
