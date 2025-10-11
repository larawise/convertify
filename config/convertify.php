<?php

return [
    'default'                                   => 'stack',

    'converters'                                => [
        'stack'     => [
            'converter'     => 'stack',
            'stack'         => ['crypt'],
            'report'        => false,
        ],
        'crypt'     => [
            'converter'     => 'crypt',
            'report'        => false,
        ]
    ],
];
