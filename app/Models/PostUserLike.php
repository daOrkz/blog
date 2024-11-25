<?php

namespace App\Models;

use Database\Factories\LikesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUserLike extends Model
{
    use HasFactory;

    protected $table = 'post_user_likes';
    protected $guarded = false;
    public $timestamps = false;

    protected static function newFactory()
    {
        return LikesFactory::new();
    }
}
