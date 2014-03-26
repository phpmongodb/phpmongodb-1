<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

abstract class Data {

    protected $data = array();

    /**
     * 
     * @param mixed $name
     * @return mixed
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     * @access public
     */
    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        $trace = debug_backtrace();
        trigger_error('Undefined property via __get(): ' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'], E_USER_NOTICE);
        return null;
    }

    /**
     * 
     * @param string $name
     * @param mixed $value
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     * @access public
     */
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     * @access public
     */
    public function __isset($name) {
        return isset($this->data[$name]);
    }

    /**
     * 
     * @param mixed $name
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     * @access public
     */
    public function __unset($name) {
        unset($this->data[$name]);
    }

}