<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class I18n {
    const DEFAULT_LANGUAGE='english';

    protected static $language = NULL;

    protected static function init() {
        if (!is_array(self::$language)) {
            $session=Application::getInstance('Session');
            $language= isset($session->language)?$session->language:self::DEFAULT_LANGUAGE ;
            require_once getcwd() . '/application/language/'.$language.'.php';
            self::$language = $language;
        }
    }

    public static function t() {
        self::init();
        $k = func_get_arg(0);
        $message = array_key_exists($k, self::$language) ? self::$language[$k] : $k;
        $numargs = func_num_args();
        for ($i = 1; $i < $numargs; $i++) {
            $message = preg_replace('/%s/', func_get_arg($i), $message, 1);
        }
        return $message;
    }

    public static function p($k) {
        echo self::t($k);
    }

}

?>
