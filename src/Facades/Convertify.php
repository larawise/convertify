<?php

namespace Larawise\Settingfy\Facades;

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
 * @method static mixed cast(string $key, mixed $value)
 * @method static mixed castWithAlias(string $alias, string $key, mixed $value)
 * @method static mixed extend(string $alias, \Larawise\Convertify\Contracts\ConverterContract $converter)
 * @method static mixed uncast(string $key, mixed $value)
 * @method static mixed uncastWithAlias(string $alias, string $key, mixed $value)
 * @method static array aliases()
 * @method static array all()
 *
 * @see \Larawise\Convertify\Convertify
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
