<?php

namespace App\Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [
        // Other filters...
        'auth' => \App\Filters\AuthFilter::class,  // Register the Auth filter
    ];

    public $globals = [
        'before' => [
            // Apply the auth filter to all admin pages
            'admin/*' => 'auth',
        ],
        'after' => [],
    ];

    // Other configurations if needed
}
