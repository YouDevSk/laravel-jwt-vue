<?php


// pages section
Route::get('/', 'PagesController@home');
Route::get('/menu', 'PagesController@menu');

// admin section
Route::get('/admin', function () {
    return view('admin');
});

Route::get('/{any}', function () {
    return view('admin');
})->where('any', '.*');
