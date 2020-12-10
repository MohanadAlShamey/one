<?php


//Route::get('/home/{id?}','HomeController@index')->name('student.home');

Route::get('/home/{id?}',[
    'uses'=>'HomeController@index',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.home');


Route::get('/{video}/getViedio',[
    'uses'=>'VideoController@visit',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.lesson.getVideo');

Route::get('/{example}/completeExample',[
    'uses'=>'ExampleController@index',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.example.complete');


Route::get('lessons/{lesson}/getVideos',[
    'uses'=>'LessonController@getVideos',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.lessons.getVideos');

//Route::get('/{video}/getViedio','VideoController@visit')->name('student.lesson.getVideo');
//Route::get('/{example}/completeExample','ExampleController@index')->name('student.example.complete');
//Route::post('/{example}/storeExample','ExampleController@store')->name('student.example.complete.store');
Route::post('/{example}/storeExample',[
    'uses'=>'ExampleController@store',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.example.complete.store');

Route::get('jokers/{joker}/pick',[
    'uses'=>'JokerController@pick',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.joker.pick');

Route::get('jokers/getAll',[
    'uses'=>'JokerController@getAll',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.joker.getAll');

Route::get('test',[
    'uses'=>'HomeController@test',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.test');

Route::post('session',[
    'uses'=>'HomeController@resive_session',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('student.resive.session');


Route::get('projects',[
    'uses'=>'ProjectController@index',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('project.index');

Route::get('projects/getAllProject',[
    'uses'=>'ProjectController@getAllProject',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('project.getAllProject');

Route::post('projects/store',[
    'uses'=>'ProjectController@store',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('project.store');

Route::post('projects/{project}/update',[
    'uses'=>'ProjectController@update',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('project.update');

Route::delete('projects/{project}/delete',[
    'uses'=>'ProjectController@destroy',
    'middleware'=>'roles',
    'roles'=>['student']
])->name('project.delete');

Route::get('/pages/',[\App\Http\Controllers\Student\PageController::class,'index'])->name('dashboard.pages');
Route::get('/pages/getAllPage',[\App\Http\Controllers\Student\PageController::class,'getAllPage'])->name('dashboard.pages.getAllPage');
Route::get('/pages/create',[\App\Http\Controllers\Student\PageController::class,'create'])->name('dashboard.pages.create');
Route::post('/pages/store',[\App\Http\Controllers\Student\PageController::class,'store'])->name('dashboard.pages.store');
Route::get('/pages/{page}/edit',[\App\Http\Controllers\Student\PageController::class,'edit'])->name('dashboard.pages.edit');
Route::post('/pages/{page}/update',[\App\Http\Controllers\Student\PageController::class,'update'])->name('dashboard.pages.update');
Route::delete('/pages/{page}/delete',[\App\Http\Controllers\Student\PageController::class,'delete'])->name('dashboard.pages.delete');


Route::get('/pages/homePage',[\App\Http\Controllers\Student\HomePageController::class,'index'])->name('dashboard.pages.home_page');
Route::get('/pages/homePage/create',[\App\Http\Controllers\Student\HomePageController::class,'create'])->name('dashboard.pages.home_page.create');
Route::post('/pages/homePage/store',[\App\Http\Controllers\Student\HomePageController::class,'store'])->name('dashboard.pages.home_page.store');
Route::get('/pages/homePage/getAllPage',[\App\Http\Controllers\Student\HomePageController::class,'getAllPage'])->name('dashboard.pages.home_page.getAllPage');
Route::get('/pages/homePage/{page}/edit',[\App\Http\Controllers\Student\HomePageController::class,'edit'])->name('dashboard.pages.home_page.edit');
Route::post('/pages/homePage/{page}/update',[\App\Http\Controllers\Student\HomePageController::class,'update'])->name('dashboard.pages.home_page.update');
