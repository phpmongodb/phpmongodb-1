<?php

/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class PHPMongoDB {

    protected static $instance = null;
    protected $mongo;
    protected $exception;

    /**
     * @param string $server [optional]
     * @param array $options [optional]
     * @return mixed (Object of MongoClient|Mongo
     */
    public static function getInstance($server = '', array $options = array()) {
        if (is_null(self::$instance) ) {
            self::$instance = new self($server, $options);
        }

        return self::$instance;
    }

    /**
     * 
     * @return mixed (Object of MongoClient|Mongo
     */
    public function getConnection() {
        return $this->mongo;
    }
    public function getExceptionMessage(){
        if($this->exception instanceof Exception){
            return $this->exception->getMessage() ;
        }
        return FALSE;
    }

    /**
     * 
     * @param string $server  [optional]
     * @param array $options [optional]
     */
    private function __construct($server = '', array $options = array()) {

        try {
            if (class_exists("MongoClient")) {
                $this->mongo = new MongoClient($server, $options);
            } else {
                $this->mongo = new Mongo($server, $options);
            }
        } catch (Exception $e) {
            $this->exception=$e;
            $this->mongo =FALSE;
           
        }
    }

}

?>
