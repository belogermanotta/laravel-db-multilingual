<?php

/**
 * Created by PhpStorm.
 * User: emillion
 * Date: 10/02/2017
 * Time: 2:42
 */

namespace Lionch\Multilingual\Helpers;

use Illuminate\Http\Request;

class HeaderHelper
{

    public const CONTENT_LANGUAGE = 'Content-Language';

    public const ACCEPT_LANGUAGE = 'Accept-Language';

    private static $language = 'en';

    private function __construct()
    {
    }

    public static function getLanguage()
    {
        return static::$language ?? env('DEFAULT_LANGUAGE', 'en');
    }

    public static function setLanguage($language)
    {
        static::$language = $language;
    }

    public static function getRequestLanguage(Request $request)
    {
        $acceptLanguages = $request->header(self::ACCEPT_LANGUAGE);

        if (!$acceptLanguages || empty($acceptLanguages)) {
            return env('DEFAULT_LANGUAGE', 'en');
        }

        $acceptLanguages = explode(',', $acceptLanguages);
        $language = trim(reset($acceptLanguages));

        return $language;
    }

}
