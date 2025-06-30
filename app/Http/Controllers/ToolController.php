<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    //
    public function showIndex() {
        return view("frontend.index");
    }

    public function showCreateTest() {
        return view("listings.createTest");
    }
}
