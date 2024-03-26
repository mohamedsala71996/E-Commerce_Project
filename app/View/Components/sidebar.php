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
        $this->items = $this->prepare(config("sidebar"));
    }

   
    
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }

    protected function prepare($items){
        $user=auth()->user();
        foreach ($items as $key => $item) {
            // if (isset($item['ability']) && !$user->can($item['ability'])) {
            //     unset($items[$key]);
            // }

        }
        return $items;

    }
}
