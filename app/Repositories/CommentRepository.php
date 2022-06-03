<?php
namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface 
{
    public function all()
    {
        return Comment::all();
    }

    public function one(int $commentId)
    {
        return Comment::findOrFail($commentId);
    }

    public function add(array $commentData)
    {
        return Comment::firstOrCreate($commentData);
    }

    public function allByPost(int $postId)
    {
        return Comment::select("body", "comment_id", "username")
                      ->where("post_id", $postId)
                      ->join("users", "comments.user_id", "=", "users.user_id")
                      ->orderBy("comments.created_at", "desc")
                      ->get();
    }
}

?>