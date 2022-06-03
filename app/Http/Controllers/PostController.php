<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostRepository $postRepository;
    private CommentRepository $commentRepository;

    public function __construct(PostRepository $postRepository, CommentRepository $commentRepository)
    {
        $this->postRepository       = $postRepository;
        $this->commentRepository    = $commentRepository;
    }

    public function all() {
        return view("layouts.posts.all", ["posts" => $this->postRepository->all()]);
    }

    public function one(int $postId) {
        return view("layouts.posts.one", [
            "post"      => $this->postRepository->one($postId),
            "comments"  => $this->commentRepository->allByPost($postId)
        ]);
    }

    public function search(Request $request) {
        $text = $request->input("search");

        if ($text === null) {
            return redirect()->route("search");
        }

        $posts = $this->postRepository->search($text);

        return redirect()->route("search")->with("posts", $posts);
    }

    public function results(Request $request) {
        $posts = $request->session()->get("posts");
        return view("layouts.posts.search", [
            "posts" => $posts
        ]);
    }
}
