<?php

namespace Larawise\Convertify\Converter;

use Exception;
use Illuminate\Support\Facades\Crypt;
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
class CryptConverter extends Converter
{
    /**
     * Encrypt the given value using Laravel's Crypt facade.
     *
     * @param mixed $value
     *
     * @return string
     */
    public function cast($value)
    {
        return Crypt::encryptString($value);
    }

    /**
     * Decrypt the given value using Laravel's Crypt facade.
     *
     * @param mixed $value
     *
     * @return string
     */
    public function uncast($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (Exception $e) {
            return $value;
        }
    }

    /**
     * Determine if the given value should be encrypted.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldCast($value)
    {
        $castable = is_string($value);

        if (! $castable && $this->config['report']) {
            throw new ConvertifyException("Cannot cast non-string value: [$value]");
        }

        return $castable;
    }

    /**
     * Determine if the given value should be decrypted.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldUncast($value)
    {
        $uncastable = is_string($value) && base64_decode($value, true) !== false;

        if (! $uncastable && $this->config['report']) {
            throw new ConvertifyException("Cannot uncast non-base64 string: [$value]");
        }

        return $uncastable;
    }
}
