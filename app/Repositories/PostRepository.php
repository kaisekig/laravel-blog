<?php
    namespace App\Repositories;

    use App\Interfaces\PostRepositoryInterface;
    use App\Models\Comment;
    use App\Models\Post;

    class PostRepository implements PostRepositoryInterface {
        public function all()
        {
            return Post::select("posts.*", "users.username", "categories.title as category")
                       ->leftJoin("categories", "posts.category_id", "=", "categories.category_id")
                       ->leftJoin("users", "posts.user_id", "=", "users.user_id")
                       ->withCount("comments")
                       ->get();
        }

        public function one(int $postId)
        {
            return Post::findOrFail($postId);    

        }
        public function allByUser(int $userId)
        {

            return Post::where("user_id", $userId)
                       ->withCount("comments")
                       ->get();

                       
        }

        public function oneByUser(int $userId, int $postId)
        {
            return Post::where("user_id", $userId)
                       ->where("post_id", $postId)
                       ->firstOrFail();
        }

        public function add(array $postData)
        {
            return Post::firstOrCreate($postData);
                       
        }

        public function edit(int $userId, int $postId, array $postData)
        {
            return Post::where("user_id", $userId)
                       ->where("post_id", $postId)
                       ->update($postData);
        }

        public function delete(int $userId, int $postId)
        {
            $comments = Comment::where("post_id", $postId)
                               ->get();
            if ($comments->isEmpty()) {
                return Post::destroy([$userId, $postId]);
            }
            
            Comment::where("post_id", $postId)
                   ->delete();
                   
            return Post::destroy([$userId, $postId]);
        }

        public function search(string $text)
        {
            return Post::select("*")
                       ->where("title", "like", "%{$text}%")
                       ->orWhere("body", "like", "%{$text}%")
                       ->get();
        }
    }
?>