<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    protected $fillable = [
        'task_name',
        'due_date_time',
        'project_id',
        'user_id'
    ];
}
