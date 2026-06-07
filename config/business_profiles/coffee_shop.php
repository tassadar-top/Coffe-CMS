<?php

return [
    'key' => 'coffee_shop',
    'name' => 'Coffee Shop',
    'description' => 'Profile for coffee shops, cafes, bakeries, and small food spots.',
    'modules' => [
        'pages',
        'menu',
        'delivery',
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
    'default_theme' => 'coffee-modern',
    'themes' => [
        'coffee-modern',
        'coffee-dark',
    ],
    'demo_pages' => [
        'home' => 'Specialty coffee, breakfast, desserts, and a cozy urban atmosphere.',
        'about' => 'Tell the story of the coffee shop, beans, team, and daily experience.',
        'contacts' => 'Address, opening hours, map, and quick contact links.',
    ],
];
