<?php

namespace Larawise\Convertify;

use Larawise\Convertify\Contracts\ConverterContract as Converter;

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
class StackConverter implements Converter
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
     * @param array $chain
     *
     * @return void
     */
    public function __construct(array $chain = [])
    {
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
            // Only apply the converter if it declares support for this value.
            if ($converter->shouldCast($value)) {
                $value = $converter->cast($value);
            }
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
            // Only apply the converter if it declares support for this value.
            if ($converter->shouldUncast($value)) {
                $value = $converter->uncast($value);
            }
        }

        return $value;
    }
}
