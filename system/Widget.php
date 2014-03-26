<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class Widget {

    protected static $controller = 'WidgetController';
    protected static $prefix = 'get';

    public static function setController($controller='WidgetController') {
        self::$controller=$controller;
    }
    public static function setPrefix($prefix='get'){
        self::$prefix;
    }

    public static function get() {
        if (func_num_args() < 1)
            return false;
        return call_user_func(array(new self::$controller, self::$prefix . func_get_arg(0)));
    }

}