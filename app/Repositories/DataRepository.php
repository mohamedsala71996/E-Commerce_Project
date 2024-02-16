<?php
namespace App\Repositories;

use App\Interfaces\DataRepositoryInterface;

class DataRepository implements DataRepositoryInterface
{
   public function abilities()
    {
        return [

            'categories.view' => __('category view'),
            'categories.create' => __('category create'),
            'categories.edit' => __('category edit'),
            'categories.delete' => __('category delete'),
        
            'products.view' => __('product view'),
            'products.create' => __('product create'),
            'products.edit' => __('product edit'),
            'products.delete' => __('product delete'),
            
            'profile.view' => __('profile view'),
            'profile.edit' => __('profile edit'),
            'profile.delete' => __('profile delete'),
        
        
           'role.view' => __('Role view'),
           'role.create' => __('Role create'),
            'role.edit' => __('Role edit'),
            'role.delete' => __('Role delete'),
            
        
        ];
    }



}