<?php
namespace vektah\common\json;



class Json
{
    /**
     * Encode a value into a json string
     *
     * @param mixed $value
     * @throws InvalidJsonException
     * @return string
     */
    public static function encode($value)
    {
        $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($err = json_last_error()) {
            throw new InvalidJsonException($err);
        }
        return $json;
    }

    /**
     * Encode a value into a json string with pretty whitespace
     *
     * @param mixed $value
     * @throws InvalidJsonException
     * @return string
     */
    public static function pretty($value)
    {
        $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($err = json_last_error()) {
            throw new InvalidJsonException($err);
        }
        return $json;
    }

    /**
     * Decode a json string into an array
     *
     * @param string $json
     * @throws InvalidJsonException
     * @return array
     */
    public static function decode($json)
    {
        $data = json_decode($json, true, 512);
        if ($err = json_last_error()) {
            throw new InvalidJsonException($err);
        }
        return $data;
    }
}
