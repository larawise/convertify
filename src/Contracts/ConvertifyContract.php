<?php

namespace Larawise\Convertify\Contracts;

use Closure;

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
interface ConvertifyContract
{
    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function cast($value);

    /**
     * Get a converter instance by name.
     *
     * @param string|null $name
     *
     * @return ConverterContract
     */
    public function converter(string $name = null);

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function uncast($value);

    /**
     * Register a custom converter creator.
     *
     * @param string $converter
     * @param Closure $callback
     *
     * @return $this
     */
    public function extend($converter, Closure $callback);
}
