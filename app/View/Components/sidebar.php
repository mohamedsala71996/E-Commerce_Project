<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sidebar extends Component
{
    
    public $items;
    
    public function __construct()
    {
        $this->items = config("sidebar");
    }

   
    
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
