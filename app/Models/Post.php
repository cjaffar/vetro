<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
*
*/
class Post extends Model
{
  
  protected $guarded = [];

  protected $table = 'posts';

  
  public function comments()
  {
    return $this->hasMany('App\Models\Comment', 'on_post');
  }
  
  /**
  * Owner of the post.
  */
  public function author()
  {
    return $this->belongsTo('App\Models\User', 'author_id');
  }
}