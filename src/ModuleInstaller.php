<?php namespace zgldh\ModuleActionLog;

use Illuminate\Support\Facades\Artisan;
use zgldh\Scaffold\Installer\ModuleInstaller as BaseInstaller;

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
        $this->copyModuleFilesTo('ActionLog');

        $this->addServiceProvider('ActionLog', 'ActionLogServiceProvider::class');
        $this->addRoute('ActionLog');
        $this->addToVueRoute('ActionLog');
        $this->addAdminMenuItem($this->getModuleTemplateContent('menu.blade.php'));

        // Publish migrations
        $this->publishMigration('CreateActionLogsTable', __DIR__ . '/../migrations/create_action_logs_table.php');

        Artisan::call('migrate');

        exec('composer dumpautoload');
    }

}