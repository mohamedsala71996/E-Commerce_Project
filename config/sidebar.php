<?php

return [

    [
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard',
        'title'=> 'dashboard',
        'active'=>'dashboard',

    ],
    [
        'icon'=>'fas fa-tags nav-icon',
        'route'=>'categories.index',
        'title'=> 'Categories',
        'active'=>'categories.*',
        'badge'=> 'new',
    ],
    [
        'icon'=>'fas fa-tags nav-icon',
        'route'=>'products.index',
        'title'=> 'Products',
        'active'=>'products.*',
        'badge'=> 'new',
    ],
    [
        'icon'=>'fas fa-tags nav-icon',
        'route'=>'profile.edit',
        'title'=> 'Profile',
        'active'=>'profiles.*',
        'badge'=> 'new',
    ],



];


