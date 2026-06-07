<?php

return [
    'key' => 'barber_shop',
    'name' => 'Barber Shop',
    'description' => 'Profile for barbershops, grooming studios, and appointment-based services.',
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
    ],
    'default_theme' => 'barber-classic',
    'themes' => [
        'barber-classic',
        'barber-premium',
    ],
    'demo_pages' => [
        'home' => 'Haircuts, beard care, and a clean booking-first landing page.',
        'about' => 'Describe the team, style, expertise, and studio vibe.',
        'contacts' => 'Address, business hours, phone number, and booking links.',
    ],
];
