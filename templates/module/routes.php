<?php

Route::post('actionlog/bundle','\WoXuanWang\ActionLog\Controllers\ActionLogController@bundle');
Route::resource('actionlog', '\WoXuanWang\ActionLog\Controllers\ActionLogController');
