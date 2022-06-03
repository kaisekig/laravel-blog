<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface 
{
    public function all();
    public function one(int $categoryId);
    public function add(array $categoryData);
    public function edit(int $categoryId, array $categoryData);
    public function delete(int $categoryId);
}
?>