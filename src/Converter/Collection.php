<?php

namespace Larawise\Convertify\Converter;

use Illuminate\Support\Collection as IlluminateCollection;
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
class Collection implements ConverterContract
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
        return is_array($value);
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
        return collect($value);
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
        return $value instanceof IlluminateCollection;
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
        return $value->all();
    }
}