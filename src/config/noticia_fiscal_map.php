<?php


return [

    'post_modified' => [
        'value'=>'published_at',
        'callbacks' => []
    ],
    'post_content' => 'description',
    'post_title' => 'title',
    'post_year' => 'year_at',
    'post_mont' => 'month_at',
    'post_day' => 'day_at',
    'post_resume' => 'resume',
    'post_tombo' => 'tumble',
    'categories' => [
        'value' => 'categories',
        'callbacks' => [ 'get_categories_array']
    ],
    '697' => [
        'value' => 'categories',
        'callbacks' => [
            //'abcd_explode_values'
        ]
    ],
    'thumbnail' => [
        'value' => 'thumbnail',
        'callbacks' => [
            'extract_thumbnail'
        ]
    ]
];