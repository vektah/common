<?php

namespace vektah\common\json;

class InvalidJsonException extends \Exception
{
    private static $messages = [
        JSON_ERROR_NONE => 'No error has occurred',
        JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded',
        JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON',
        JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
        JSON_ERROR_SYNTAX => 'Syntax error',
        JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded',
    ];

    public function __construct($json_code) {
        $message = $json_code;
        if (isset(self::$messages[$json_code])) {
            $message = self::$messages[$json_code];
        }

        parent::__construct($message);
    }

    const _CLASS = __CLASS__;
}
