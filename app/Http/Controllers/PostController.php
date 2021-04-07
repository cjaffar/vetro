<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    public function index() {
	    $posts = Post::where('active',1)->orderBy('created_at','desc')->paginate(5);
	    

	    $title = 'Latest Posts';
	    
	    return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
    * not so nice - auth should be handled in model.
    */
    public function can_edit($request, $post) {
		return $post && ($request->user()->id == $post->author_id || $request->user()->is_admin());
    }

	public function create(Request $request)
	{
		if ($request->user()->can_post()) {
		  return view('posts.create');
		}
		
		//we can also send a 403 here.  
		return redirect('/')->withErrors('You have not sufficient permissions for writing post');
	}

	public function show($slug)
	{
		$post = Post::where('slug',$slug)->first();
		if(!$post)
		{
		   return redirect('/')->withErrors('requested page not found'); //or we can simply dump a 404.
		}

		$comments = $post->comments;
		return view('posts.show')->withPost($post)->withComments($comments);
	}

	public function edit(Request $request, $slug)
	{
		$post = Post::where('slug',$slug)->first();
		if($this->can_edit($request, $post)) {
		  return view('posts.edit')->with('post',$post);
		}

		return redirect('/')->withErrors('you have not sufficient permissions');
	}

	public function update(Request $request)
	{
	//
		$post_id = $request->input('post_id');
		$post = Post::find($post_id);

		if($this->can_edit($request, $post)) {
		  
		  $title = $request->input('title');
		  $slug = \Str::slug($title);
		  $duplicate = Post::where('slug', $slug)->first();
		  
		  if ($duplicate) {
		    if ($duplicate->id != $post_id) {
		      return redirect('edit/' . $post->slug)->withErrors('Title already exists.')->withInput();
		    }
		  }

		  $post->slug = $slug;
		  $post->title = $title;
		  $post->body = $request->input('body');

		  if ($request->has('save')) {
		    $post->active = 0;
		    $message = 'Post saved successfully';
		    $landing = 'edit/' . $post->slug;
		  } else {
		    $post->active = 1;
		    $message = 'Post updated successfully';
		    $landing = $post->slug;
		  }

		  $post->save();
		  
		  return redirect($landing)->withMessage($message);
		}
		  
		return redirect('/')->withErrors('you have not sufficient permissions');
	}

	public function destroy(Request $request, $id)
	{
		//
		$post = Post::find($id);
		if($this->can_edit($request, $post))
		{
		  $post->delete();
		  $data['message'] = 'Post deleted Successfully';
		}
		else 
		{
		  $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
		}
		
		return redirect('/')->with($data);
	}

	public function store(PostFormRequest $request)
	{
		$post = new Post();
		$post->title = $request->get('title');
		$post->body = $request->get('body');
		$post->slug = \Str::slug($post->title);

		$duplicate = Post::where('slug', $post->slug)->first();
		if ($duplicate) {
		  return redirect('new-post')->withErrors('Title already exists.')->withInput();
		}

		$post->author_id = $request->user()->id;
		if ($request->has('save')) {
		  $post->active = 0;
		  $message = 'Post saved successfully';
		} else {
		  $post->active = 1;
		  $message = 'Post published successfully';
		}
		$post->save();
		
		return redirect('edit/' . $post->slug)->withMessage($message);
	}
}
