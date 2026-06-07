<?php

return [
    'key' => 'shawarma_shop',
    'name' => 'Shawarma Shop',
    'description' => 'Profile for shawarma, street food, fast casual, and takeaway businesses.',
    'modules' => [
        'pages',
        'menu',
        'orders',
        'account',
        'promotions',
        'gallery',
        'reviews',
        'contacts',
        'seo',
        'forms',
        'blog',
        'themes',
        'users',
        'security',
    ],
    'default_theme' => 'shawarma-flame',
    'themes' => [
        'shawarma-flame',
        'shawarma-night',
    ],
    'demo_pages' => [
        'home' => 'Hot shawarma, combos, operator email orders, and repeat-customer cabinet.',
        'about' => 'Describe the kitchen, ingredients, speed, and local pickup or delivery.',
        'contacts' => 'Address, delivery zone, call center, and order contact details.',
    ],
];
