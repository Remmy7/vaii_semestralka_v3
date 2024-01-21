<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaderboard extends Model
{
    protected $table = 'leaderboard';
    protected $fillable = ['id','gameTextID', 'playerID', 'time'];

//    public function gameText()
//    {
//        return $this->belongsTo(GameTexts::class, 'gameTextID');
//    }
//
//
//
//    public function categories() {
//        return $this->belongsTo(categories::class, 'id');
//    }
//    public function difficulty() {
//        return $this->belongsTo(difficulty::class, 'id');
//    }
    public function player()
    {
        return $this->belongsTo(User::class, 'playerID');
    }
    public function gameText()
    {
        return $this->belongsTo(GameTexts::class, 'gameTextID');
    }

    public function difficulty()
    {
        return $this->belongsTo(difficulty::class, 'id');
    }

    public function category()
    {
        return $this->belongsTo(categories::class, 'id');
    }
    use HasFactory;
}
