<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    protected function getLogoutRoute(): string
    {
        return '/'; // Direct to homepage after logout
    }
}