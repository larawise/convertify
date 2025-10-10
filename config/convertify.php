<?php

return [
    'default'                                   => 'stack',

    'converters'                                => [
        'crypt'     => [
            'converter' => 'crypt'
        ],
        'stack'     => [
            'converter' => 'stack',
            'stack'     => ['crypt']
        ]
    ],
];
