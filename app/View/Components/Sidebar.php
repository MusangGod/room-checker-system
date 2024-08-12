<?php

namespace App\View\Components;

use App\Enums\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if(auth()->user()->role->value == 1) {
            $current_user = Role::SUPER_ADMIN;
        } else if(auth()->user()->role->value == 1) {
            $current_user = Role::ADMIN;
        } else {
            $current_user = Role::STAFF;
        }

        return view('components.sidebar', compact("current_user"));
    }
}
