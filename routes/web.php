<?php

use Illuminate\Support\Facades\Route;
Route::get('/test', function(){
	return view('test');
});
Route::get('/test2', function(){
	return view('test2');
});
include 'be.php';
include 'fe.php';
