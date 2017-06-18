<?php

namespace WoXuanWang\ActionLog\Models;

use Illuminate\Database\Eloquent\Model;
use WoXuanWang\User\Models\Admin;

/**
 * Class ActionLog
 * @package WoXuanWang\ActionLog\Models
 * @version December 26, 2016, 5:37 am UTC
 */
class ActionLog extends Model
{

    public $table = 'action_logs';


    public $fillable = [
        'type',
        'content',
        'ip',
        'user_agent',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'content'    => 'string',
        'user_agent' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'content' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(Admin::class, 'created_by', 'id');
    }
}