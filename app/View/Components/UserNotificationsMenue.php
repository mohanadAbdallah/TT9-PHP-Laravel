<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserNotificationsMenue extends Component
{
    public $notifications;
    public $unreadcount;
    /**
     * Create a new component instance.
     */
    public function __construct($count = 10)
    {
        $user = Auth::user();

        $this->notifications = $user->notifications()
            ->take($count)
            ->get();

        $this->unreadcount = $user->unreadnotifications()->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-notifications-menue');
    }
}
