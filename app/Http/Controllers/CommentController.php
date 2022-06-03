<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function all() {
        $this->commentRepository->all();    
    }

    public function one(int $commentId) {
        $this->commentRepository->one($commentId);
    }

    public function add(int $postId, Request $request) {
        $userId = $request->session()->get("user_id");

        $this->commentRepository->add([
            "body"    => $request->input("body"),
            "post_id" => $postId,
            "user_id" => $userId
        ]);

        return redirect()->route("post", [$postId]);
    }

    public function allByPostId(int $postId) {
        return $this->commentRepository->allByPost($postId);
    }
}