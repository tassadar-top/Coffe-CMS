<?php

return [
    'csrf_key' => '_token',
    'login_attempt_limit' => 5,
    'login_block_minutes' => 15,
    'allowed_image_extensions' => ['jpg', 'jpeg', 'png', 'webp'],
    'allowed_image_mime_types' => ['image/jpeg', 'image/png', 'image/webp'],
    'max_upload_size' => 3 * 1024 * 1024,
    'security_email' => 'security@example.com',
];
