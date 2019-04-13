<?php

namespace App\Repositories;

use App\Models\Post;
//use Illuminate\Support\Facades\Auth;
class PostRepository
{

	protected $post;

	public function getModel()
	{
		return new Post;
	}


	
	public function getAll()
	{
		$post = $this->getModel();
		return $post->latest('id')->get();
	}

	
	public function find($slug)
	{
		$post = $this->getModel();
		return $post->where('slug',$slug)->first(); 
	}


    
	public function store(array $attributes)
	{

		$post = $this->getModel();

		$post->title = $attributes['title'];
		$post->short_description = $attributes['short_description'];
		$post->body = $attributes['body'];
		$post->slug = $attributes['slug'];
		$post->user_id = $attributes['user_id'];

		if ($post->save()) {
			return $post;
		}
	}

	public function getTag($attributes)
	{
		return $this->post->where('tag', '=', $attributes['tag'])->get();
	}


	public function updatePost($post_id, array $attributes)
	{
		$post = $this->getModel();
		$post = $post->find($post_id);
		$post->title = $attributes['title'];
		$post->body = $attributes['body'];
      
		if ($post->save())
			return true;
	}


	public function getProfile()
	{
		$id = auth()->user()->id;
		$post = $this->getModel();

		return $post->where('user_id', $id)->get();
	}


	public function delete($post_id)
	{
		$post = $this->getModel();
		return $post->find($post_id)->delete();
	}
}