<?php

return [
    'date_format' => 'd.m.Y',
    'time_format' => 'H:i:s',
    'admin_default_language' => 'bg',
    'admin_languages' => [
        'en' => 'English',
        'bg' => 'Български',
    ],
    'site_title' => env('APP_NAME', 'Admin'),
    'registration_default_role' => '1',
    'developer' => 'ProDesign',
    'developer_url' => 'https://prodesign.bg/',
    'admin_panel_url' => env('ADMIN_PANEL_URL', '_proadmin'),
    'admin_panel_ip_resstrict' => false,
    'password_min_chars' => 12,
    'password_max_chars' => 50,
    'registration_enable' => false,
    'pwa_enable' => true,
    'activity_log_expire' => 20,
    'theme_color' => "#187DE4",
    'system_email' => env('SYSTEM_EMAIL'),
    'support' => env('SYSTEM_EMAIL'),
    'submenu_only_icons' => false,
    'media_max_files' => 10,
];
