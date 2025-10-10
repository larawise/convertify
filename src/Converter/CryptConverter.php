<?php

namespace Larawise\Convertify\Converter;

use Exception;
use Illuminate\Support\Facades\Crypt;
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
class CryptConverter implements Converter
{
    /**
     * Determine if the given value should be encrypted.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldCast($value)
    {
        // Only encrypt string values
        return is_string($value);
    }

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
     * Determine if the given value should be decrypted.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldUncast($value)
    {
        // Heuristic: encrypted strings are usually base64-encoded
        return is_string($value) && base64_decode($value, true) !== false;
    }

    /**
     * Decrypt the given value using Laravel's Crypt facade.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function uncast($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (Exception $e) {
            return $value;
        }
    }
}

