<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class Controller {

    protected $data = array();
    protected $message;
    protected $application;
    protected $request;

    public function setProperties($application, $message) {
        $this->application = $application;
        $this->message = $message;
        $this->request = new CHttp();
    }

    public function isError() {
        if (error_get_last()) {
            $error = error_get_last();
            $this->message->error = $error['message'].'<br>'.$error['file'];
            return TRUE;
        }
        return FALSE;
    }

    protected function display($view = '', $data = array()) {
        $this->application->view = $view;
        $this->data = $data;
        $this->callView();
    }

    private function callView() {
        try {
            $view = getcwd() . '/application/views/' . $this->application->controller . '/' . $this->application->view . '.php';
            if (!is_readable($view)) {
                throw new Exception('Controller cannot find the view file ' . $view);
            } else {
                View::setMessage($this->message);
                ob_start();
                require_once ($view);
                View::setContent(ob_get_clean());
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    protected function view() {
        $this->callView();
    }

    public function isValidName($name) {
        return TRUE;
        //return !preg_match('/[\/\. "*<>:|?\\\\]/', $name);
    }

    public function getModel() {
        return new Model();
    }
    public function isReadonly(){
        if(Application::isReadonly()){
            $this->message->error = I18n::t('I_A');
            $this->request->redirect(Theme::URL('Index/Index'));
        }
    }

    protected function debug($array) {
        echo "<pre>";
        print_r($array);
        echo "<pre>";
    }

    protected function getInclude() {
        $included_files = get_included_files();

        $this->debug($included_files);
    }

}

?>