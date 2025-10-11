<?php

namespace Larawise\Convertify;

use Closure;
use Larawise\Convertify\Contracts\ConverterContract;
use Larawise\Convertify\Contracts\ConvertifyContract;

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
class Convertify implements ConvertifyContract
{
    /**
     * Create a new convertify instance.
     *
     * @param ConvertifyManager $convertify
     *
     * @return void
     */
    public function __construct(
        protected ConvertifyManager $convertify
    ) { }

    /**
     * Get a converter instance by name.
     *
     * @param string|null $name
     *
     * @return ConverterContract
     */
    public function converter($name = null)
    {
        return $this->convertify->converter($name);
    }

    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function cast($value, $report = false)
    {
        if ($this->convertify->shouldCast($value, $report)) {
            $value = $this->convertify->cast($value, $report);
        }

        return $value;
    }

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return mixed
     */
    public function uncast($value, $report = false)
    {
        if ($this->convertify->shouldUncast($value, $report)) {
            $value = $this->convertify->uncast($value, $report);
        }

        return $value;
    }

    /**
     * Register a custom converter creator.
     *
     * @param string $converter
     * @param Closure $callback
     *
     * @return $this
     */
    public function extend($converter, Closure $callback)
    {
        return $this->convertify->extend($converter, $callback);
    }

    /**
     * Dynamically proxy method calls to the default converter.
     *
     * @param string $method
     * @param array $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->converter()->$method(...$parameters);
    }
}
