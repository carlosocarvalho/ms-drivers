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
    'default_driver' => Modalnetworks\MetaSearch\Drivers\AbcdDriver::class,
    'default_driver_load' => 'abcd',

    'drivers' => [
        Modalnetworks\MetaSearch\Drivers\AbcdDriver::class,
        Modalnetwors\MetaSearch\Drivers\BiosferaDriver::class ,
        Modalnetwors\MetaSearch\Drivers\TaxHandDeloitteDriver::class,
        Modalnetworks\MetaSearch\Drivers\NoticiaFiscalDriver::class
    ],
    'mappings' => [
        'abcd' => $mapping,
        'noticia_fiscal' => require_once (__DIR__.'/noticia_fiscal_map.php'),
        'biosfera' => require_once (__DIR__.'/biosfera_map.php'),
        'taxhand' => require_once (__DIR__.'/taxhand_map.php')
   
    ],

    'callbacks_drivers' => [
        'noticia_fiscal'=> [
            'add_extras_data'
        ],
        'biosfera' => [
            'call_format_helper_biosfera'
        ],
        'taxhand' => [
            'call_format_helper_taxhand'
        ]
    ],

    'database' => [

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'database',
            'username'  => 'root',
            'password'  => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]

];