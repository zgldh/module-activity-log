<?php namespace zgldh\ModuleActivityLog;

use Illuminate\Support\Facades\Artisan;
use zgldh\Scaffold\Installer\ModuleInstaller as BaseInstaller;
use zgldh\Scaffold\Installer\Utils;

/**
 * Created by PhpStorm.
 * User: zhangwb-pc
 * Date: 08/09/2017
 * Time: 2:00 PM
 */
class ModuleInstaller extends BaseInstaller
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleTemplatePath = __DIR__ . '/../templates/';
    }

    public function run()
    {
        $this->copyModuleFilesTo('ActivityLog');

        $this->addServiceProvider('ActivityLog', 'ActivityLogServiceProvider::class');
        $this->addRoute('ActivityLog');
        $this->addToVueRoute('ActivityLog');
        $this->addAdminMenuItem($this->getModuleTemplateContent('menu.blade.php'));
        $this->copyLanguageFiles('module-activity-log');

        // Dependencies
        Utils::addServiceProvider('Spatie\Activitylog\ActivitylogServiceProvider::class');
        Utils::addAlias('Agent', 'Jenssegers\Agent\Facades\Agent::class');
        
        \App::register(\Spatie\Activitylog\ActivitylogServiceProvider::class);
        \Artisan::call('vendor:publish', [
            '--provider' => 'Spatie\Activitylog\ActivitylogServiceProvider',
            '--tag'      => 'migrations']);
        \Artisan::call('vendor:publish', [
            '--provider' => 'Spatie\Activitylog\ActivitylogServiceProvider',
            '--tag'      => 'config']);

        \Artisan::call('migrate');

        exec('composer dumpautoload');
    }

}