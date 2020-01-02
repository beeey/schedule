<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedules';

    protected $with = ['users'];
    protected $appends = ['is_author', 'is_attending'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() :BelongsToMany
    {
        return $this->belongsToMany(User::class, 'schedule_user')->withPivot('is_author');
    }

    public function getIsAuthorAttribute(): ?bool
    {
        if (!Auth::hasUser() || !$this->relationLoaded('users')) {
            return null;
        }

        return $this->users->firstWhere('pivot.user_id', Auth::id())->pivot->is_author ?? false;
    }

    public function getIsAttendingAttribute(): ?bool
    {
        if (!Auth::hasUser() || !$this->relationLoaded('users')) {
            return null;
        }

        return (bool)$this->users->firstWhere('pivot.user_id', Auth::id());
    }
}
