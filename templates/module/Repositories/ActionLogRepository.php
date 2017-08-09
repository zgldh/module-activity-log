<?php namespace $NAME$\ActionLog\Repositories;

use $NAME$\ActionLog\Models\ActionLog;
use zgldh\Scaffold\BaseRepository;

class ActionLogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'content',
        'ip',
        'user_agent'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ActionLog::class;
    }

    public static function log($type, $moduleName, $admin = null, $otherContent = null)
    {
        $admin = $admin ?: \Auth::user();
        $browser = \Agent::browser();
        $version = \Agent::version($browser);
        $user_agent_info = $browser . '版本号：' . $version;

        $url = \Request::method() . ' ' . \Request::url();
        $content = "[{$moduleName}][{$admin->name}][{$url}][{$otherContent}]";
        $ip = \Request::getClientIp();
        $data = [
            'type'       => $type,
            'user_agent' => $user_agent_info,
            'content'    => $content,
            'ip'         => $ip,
            'created_by' => $admin->id
        ];
        ActionLog::create($data);
    }
}
