<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Club extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the games for the club.
     */
    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'home_club_id');
    }

    /**
     * Get the games for the club.
     */
    public function games_away(): HasMany
    {
        return $this->hasMany(Game::class, 'away_club_id');
    }
}
