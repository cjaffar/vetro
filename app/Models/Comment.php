<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
  
  protected $guarded = [];

  protected $table = 'comments';
  

  public function author()
  {
    return $this->belongsTo('App\User', 'from_user');
  }
  
  
  public function post()
  {
    return $this->belongsTo('App\Models\Post', 'on_post');
  }
}