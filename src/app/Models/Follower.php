<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
    public $timestamps = false;
    public $incrementing = false;

    /**
     * フォロー数を取得
     *
     * @param Int $user_id
     * @return Int フォロー数
     */
    public function getFollowCount($user_id)
    {
        return $this->where('following_id', $user_id)->count();
    }

    /**
     * フォロワー数を取得
     *
     * @param Int $user_id
     * @return Int フォロワー数
     */
    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }

    /**
     * フォローしているユーザのIDを取得
     *
     * @param Int $user_id
     * @return \App\Models\Follower|null
     */
    public function followingIds(Int $user_id)
    {
        return $this->where('following_id', $user_id)->get('followed_id');
    }
}
