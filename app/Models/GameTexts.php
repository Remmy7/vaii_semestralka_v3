<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTexts extends Model
{
    protected $fillable = ['id','gameText', 'categoriesId', 'difficultiesId'];

    protected $table = 'GameTexts';

    public function leaderboard()
    {
        return $this->hasOne(Leaderboard::class, 'gameTextID');
    }
    public function category()
    {
        return $this->belongsTo(categories::class, 'categoriesId');
    }

    public function difficulties()
    {
        return $this->belongsTo(difficulty::class, 'difficultiesId');
    }
    use HasFactory;

    public function getName()
    {
        return $this->attributes['gameText'];
    }
}
