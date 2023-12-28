<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * ツイートを取得
     *
     * @param Int $user_id
     * @return \App\Models\Tweet|null
     */
    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }

    /**
     * ツイート数を取得
     *
     * @param Int $user_id
     * @return Int ツイート数
     */
    public function getTweetCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    /**
     * フォローしているユーザのツイートを取得
     *
     * @param Int $user_id
     * @param Array $follow_ids
     * @return \App\Models\Tweet|null
     */
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

    /**
     * 該当ツイートを取得
     *
     * @param Int $tweet_id
     * @return \App\Models\Tweet|null
     */
    public function getTweet(Int $tweet_id)
    {
        return $this->with('user')->where('id', $tweet_id)->first();
    }
    
    /**
     * 編集対象のツイートを取得
     *
     * @param Int $user_id
     * @param Int $tweet_id
     * @return \App\Models\Tweet|null
     */
    public function getEditTweet(Int $user_id, Int $tweet_id)
    {
        return $this->where('user_id', $user_id)->where('id', $tweet_id)->first();
    }

    /**
     * ツイートを保存
     *
     * @param Int $user_id
     * @param Array $data
     * @return void
     */
    public function tweetStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->text = $data['text'];
        $this->save();

        return;
    }
    
    /**
     * ツイートを更新
     *
     * @param Int $tweet_id
     * @param Array $data
     * @return void
     */
    public function tweetUpdate(Int $tweet_id, Array $data)
    {
        $this->id = $tweet_id;
        $this->text = $data['text'];
        $this->update();

        return;
    }

    /**
     * ツイートを削除
     *
     * @param Int $user_id
     * @param Int $tweet_id
     * @return void
     */
    public function tweetDestroy(Int $user_id, Int $tweet_id)
    {
        return $this->where('user_id', $user_id)->where('id', $tweet_id)->delete();
    }
}
