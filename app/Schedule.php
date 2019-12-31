<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedules';

    protected $with = 'users';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
