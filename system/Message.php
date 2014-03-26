<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');
class Message {

    const KEY = 'PMD_MESSAGE';

    protected $session;
    protected $message = NULL;
    protected $messageValue;
    protected $messageKeyGet;
    protected $messageKeySet;
    protected $messageValueSet;

    public function __construct() {
        $this->session=Application::getInstance('Session');
        if(!isset($this->session->{self::KEY})){
            $this->session->{self::KEY}=array();
        }
    }

    public function get($return = TRUE) {
        if (empty($this->message)) {
            $this->message = $this->session->{self::KEY};
        }
        if ($return)
            return $this->message;
    }

    public function set($value) {
        $this->session->{self::KEY} = $value;
    }

    public function __get($name) {
        $this->messageKeyGet = $name;
        $this->get(FALSE);
        if (is_array($this->message) && array_key_exists($name, $this->message)) {
            $this->messageValue = $this->message[$name];
            $this->__unset($name);
            return $this->messageValue;
        }
    }

    public function __set($name, $value) {
        $this->messageKeySet = $name;
        $this->messageValueSet = $value;
        $this->get(FALSE);
        $this->message[$name] = $value;
        $this->set($this->message);
    }

    public function __isset($name) {
        if(isset($this->session->{self::KEY})){
            $this->get(FALSE);
            return isset($this->message[$name]);
        }else{
            return false;
        }
    }

    public function __unset($name) {
        $this->get(FALSE);
        if (is_array($this->message)) {
            unset($this->message[$name]);
            $this->set($this->message);
        }
    }

    public function __call($name, $arguments) {
        $action = substr($name, 0, 3);
        if ($action == 'get') {
            if (isset($name[3])){
                $property = strtolower($name[3]) . substr($name, 4);
                if(property_exists($this,$property)){
                    return $this->{$property};
                }
            }
        }
        $trace = debug_backtrace();
        trigger_error('Undefined property via method: ' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
        return null;
    }

}

?>
