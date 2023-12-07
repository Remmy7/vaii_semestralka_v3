<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game_texts extends Model
{
    protected $fillable = ['id','gameText', 'categoriesId', 'difficultiesId'];

    public function category()
    {
        return $this->belongsTo(categories::class, 'categoriesId');
    }

    public function difficulty()
    {
        return $this->belongsTo(difficulty::class, 'difficultiesId');
    }
    use HasFactory;
}
