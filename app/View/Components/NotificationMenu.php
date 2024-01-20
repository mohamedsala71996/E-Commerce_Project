<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationMenu extends Component
{

   public $notifications;
   public $notificationsCount;
   public $unreadnotificationsCount;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->notifications=auth()->user()->notifications;
        $this->notificationsCount=auth()->user()->notifications()->count();
        $this->unreadnotificationsCount=auth()->user()->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-menu');
    }
}
