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
Route::get('/homePage/{page:name}',[\App\Http\Controllers\Site\PageController::class,'home'])->name('home_page.show');
Route::get('/homePage/{page:name}/policy',[\App\Http\Controllers\Site\PageController::class,'policy'])->name('home_page.policy');
Route::get('/homePage/{page:name}/terms',[\App\Http\Controllers\Site\PageController::class,'terams'])->name('home_page.terams');
Route::get('/homePage/{page:name}/contact',[\App\Http\Controllers\Site\PageController::class,'contact'])->name('home_page.contact');
Route::post('/homePage/{page:name}/contact',[\App\Http\Controllers\Site\PageController::class,'storeContact'])->name('home_page.contact.store');
