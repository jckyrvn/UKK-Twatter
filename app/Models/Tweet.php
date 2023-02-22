<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tweet;

class Tweet extends Model
{
    use HasFactory;
    protected $table = "tweets";
    protected $fillable = [
        'id',
        'tweet',
        'media',
        'tag',
        'user_id',
];
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function comment(){
        return $this->hasMany(Comment::class, 'tweet_id', 'id');
    }
}
