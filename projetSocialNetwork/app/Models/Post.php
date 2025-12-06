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
}
