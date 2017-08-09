<?php

Route::post('action-log/bundle','\$NAME$\ActionLog\Controllers\ActionLogController@bundle');
Route::resource('action-log', '\$NAME$\ActionLog\Controllers\ActionLogController');
