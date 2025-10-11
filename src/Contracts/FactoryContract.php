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
interface FactoryContract
{
    /**
     * Get a converter instance by name.
     *
     * @param string|null $name
     *
     * @return ConverterContract
     */
    public function converter($name = null);

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
