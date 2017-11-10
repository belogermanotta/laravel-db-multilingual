<?php

/**
 * Created by PhpStorm.
 * User: emillion
 * Date: 11/11/2017
 * Time: 3:33 AM
 */

namespace Lionch\Multilingual\Exceptions;

class MultilingualException extends \Exception
{
    /**
     * Exceptions constructor.
     */
    public function __construct($message = null, $code = 500)
    {
        $this->message = $message;
        $this->code = $code;
    }
}