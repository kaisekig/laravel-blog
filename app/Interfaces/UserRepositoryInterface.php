<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function all();
    public function one(int $userId);
    public function add(array $userData);
    public function edit(int $userId, array $userData);
    public function delete(int $userId);
    
    public function getByEmail(string $email);
    public function getByUsername(string $username);
    
}

?>