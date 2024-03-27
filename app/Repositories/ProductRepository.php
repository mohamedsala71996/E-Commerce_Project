<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::get();
    }
    public function getProductById($ProductId)
    {
        return Product::findOrFail($ProductId);
    }
    // -----------------------Delete_functions-------------------------
    public function deleteProduct($ProductId)
    {
        return  Product::destroy($ProductId);
    }
    public function forceDeleteProduct($ProductId)
    {
        return Product::withTrashed()->findOrFail($ProductId)->forceDelete();
    }

    public function restoreTrashesProduct($ProductId)
    {
        return Product::withTrashed()->findOrFail($ProductId)->restore();
    }
    // ---------------------------------------------------------------
    public function createProduct(array $ProductDetails)
    {
        return Product::create($ProductDetails);
    }
    public function updateProduct($ProductId, array $newDetails)
    {
        return Product::whereId($ProductId)->update($newDetails);
    }
}
