<?php

return [
    'key' => 'beauty_services',
    'name' => 'Beauty Services',
    'description' => 'Profile for beauty studios, salons, cosmetology, and treatment-based services.',
    'modules' => [
        'pages',
        'services',
        'masters',
        'booking',
        'pricing',
        'portfolio',
        'reviews',
        'contacts',
        'seo',
        'forms',
        'blog',
        'themes',
        'users',
        'security',
        'account',
    ],
    'default_theme' => 'beauty-soft',
    'themes' => [
        'beauty-soft',
        'beauty-lux',
    ],
    'demo_pages' => [
        'home' => 'Facial, beauty, and care services with online booking and portfolio blocks.',
        'about' => 'Tell the story of the studio, specialists, and care philosophy.',
        'contacts' => 'Address, opening hours, messengers, and appointment contacts.',
    ],
];
