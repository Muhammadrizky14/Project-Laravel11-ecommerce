<?php

return [
    'auth' => [
        'guard' => env('FILAMENT_AUTH_GUARD', 'web'),
        'pages' => [
            'login' => \Filament\Http\Livewire\Auth\Login::class,
        ],
    ],
    
    'path' => env('FILAMENT_PATH', 'admin'),
    
    // Tambahkan konfigurasi lain yang diperlukan
];

