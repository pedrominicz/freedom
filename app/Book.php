<?php

namespace Freedom;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  public function comments() {
    return $this->hasMany(Comment::class);
  }
}
