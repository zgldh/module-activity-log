<?php namespace $NAME$\ActivityLog;

class ActivityLogServiceProvider extends \zgldh\ModuleActivityLog\ActivityLogServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        parent::boot();
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views',
            '$NAME$\ActivityLog');
    }
}