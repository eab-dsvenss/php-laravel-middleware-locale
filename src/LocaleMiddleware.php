<?php

namespace se\wb\site\Http\Middleware;

use Closure;
use se\eab\php\laravel\util\locale\LocaleHelper;
use \Illuminate\Http\Request;
use se\eab\php\laravel\util\url\UrlHelper;
use se\eab\php\laravel\util\url\RedirectContainer;

class LocaleMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        try {
            /**
             * @var LocaleHelper
             */
            $lh = LocaleHelper::getInstance();
            /**
             * @var UrlHelper 
             */
            $uh = UrlHelper::getInstance();
            $locale = $lh->getRequestLocale($request);
            
            if (!$lh->isValidLocale($locale)) {
                $path = $uh->getLocalizedPath($request->path(), $lh->getDefaultLocale());
                $rc = new RedirectContainer($request, $path, true, false);
                return $uh->performRedirect($rc);
            }
            $lh->setLocale($locale);
            
        } catch (Exception $e) {
            report($e);
        }

        return $next($request);
    }

}
