<?php

namespace App\Interfaces;

interface PostRepositoryInterface 
{
    public function all();
    public function one(int $postId);
    public function allByUser(int $userId);
    public function oneByUser(int $userId, int $postId);
    public function add(array $postData);
    public function edit(int $userId, int $postId, array $postData);
    public function delete(int $userId, int $postId);
    public function search(string $text);
}

?>