<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
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

    /**
     * 対象ツイートのコメントを取得
     *
     * @param Int $tweet_id
     * @return \App\Models\Comment|null
     */
    public function getComments(Int $tweet_id)
    {
        return $this->with('user')->where('tweet_id', $tweet_id)->get();
    }

    /**
     * コメントを保存
     *
     * @param Int $user_id
     * @param Array $data
     * @return void
     */
    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $data['tweet_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }
}
