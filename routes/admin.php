<?php

Route::get('/home',[
    'uses'=>'HomeController@index',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.home');

/*
 * Users Route
 * */

Route::get('/users',[
    'uses'=>'UserController@index',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users');

Route::get('/users/index',[
    'uses'=>'UserController@all',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.index');


Route::get('/users/create',[
    'uses'=>'UserController@create',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.create');


Route::post('/users/store',[
    'uses'=>'UserController@store',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.store');

Route::get('/users/{user}/edit',[
    'uses'=>'UserController@edit',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.edit');

Route::get('/users/{user}/getUser',[
    'uses'=>'UserController@getUser',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.getUser');

Route::post('/users/{user}/update',[
    'uses'=>'UserController@update',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.update');

Route::delete('/users/{user}/delete',[
    'uses'=>'UserController@delete',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.delete');

Route::post('/users/{user}/deactive',[
    'uses'=>'UserController@deactive',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.users.deactive');

/*
 * Roles Route
 * */
Route::get('/roles/index',[
    'uses'=>'RoleController@all',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.roles.index');

/*
 * Sections Route
 * */

Route::get('/sections',[
    'uses'=>'SectionController@index',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections');

Route::get('/sections/index',[
    'uses'=>'SectionController@all',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.index');

Route::get('/sections/getAll',[
    'uses'=>'SectionController@getAll',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.getAll');
Route::post('/sections/sort',[
    'uses'=>'SectionController@sort',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.sort');

Route::get('/sections/create',[
    'uses'=>'SectionController@create',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.create');


Route::post('/sections/store',[
    'uses'=>'SectionController@store',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.store');

Route::get('/sections/{section}/edit',[
    'uses'=>'SectionController@edit',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.edit');

Route::get('/sections/{section}/show',[
    'uses'=>'SectionController@show',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.show');

Route::get('/sections/{section}/getShowSection',[
    'uses'=>'SectionController@getShowSection',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.getShowSection');

Route::get('/sections/{section}/getSection',[
    'uses'=>'SectionController@getSection',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.getSection');

Route::post('/sections/{section}/update',[
    'uses'=>'SectionController@update',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.update');

Route::delete('/sections/{section}/delete',[
    'uses'=>'SectionController@delete',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.sections.delete');

/*
 * Lesson Route
 * */

Route::get('/lessons',[
    'uses'=>'LessonController@index',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons');

Route::get('/lessons/index',[
    'uses'=>'LessonController@all',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.index');

Route::get('/lessons/getAll',[
    'uses'=>'LessonController@getAll',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.getAll');
Route::post('/lessons/sort',[
    'uses'=>'LessonController@sort',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.sort');

Route::get('sections/{section}/lessons/create',[
    'uses'=>'LessonController@create',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.create');


Route::post('sections/{section}/lessons/store',[
    'uses'=>'LessonController@store',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.store');

Route::post('/lessons/{lesson}/storeAttach',[
    'uses'=>'LessonController@storeAttach',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.storeAttach');


Route::get('/lessons/{lesson}/edit',[
    'uses'=>'LessonController@edit',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.edit');

Route::get('/lessons/{lesson}/show',[
    'uses'=>'LessonController@show',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.show');

Route::get('/lessons/{lesson}/file',[
    'uses'=>'LessonController@getFile',
    'middleware'=>'roles',
    'roles'=>['admin','student']
])->name('dahsboard.lessons.getFile');

Route::get('/lessons/{lesson}/getLesson',[
    'uses'=>'LessonController@getLesson',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.getLesson');

Route::post('/lessons/{lesson}/update',[
    'uses'=>'LessonController@update',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.update');

Route::delete('/lessons/{lesson}/delete',[
    'uses'=>'LessonController@delete',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.lessons.delete');

/*
 * Videos ROute
 * */
Route::post('/videos/{video}/update',[
    'uses'=>'VideoController@update',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.videos.update');

Route::post('/videos/{lesson}/store',[
    'uses'=>'VideoController@store',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.videos.store');

Route::delete('/videos/{video}/delete',[
    'uses'=>'VideoController@delete',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.videos.delete');


/*
 * Examples ROute
 * */
Route::post('/examples/{example}/update',[
    'uses'=>'ExampleController@update',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.update');

Route::post('/examples/{lesson}/store',[
    'uses'=>'ExampleController@store',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.store');

Route::delete('/examples/{example}/delete',[
    'uses'=>'ExampleController@delete',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.delete');

/*
 * Attach Route
 * */
Route::get('/attaches/{attach}/file',[
    'uses'=>'AttachController@getFile',
    'middleware'=>'roles',
    'roles'=>['admin','student']
])->name('dahsboard.attaches.getFile');

Route::post('/attaches/{attach}/update',[
    'uses'=>'AttachController@update',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.attaches.update');

Route::post('/attaches/{lesson}/store',[
    'uses'=>'AttachController@store',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.attaches.store');

Route::delete('/attaches/{attach}/delete',[
    'uses'=>'AttachController@delete',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.attaches.delete');


/*
 * Notification Route
 * */

Route::get('/getNotify',[
    'uses'=>'NotifyController@getNotify',
    'middleware'=>'roles',
    'roles'=>['admin','student']
])->name('dahsboard.notification.getNotify');

Route::get('/examples/{example}/rate/user/{user}/notyfi/{notify?}',[
    'uses'=>'ExampleController@rateExample',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.rateExample');

Route::get('/examples/{example}/rate/user/{user}',[
    'uses'=>'ExampleController@rateExample',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.rateExample');

Route::get('/examples/{example}/rate/user/{user}/getData',[
    'uses'=>'ExampleController@getData',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.rateExample.getData');


Route::get('/completeExample/{example}/getFile',[
    'uses'=>'ExampleController@getFile',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.completeExample.getFile');

Route::get('/examples/{example}/rate',[
    'uses'=>'ExampleController@rate',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.examples.rateExample.rate');

/*
 * Attach Route
 * */
Route::get('/examples',[
    'uses'=>'ExampleController@index',
    'middleware'=>'roles',
    'roles'=>['admin','student']
])->name('dahsboard.examples.index.all');

Route::get('/examples/{user}/get',[
    'uses'=>'ExampleController@getUser',
    'middleware'=>'roles',
    'roles'=>['admin','student']
])->name('dahsboard.examples.index.getUser');


Route::get('/examples/getAllData',[
    'uses'=>'ExampleController@getAllData',
    'middleware'=>'roles',
    'roles'=>['admin','student']
])->name('dahsboard.examples.getAllData');


Route::get('/logs/{user}',[
    'uses'=>'LogController@index',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.logs.index');

Route::post('/logs',[
    'uses'=>'LogController@update',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.logs.update');

Route::get('/logs/{user}/asMark',[
    'uses'=>'LogController@asMark',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.logs.asMark');



Route::get('/sessions',[
    'uses'=>'ResiveSessionController@index',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.session.index');

Route::get('/sessions/getAll',[
    'uses'=>'ResiveSessionController@getAll',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.session.getAll');

Route::post('/sessions/store',[
    'uses'=>'ResiveSessionController@store',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.session.store');

Route::get('/date/clear/{user}',[
    'uses'=>'UserController@dateClear',
    'middleware'=>'roles',
    'roles'=>['admin']
])->name('dahsboard.date.clear');