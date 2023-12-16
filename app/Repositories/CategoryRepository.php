<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }
    public function getCategoryById($CategoryId)
    {
        return Category::findOrFail($CategoryId);
    }
    public function deleteCategory($CategoryId)
    {
        Category::destroy($CategoryId);
    }
    public function createCategory(array $CategoryDetails)
    {
        return Category::create($CategoryDetails);
    }
    public function updateCategory($CategoryId, array $newDetails)
    {
        return Category::whereId($CategoryId)->update($newDetails);
    }
    
}
