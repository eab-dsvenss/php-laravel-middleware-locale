<?php
namespace se\eab\php\laravel\middleware\locale\route;

use se\eab\php\laravel\util\locale\LocaleHelper;
use Route;
/**
 * Description of RouteHelper
 *
 * @author dsvenss
 */
class RouteHelper
{
    private static $instance;
    private $lh;
    
    
    private function __construct() {
        $this->lh = LocaleHelper::getInstance();
    }
    
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new RouteHelper();
        }
        
        return self::$instance;
    }
    
    public function getLocalizedGetRoute($path, $action) {
        Route::get($path, $action);
        $locales = $this->lh->getAvailableLocales();
        foreach ($locales as $locale) {
            Route::get($locale . "/" . $path, $action);
        }        
    }
}
