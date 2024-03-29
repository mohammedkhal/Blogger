<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\CategoryJoinsRepository;
use App\Repositories\TagRepository;
use App\Repositories\TagJoinRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostService
{
	private $postRepository;
	private $tagRepository;
	private $tagJoinRepository;
	private $categoryJoinRepository;

	public function __construct(PostRepository $postRepository, CategoryJoinsRepository $categoryJoinRepository, TagRepository $tagRepository, TagJoinRepository $tagJoinRepository)
	{
		$this->postRepository = $postRepository;
		$this->tagRepository = $tagRepository;
		$this->tagJoinRepository = $tagJoinRepository;
		$this->categoryJoinRepository = $categoryJoinRepository;
	}

	/**
	 * Fetch the all posts
	 * 
	 * @return collection
	 */
	public function fetch()
	{
		return $this->postRepository->fetch();
	}

	public function show($slug)
	{
		return $this->postRepository->find($slug);
	}

	public function store($data)
	{
		$data['user_id'] =  Auth::guard('user')->id();
		$post = $this->postRepository->store($data);
		$tagsFromPost = explode(",", $data['tag']);
		$tags = collect([]);
		foreach ($tagsFromPost as $tag) {
			$newTag = $this->tagRepository->store(['tag' => $tag]);
			$tags->push($newTag->id);
		}

		foreach ($tags as $tag) {
			$newTag = $this->tagJoinRepository->store($tag,  $post->id);
		}

		foreach ($data['category'] as $category) {
			$this->categoryJoinRepository->store($category, $post->id);
		}
	}

	public function update(array $data, $slug)
	{
		$data->validate([
			'title' => 'required|max:255',
			'body' => 'required',
			'tag' => 'required',
			'slug' => 'required|unique:posts',
			'short_description' => 'required',
		]);

		$data['user_id'] =  Auth::guard('user')->id();
		$this->categoryJoinRepository->update($data);
		return $this->postRepository->update($data, $slug);
	}
}
