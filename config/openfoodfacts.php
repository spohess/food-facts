<?php

return [
    'urls' => [
        'index' => env('OFF_URL_INDEX', 'https://challenges.coode.sh/food/data/json/index.txt'),
        'data' => env('OFF_URL_DATA', 'https://challenges.coode.sh/food/data/json/'),
    ],
    'files' => [
        'chunk' => [
            'size' => env('OFF_CHUNK_SIZE', 100),
            'limit' => env('OFF_CHUNK_LIMIT', 1),
        ]
    ]
];
