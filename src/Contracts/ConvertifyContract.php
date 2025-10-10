<?php

namespace Larawise\Convertify\Contracts;

use Larawise\Convertify\Exceptions\ConvertifyException;

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
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function cast($key, $value);

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
    public function castWithAlias($alias, $key, $value);

    /**
     * Register a converter with a named alias.
     *
     * @param string $alias
     * @param ConverterContract $converter
     *
     * @return void
     */
    public function extend($alias, ConverterContract $converter);

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     * @throws ConvertifyException
     */
    public function uncast($key, $value);

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
    public function uncastWithAlias($alias, $key, $value);

    /**
     * Get a list of all registered converter aliases.
     *
     * @return string[]
     */
    public function aliases();

    /**
     * Get all registered converters as an associative array.
     *
     * @return array<string, ConverterContract>
     */
    public function all();
}
