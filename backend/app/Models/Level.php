<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $fillable = [
        'level'
    ];

    protected $appends = [
        'levelCount'
    ];

    public function getLevelCountAttribute()
    {
        return $this->developer()->count();
    }

    public function developer()
    {
        return $this->hasMany(Developer::class);
    }
}
