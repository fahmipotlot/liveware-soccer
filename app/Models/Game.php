<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the home that owns the games.
     */
    public function home(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'home_club_id', 'id');
    }

    /**
     * Get the away that owns the games.
     */
    public function away(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'away_club_id', 'id');
    }
}
