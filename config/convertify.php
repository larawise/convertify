<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ℹ️ Convertify (Converters)
    |--------------------------------------------------------------------------
    |
    | This section defines which converters should be available to Convertify
    | via alias-based access. These are not custom instances — they are
    | lazy-loaded from the container or resolved via closures when needed.
    |
    | Each alias maps to either:
    | - A class name (resolved via Laravel's container)
    | - A closure (for grouped or parameterized converters)
    |
    | Convertify will only resolve and register these converters when they are
    | actually used, keeping boot time minimal and memory usage efficient.
    */
    'converters'                                => [],
];
