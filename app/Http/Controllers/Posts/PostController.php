<?php
namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->fetchData();
        return view('post.index ', compact('posts'));
    }

    public function show($slug)
    {
        $post = $this->postService->show($slug);
        return view('post.show', compact('post'));
    }

    public function edit($slug)
    {
        /**
         * not complet yet
         */
        $post = $this->postService->edit($slug);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $this->postService->update($request, $slug);
        return redirect()->route('posts.index');
    }
}
