<?php

namespace Larawise\Convertify\Converter;

use Larawise\Convertify\Contracts\ConverterContract;

/**
 * Srylius - The ultimate symphony for technology architecture!
 *
 * @package     Larawise
 * @subpackage  Convertify
 * @version     v1.0.0
 * @author      Selçuk Çukur <hk@selcukcukur.com.tr>
 * @copyright   Srylius Teknoloji Limited Şirketi
 *
 * @see https://docs.larawise.com/ Larawise : Docs
 */
class Boolean implements ConverterContract
{
    /**
     * Determine whether this converter should handle casting for the given key and value.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldCast(string $key, $value)
    {
        return is_string($value) && in_array(strtolower($value), ['true', 'false', '1', '0'], true);
    }

    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function cast(string $key, $value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Determine whether this converter should handle uncasting for the given key and value.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldUncast(string $key, $value)
    {
        return is_bool($value);
    }

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function uncast(string $key, $value)
    {
        return $value ? 'true' : 'false';
    }
}