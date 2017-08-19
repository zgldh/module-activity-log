<?php namespace $NAME$\ActivityLog\Repositories;

use $NAME$\ActivityLog\Models\ActivityLog;
use zgldh\Scaffold\BaseRepository;

class ActivityLogRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'subject',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ActivityLog::class;
    }
}
