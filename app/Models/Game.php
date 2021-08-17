<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'playerX',
        'playerO',
        'positions'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'positions' => 'array',
    ];

    /**
     * El jugador X.
     */
    public function player_x()
    {
        return $this->belongsTo(Player::class, 'playerX');
    }

    /**
     * El jugador O.
     */
    public function player_o()
    {
        return $this->belongsTo(Player::class, 'playerO');
    }
}
