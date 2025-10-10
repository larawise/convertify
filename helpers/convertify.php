<?php

use Larawise\Convertify\Contracts\ConvertifyContract;
use Larawise\Convertify\Exceptions\ConvertifyException;

if (! function_exists('convertify')) {
    /**
     * Get / set the specified setting value.
     *
     * @param array<string, mixed>|string|null $key
     * @param mixed $default
     *
     * @return ConvertifyContract
     */
    function convertify($key = null, $default = null)
    {
        return app('convertify');
    }
}

if (! function_exists('cast')) {
    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    function cast($key, $value)
    {
        return convertify()->cast($key, $value);
    }
}

if (! function_exists('castWithAlias')) {
    /**
     * Cast a raw value into a PHP-native format using a specific converter alias.
     *
     * @param string $alias
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     * @throws ConvertifyException
     */
    function castWithAlias($alias, $key, $value)
    {
        return convertify()->castWithAlias($alias, $key, $value);
    }
}

if (! function_exists('uncast')) {
    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    function uncast($key, $value)
    {
        return convertify()->uncast($key, $value);
    }
}

if (! function_exists('uncastWithAlias')) {
    /**
     * Serialize a PHP-native value using a specific converter alias.
     *
     * @param string $alias
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     * @throws ConvertifyException
     */
    function uncastWithAlias($alias, $key, $value)
    {
        return convertify()->uncastWithAlias($alias, $key, $value);
    }
}
