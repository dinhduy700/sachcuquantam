<?php

use Illuminate\Support\Facades\Route;
Route::get('/test', function(){
	return view('test');
});
Route::get('/test2', function(){
	return view('test2');
});

Route::get('learning-ci-cd', function(){
	return view('learning-ci-cd');
});
include 'be.php';
include 'fe.php';
