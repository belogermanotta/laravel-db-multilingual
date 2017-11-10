<?php

/**
 * Created by PhpStorm.
 * User: emillion
 * Date: 10/02/2017
 * Time: 12:12
 */

namespace Lionch\Multilingual\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Lionch\Multilingual\Helpers\HeaderHelper;

class LanguageMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = HeaderHelper::getRequestLanguage($request);
        HeaderHelper::setLanguage($language);
        App::setLocale($language);

        return $next($request);
    }

}
