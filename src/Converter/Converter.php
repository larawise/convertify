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
abstract class Converter implements ConverterContract
{
    /**
     * Create a new converter instance.
     *
     * @param array $config
     *
     * @return void
     */
    public function __construct(
        protected array $config = []
    ) { }

    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    abstract public function cast($value);

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param mixed $value
     *
     * @return mixed
     */
    abstract public function uncast($value);

    /**
     * Determine whether this converter should handle casting for the given key and value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    abstract public function shouldCast($value);

    /**
     * Determine whether this converter should handle uncasting for the given key and value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    abstract public function shouldUncast($value);
}
