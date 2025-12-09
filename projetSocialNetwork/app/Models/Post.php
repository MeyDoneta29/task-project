<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = ['user_id', 'content'];
   public function author()
   {
       return $this->belongsTo(User::class);
   }
   public function likes()
   {
       return $this->hasMany(Like::class);
   }
   public function comments()
   {
       return $this->hasMany(Comment::class);
   }
}
