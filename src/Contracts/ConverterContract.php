<?php

namespace Larawise\Convertify\Contracts;

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
interface ConverterContract
{
    /**
     * Determine whether this converter should handle casting for the given key and value.
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return bool
     */
    public function shouldCast($value, $report = false);

    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return mixed
     */
    public function cast($value, $report = false);

    /**
     * Determine whether this converter should handle uncasting for the given key and value.
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return bool
     */
    public function shouldUncast($value, $report = false);

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return mixed
     */
    public function uncast($value, $report = false);
}
