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
    return redirect()->route('login');
});

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', function(){
    if(auth()->check()){
        auth()->logout();
    }
    return redirect('/');
})->name('logout');
Route::get('/test',function(){
    \App\Helpers\Helper2::is_date_active_of_lesson(\App\Lesson::find(70));
});
Route::get('/page/{page:name}', [\App\Http\Controllers\Site\PageController::class,'index'])->name('show_page');