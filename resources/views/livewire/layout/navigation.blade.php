<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<!-- top navigation -->
<div class="top_nav" x-data="{ open: false }">
<div class="nav_menu">
    <nav>
    <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li class="">
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset(Auth::user()->picture) }}" alt="">{{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
        </a>
        <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{ route('account-settings') }}" wire:navigate> Profile</a></li>
            <li><a wire:click="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
        </ul>
        </li>
    </ul>
    </nav>
</div>
</div>