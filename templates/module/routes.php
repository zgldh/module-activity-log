<?php

Route::post('activity_log/bundle','\$NAME$\ActivityLog\Controllers\ActivityLogController@bundle');
Route::resource('activity_log', '\$NAME$\ActivityLog\Controllers\ActivityLogController');
