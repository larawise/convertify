<?php

namespace Larawise\Convertify;

use Larawise\Convertify\Contracts\ConverterContract as Converter;
use Larawise\Convertify\Contracts\ConvertifyContract;
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
class Convertify implements ConvertifyContract
{
    /**
     * Registered converters mapped by alias.
     *
     * @var array<string, Converter>
     */
    protected $converters = [];

    /**
     * Create a new convertify instance.
     *
     * @param array<string, Converter> $converters
     *
     * @return void
     */
    public function __construct(array $converters = [])
    {
        $this->converters = $converters;
    }

    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    public function cast($key, $value)
    {
        foreach ($this->converters as $alias => $converter) {
            $instance = $this->resolveConverter($alias);

            if ($instance->shouldCast($key, $value)) {
                return $instance->cast($key, $value);
            }
        }

        throw new ConvertifyException("No converter found to cast key [$key]");
    }

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
    public function castWithAlias($alias, $key, $value)
    {
        $converter = $this->resolveConverter($alias);

        return $converter->cast($key, $value);
    }

    /**
     * Register a converter with a named alias.
     *
     * @param string $alias
     * @param Converter $converter
     *
     * @return void
     */
    public function extend($alias, Converter $converter)
    {
        $this->converters[$alias] = $converter;
    }

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     * @throws ConvertifyException
     */
    public function uncast($key, $value)
    {
        foreach ($this->converters as $alias => $converter) {
            $instance = $this->resolveConverter($alias);

            if ($instance->shouldUncast($key, $value)) {
                return $instance->uncast($key, $value);
            }
        }

        throw new ConvertifyException("No converter found to uncast key [$key]");
    }

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
    public function uncastWithAlias($alias, $key, $value)
    {
        $converter = $this->resolveConverter($alias);

        return $converter->uncast($key, $value);
    }

    /**
     * Resolve and return the converter instance registered under a specific alias.
     *
     * @param string $alias
     *
     * @return Converter
     * @throws ConvertifyException
     */
    protected function resolveConverter($alias)
    {
        $converter = $this->converter($alias);

        if (! $converter) {
            throw new ConvertifyException("No converter registered for alias [$alias]");
        }

        return new $converter;
    }

    /**
     * Get the converter instance registered under a specific alias.
     *
     * @param string $alias
     *
     * @return Converter|null
     */
    protected function converter($alias)
    {
        return $this->converters[$alias] ?? null;
    }

    /**
     * Get a list of all registered converter aliases.
     *
     * @return string[]
     */
    public function aliases()
    {
        return array_keys($this->converters);
    }

    /**
     * Get all registered converters as an associative array.
     *
     * @return array<string, Converter>
     */
    public function all()
    {
        return $this->converters;
    }
}
