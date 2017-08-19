<?php

Route::post('activity-log/bundle','\$NAME$\ActivityLog\Controllers\ActivityLogController@bundle');
Route::resource('activity-log', '\$NAME$\ActivityLog\Controllers\ActivityLogController');
