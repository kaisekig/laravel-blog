<?php
    namespace App\Interfaces;

    interface CommentRepositoryInterface {
        public function all();
        public function one(int $commentId);
        public function add(array $commentData);
        public function allByPost(int $postId);
        
    }
?>