<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class View {

    protected static $content;
    protected static $message;
    
    /**
     * 
     * @param string $content
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     */
    public static function setContent($content) {

        self::$content = $content;
    }
    /**
     * 
     * @return string
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     */
    public static function getContent() {
        return self::$content;
    }
    /**
     * 
     * @param string $message
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     */
    public static function setMessage($message) {
        self::$message = $message;
    }
    
    /**
     * 
     * @return string
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     */
    public static function getMessage() {
        return self::$message;
    }

}