<?php

namespace Larawise\Convertify\Facades;

use Illuminate\Support\Facades\Facade;

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
 *
 * @method static \Larawise\Convertify\Contracts\ConverterContract converter(string $name = null)
 * @method static mixed cast(mixed $value)
 * @method static bool shouldCast(mixed $value)
 * @method static \Larawise\Convertify\ConvertifyManager extend($converter, \Closure $callback)
 * @method static mixed uncast(mixed $value)
 * @method static bool shouldUncast(mixed $value)
 *
 * @see \Larawise\Convertify\ConvertifyManager
 */
class Convertify extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'convertify';
    }
}
