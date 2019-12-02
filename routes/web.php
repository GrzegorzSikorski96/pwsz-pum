<?php

use Illuminate\Support\Facades\Route;
Route::get('{any}', 'HomeController@welcome')->where('any', '.*')->name('home');

