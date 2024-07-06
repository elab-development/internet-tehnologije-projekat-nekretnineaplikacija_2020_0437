<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'username', 'full_name', 'profile_picture', 'bio', 'website', 'followers_count', 'following_count', 'posts_count'
    ];
}
