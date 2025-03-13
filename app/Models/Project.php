<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Project extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    protected $hidden = ['pivot'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects', 'project_id', 'user_id');
    }

    public static function filter(array $parameters)
    {
        $name = $parameters['name'];
        $status = $parameters['status'];

        $query = self::query();

        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        if ($status) {
            $query->where('status', '=', $status);
        }

        $result = $query->get();

        return $result;
    }
}
