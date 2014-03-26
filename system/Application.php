<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class Application extends Data {

    /**
     * @param void
     * @return void
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     * @access public
     */
    const DEFAULT_CONTROLLER = 'Index';
    const LOGIN_CONTROLLER = 'Login';
    const DEFAULT_ACTION = 'Index';
    protected static $_isReadOnly=NULL;

    public function init() {
        
        $chttp = new CHttp();
        $session=self::getInstance('Session');
        $session->start();
        $session->setDefaultKey();
        if (!$session->isLogedIn()) {
            $this->controller = self::LOGIN_CONTROLLER;
            $this->action = self::DEFAULT_ACTION;
        } else {

            $load = $chttp->getParam('load');
            if (!empty($load)) {
                $load = explode('/', $load);
                $this->controller = !empty($load[0]) ? $load[0] : self::DEFAULT_CONTROLLER;
                $this->action = !empty($load[1]) ? $load[1] : self::DEFAULT_ACTION;
            }
        }
        self::$_isReadOnly=(isset(Config::$authorization['readonly']) && !empty(Config::$authorization['readonly']))?TRUE:FALSE;
        if (!isset($this->controller)) {
            $this->controller = self::DEFAULT_CONTROLLER;
        }
        if (!isset($this->action)) {
            $this->action = self::DEFAULT_ACTION;
        }
        $this->theme = $chttp->getParam('theme');
        $this->theme = (empty($this->theme) ? TRUE : (strtolower($this->theme) == 'false' ? FALSE : TRUE));
    }

    public static function getInstance($class) {
        return new $class();
    }
    public static function isReadonly(){
        return self::$_isReadOnly;
    }

}
