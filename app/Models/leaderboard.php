<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaderboard extends Model
{
    protected $table = 'leaderboard';
    protected $fillable = ['id','gameTextID', 'playerID', 'time'];

    public function gameText()
    {
        return $this->belongsTo(game_texts::class, 'gameTextID');
    }

    public function player()
    {
        return $this->belongsTo(User::class, 'playerID');
    }

    use HasFactory;
}
