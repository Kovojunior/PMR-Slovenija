<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// POZOR! To ti prej ni delalo, ker se je v responsu nahajal tudi komentar izven <?php navednic v web.php in ni znal prebrat JSONa!
// F12->klik na omrežje->200 metoda GET v datoteki posts nam v glavi razkrije, da je content-type application/json
//Route::get('/posts', function() {
//    return response()->json([
//        'posts' => [
//            [
//                'title' => 'Post One'
//            ]
//        ]
//    ]);
//});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
