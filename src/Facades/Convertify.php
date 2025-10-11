<?php

namespace Larawise\Convertify\Facades;

use Illuminate\Support\Facades\Facade;
use Larawise\Convertify\Contracts\FactoryContract;

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
 * @method static mixed cast(mixed $value, bool $report = false)
 * @method static bool shouldCast(mixed $value, bool $report = false)
 * @method static \Larawise\Convertify\Contracts\FactoryContract extend($converter, \Closure $callback)
 * @method static mixed uncast(mixed $value, bool $report = false)
 * @method static bool shouldUncast(mixed $value, bool $report = false)
 *
 * @see \Larawise\Convertify\Contracts\FactoryContract
 * @see \Larawise\Convertify\Contracts\ConverterContract
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
        return FactoryContract::class;
    }
}
