<?php

use Larawise\Convertify\Contracts\FactoryContract;

if (! function_exists('convertify')) {
    /**
     * Resolve the Convertify service from the container.
     *
     * @param string|null $converter
     *
     * @return FactoryContract
     */
    function convertify($converter = null)
    {
        if (is_null($converter)) {
            return app('convertify');
        }

        return app('convertify')->converter($converter);
    }
}

if (! function_exists('cast')) {
    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param mixed $value
     * @param string|null $converter
     *
     * @return mixed
     */
    function cast($value, $converter = null)
    {
        return convertify($converter)->cast($value);
    }
}

if (! function_exists('uncast')) {
    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param mixed $value
     * @param string|null $converter
     *
     * @return mixed
     */
    function uncast($value, $converter = null)
    {
        return convertify($converter)->uncast($value);
    }
}
