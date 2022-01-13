<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('dashboard/url/get', ['as' => 'url.list', 'uses' => '\App\Http\Controllers\MainController@getUrl']);
Route::post('dashboard/url/save', ['as' => 'url.add', 'uses' => '\App\Http\Controllers\MainController@save']);
Route::get('{slug}', ['as' => 'url', 'uses' => '\App\Http\Controllers\MainController@getSlugUrl']);