<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * いいねを取得
     *
     * @param Int $user_id
     * @param Int $tweet_id
     * @return boolean true いいね済み false 未いいね
     */
    public function isFavorite(Int $user_id, Int $tweet_id) 
    {
        return (boolean) $this->where('user_id', $user_id)->where('tweet_id', $tweet_id)->first();
    }

    /**
     * いいねを保存
     *
     * @param Int $user_id
     * @param Int $tweet_id
     * @return void
     */
    public function storeFavorite(Int $user_id, Int $tweet_id)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $tweet_id;
        $this->save();

        return;
    }

    /**
     * いいねを削除
     *
     * @param Int $favorite_id
     * @return void
     */
    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }
}
