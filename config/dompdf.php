<?php

return [
    'fontDir' => storage_path('fonts/'),
    'fontCache' => storage_path('fonts/'),
    'tempDir' => storage_path('temp/'),
    'chroot' => realpath(base_path()),
    'enable_font_subsetting' => true,
    'pdf_backend' => 'CPDF',
    'default_media_type' => 'A4',
    'default_paper_size' => 'A4',
    'default_font' => 'sans-serif',
    'dpi' => 96,
    'enable_php' => false,
    'enable_javascript' => true,
    'enable_html5parser' => true,
    'enable_cache' => true,
    'auto_load_font' => true,
    'pdflayer' => [
        'api_key' => env('PDFLAYER_API_KEY'),
        'use_api' => env('PDFLAYER_USE_API', false),
    ],
];
