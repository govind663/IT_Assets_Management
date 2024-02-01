<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $authDept = User::with('department', 'role')->where('id', Auth::user()->id)->first();
        // dd($authDept);

        return view('components.header', ['authDept' => $authDept]);
    }
}
