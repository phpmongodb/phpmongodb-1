<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class Engine {

    protected $system;

    public function __construct() {
        $this->environmentDetection();
        $this->load();
    }

    public function start() {

        $this->system = new System();
        $this->system->start();
    }

    public function stop() {
        if ($this->system->isTheme()) {
            $this->system->getTheme();
        } else {
            $this->system->getView();
        }
    }

    public function environmentDetection() {
       
        if (!version_compare(PHP_VERSION, "5.0")) {
            exit("To make things right, you must install PHP5");
        }
        if (!class_exists("Mongo") && !class_exists("MongoClient")) {
            exit("To make things right, you must install php_mongo module. <a href=\"http://www.php.net/manual/en/mongo.installation.php\" target=\"_blank\">Here for installation documents on PHP.net.</a>");
        }
    }

    public function load() {
        self::loadConfig();
        spl_autoload_register('self::autoloadSystem');
        spl_autoload_register('self::autoloadController');
        spl_autoload_register('self::autoloadModel');
    }

    public static function loadConfig() {
        $fileWithPath = getcwd() . '/config.php';
        self::includes($fileWithPath);
    }

    public static function autoloadSystem($class) {

        $fileWithPath = dirname(__FILE__) . '/' . $class . '.php';
        self::includes($fileWithPath);
    }

    public static function autoloadController($class) {
        $fileWithPath = getcwd() . '/application/controllers/' . str_replace('Controller', '', $class) . '.php';
        self::includes($fileWithPath);
    }

    public static function autoloadModel($class) {
        $fileWithPath = getcwd() . '/application/models/' . $class . '.php';
        self::includes($fileWithPath);
    }

    public static function includes($fileWithPath) {
        if (is_readable($fileWithPath)) {
            require_once ($fileWithPath);
        }
    }

}

?>