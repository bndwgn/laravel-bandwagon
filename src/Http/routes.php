<?php

use Illuminate\Support\Facades\Route;

// Event controller
Route::get('/bandwagon-api/event', 'EventsController@index');
