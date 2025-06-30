<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function showIndex() {
        return view("index.index");
    }

    public function showAbout() {
        return view("index.about");
    }
}
