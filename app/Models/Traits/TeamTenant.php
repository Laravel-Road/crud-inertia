<?php

namespace App\Models\Traits;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait TeamTenant
{
    public static function bootTeamTenant(): void
    {
        static::creating(function (Model $model) {
            if (! $model->team_id) {
                $model->team_id = Auth::user()->currentTeam->id;
            }
        });
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
