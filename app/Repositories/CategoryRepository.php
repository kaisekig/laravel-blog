<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\QueryException;

class CategoryRepository implements CategoryRepositoryInterface {
    public function all()
    {
        return Category::all()
                       ->sortByDesc("created_at");
    }

    public function one(int $categoryId)
    {
        return Category::findOrFail($categoryId);
    }

    public function add(array $categoryData)
    {
        return Category::firstOrCreate($categoryData);
    }

    public function edit(int $categoryId, array $categoryData)
    {
        return Category::where("category_id", $categoryId)
                       ->update($categoryData);
    }

    public function delete(int $categoryId)
    {
        try {
            return Category::destroy($categoryId); 
        } catch (QueryException $exception) {
            return $exception;
        }
        
    }
}

?>