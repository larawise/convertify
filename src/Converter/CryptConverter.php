<?php

namespace Larawise\Convertify\Converter;

use Exception;
use Illuminate\Support\Facades\Crypt;
use Larawise\Convertify\Contracts\ConverterContract as Converter;
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
class CryptConverter implements Converter
{
    /**
     * Determine if the given value should be encrypted.
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return bool
     */
    public function shouldCast($value, $report = false)
    {
        $castable = is_string($value);

        if (! $castable && $report) {
            throw new ConvertifyException("Cannot cast non-string value: [$value]");
        }

        return $castable;
    }

    /**
     * Encrypt the given value using Laravel's Crypt facade.
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return mixed
     */
    public function cast($value, $report = false)
    {
        return Crypt::encryptString($value);
    }

    /**
     * Determine if the given value should be decrypted.
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return bool
     */
    public function shouldUncast($value, $report = false)
    {
        $uncastable = is_string($value) && base64_decode($value, true) !== false;

        if (! $uncastable && $report) {
            throw new ConvertifyException("Cannot uncast non-base64 string: [$value]");
        }

        return $uncastable;
    }

    /**
     * Decrypt the given value using Laravel's Crypt facade.
     *
     * @param mixed $value
     * @param bool $report
     *
     * @return mixed
     */
    public function uncast($value, $report = false)
    {
        try {
            return Crypt::decryptString($value);
        } catch (Exception $e) {
            return $value;
        }
    }
}

