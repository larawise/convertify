<?php

namespace Larawise\Convertify;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Larawise\Convertify\Contracts\ConverterContract;
use Larawise\Convertify\Contracts\FactoryContract;
use Larawise\Convertify\Converter\CryptConverter;
use Larawise\Convertify\Converter\StackConverter;
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
class ConvertifyManager implements FactoryContract
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The array of resolved convertify converters.
     *
     * @var array
     */
    protected $converters = [];

    /**
     * The registered custom converter creators.
     *
     * @var array
     */
    protected $customCreators = [];

    /**
     * Create a new convertify manager instance.
     *
     * @param Application $app
     *
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Call a custom converter creator.
     *
     * @param array $config
     *
     * @return ConverterContract
     */
    protected function callCustomCreator(array $config)
    {
        return $this->customCreators[$config['converter']]($this->app, $config);
    }

    /**
     * Get a converter instance by name.
     *
     * @param string|null $name
     *
     * @return ConverterContract
     */
    public function converter(string $name = null)
    {
        $name = $name ?: $this->getDefaultConverter();

        return $this->converters[$name] ??= $this->resolve($name);
    }

    /**
     * Resolve a converter instance from config or custom creator.
     *
     * @param string $name
     * @param array|null $config
     *
     * @return ConverterContract
     */
    protected function resolve(string $name, array $config = null): ConverterContract
    {
        // If no config is passed, load it from the Laravel config file.
        $config ??= $this->getConfig($name);

        // If the config doesn't contain a 'driver' key, we can't resolve anything.
        if (empty($config['converter'])) {
            throw new ConvertifyException("Convertify [{$name}] does not have a configured converter.");
        }

        // Extract the driver name (e.g. 'json', 'slug') from the config.
        $converter = $config['converter'];

        // If a custom converter creator has been registered for this driver, use it.
        if (isset($this->customCreators[$converter])) {
            return $this->callCustomCreator($config);
        }

        // Build the method name for the native driver creator (e.g. 'createJsonDriver').
        $converterMethod = 'create' . ucfirst($converter) . 'Converter';

        // If the method doesn't exist, this driver is not supported.
        if (! method_exists($this, $converterMethod)) {
            throw new ConvertifyException("Converter [{$converter}] is not supported.");
        }

        // Call the native driver creator method and return the converter instance.
        return $this->{$converterMethod}($config, $name);
    }

    public function createStackConverter($config, $name)
    {
        $aliases = $config['stack'] ?? [];

        if (! is_array($aliases) || empty($aliases)) {
            throw new ConvertifyException("Stack converter [$name] must define a non-empty 'stack' array.");
        }

        $chain = [];

        foreach ($aliases as $alias) {
            $chain[] = $this->converter($alias);
        }

        return new StackConverter($chain);
    }

    public function createCryptConverter($config, $name)
    {
        return new CryptConverter($config);
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
        $this->customCreators[$converter] = $callback;

        return $this;
    }

    /**
     * Get the convertify converter configuration.
     *
     * @param string $name
     *
     * @return array
     */
    protected function getConfig($name)
    {
        return $this->app['config']["convertify.converters.{$name}"] ?: [];
    }

    /**
     * Get the default converter name.
     *
     * @return string
     */
    protected function getDefaultConverter()
    {
        return $this->app['config']['convertify.default'];
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
