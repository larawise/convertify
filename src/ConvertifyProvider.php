<?php

namespace Larawise\Convertify;

use Larawise\Convertify\Contracts\FactoryContract;
use Larawise\Packagify\Packagify;
use Larawise\Packagify\PackagifyProvider;

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
class ConvertifyProvider extends PackagifyProvider
{
    /**
     * Configure the packagify package.
     *
     * @param Packagify $package
     *
     * @return void
     */
    public function configure(Packagify $package)
    {
        $package->name('convertify')
            ->description('Convertify - Cast anything, anywhere — your way.')
            ->hasHelpers()
            ->hasConfigurations();
    }

    /**
     * Perform actions before the package is registered.
     *
     * @return void
     */
    public function packageRegistering()
    {
        $this->app->singleton(
            FactoryContract::class, fn ($app) => new ConvertifyManager($app)
        );
    }
}
