<?php


$mapping = [
    '777' => [

        'value'=>'published_at',
        'callbacks' => [
            'abcd_format_date'
        ]
    ],
    '591' => 'description',
    '999' => 'title',
    '995' => 'year_at',
    '996' => 'month_at',
    '997' => 'day_at',
    '245B' => 'resume',
    '987' => 'tumble',
    'type' => [
        'value' => 'material_type',
        'callbacks' => ['strtolower']
    ],
    '697' => [
        'value' => 'categories',
        'callbacks' => [
            'abcd_explode_values'
        ]
    ],
    'thumbnail' => [
        'value' => 'thumbnail',
        'callbacks' => [
            'clear_slashes_links'
        ]
    ]
];

return [
    'mappings' => [
        'abcd' => $mapping
    ],


    'drivers' => [
        Modalnetworks\MetaSearch\Drivers\AbcdDriver::class
    ]
];