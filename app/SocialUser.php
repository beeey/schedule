<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialUser extends Model
{
    protected $guarded = [];

    protected $table = 'social_users';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
