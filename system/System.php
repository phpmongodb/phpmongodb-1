<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class System {

    protected $application;

    public function start() {
        $this->application = new Application();
        $this->application->init();
        $this->application();
    }
    public function isTheme(){
        return $this->application->theme;
    }

    protected function getObject($class) {
        return new $class;
    }

    protected function getProperties() {
        return array(
            'application' => $this->application,
            'message' => new Message,
        );
    }

    protected function application() {

        try {
            $controller = $this->getObject($this->application->controller . 'Controller');

            if (method_exists($controller, 'setProperties')) {

                call_user_func_array(array($controller, 'setProperties'), $this->getProperties());
            }
            if (method_exists($controller, $this->application->action)) {

                call_user_func(array($controller, $this->application->action));
            } else {
                throw new Exception('Method  ' . $this->application->action . ' doe not exitst');
            }
           
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
            exit();
        }
    }
    public function getTheme() {
        try {
            $theme = getcwd() . '/application/themes/'.Config::$theme.'/index.php';
            if (!file_exists($theme)) {
                throw new Exception('Controller cannot find the Theme file ' . $theme);
            } else {
                require_once $theme;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }
    function getView(){
        echo View::getContent();
    }

}

?>