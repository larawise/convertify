<?php

namespace Larawise\Convertify\Converter;

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
class StackConverter extends Converter
{
    /**
     * List of converters to apply in sequence.
     *
     * @var Converter[]
     */
    protected $chain = [];

    /**
     * Create a new stack converter instance.
     *
     * @param Converter[] $chain
     *
     * @return void
     */
    public function __construct(array $chain = [])
    {
        parent::__construct($chain);

        $this->chain = $chain;
    }

    /**
     * Convert a raw external value into its appropriate PHP-native type.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function cast($value)
    {
        foreach ($this->chain as $converter) {
            $value = $converter->cast($value);
        }

        return $value;
    }

    /**
     * Convert a PHP-native value into a storable format (e.g. string, JSON).
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function uncast($value)
    {
        foreach ($this->chain as $converter) {
            $value = $converter->uncast($value);
        }

        return $value;
    }

    /**
     * Determine whether this converter should handle casting for the given key and value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldCast($value)
    {
        foreach ($this->chain as $converter) {
            if ($converter->shouldCast($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether this converter should handle uncasting for the given key and value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldUncast($value)
    {
        foreach ($this->chain as $converter) {
            if ($converter->shouldUncast($value)) {
                return true;
            }
        }

        return false;
    }
}
