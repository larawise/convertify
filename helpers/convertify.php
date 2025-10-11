<?php

use Larawise\Convertify\Contracts\ConverterContract;
use Larawise\Convertify\Contracts\FactoryContract;

if (! function_exists('convertify')) {
    /**
     * Get a converter instance by name.
     *
     * @param string|null $converter
     *
     * @return FactoryContract|ConverterContract
     */
    function convertify($converter = null)
    {
        if (is_null($converter)) {
            return app(FactoryContract::class);
        }

        return app(FactoryContract::class)->converter($converter);
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
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
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
