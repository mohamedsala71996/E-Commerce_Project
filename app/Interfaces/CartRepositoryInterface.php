<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function get():Collection;
    public function add(Product $product,$quantity=1);
    public function update($id,$quantity=1);
    public function delete(Product $product);
    public function empty();
    public function total(): float;


    // public function getCategoryById($CategoryId);
    // public function deleteCategory($CategoryId);
    // public function createCategory(array $CategoryDetails);
    // public function updateCategory($CategoryId, array $newDetails);
    // public function forceDeleteCategory($CategoryId);
    // public function restoreTrashesCategory($CategoryId);
}
