<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text'
    ];

    // relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}