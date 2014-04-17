<?php

/**
 * @author Nanhe Kumar <nanhe.kumar@gmail.com>
 * @version 1.0.0
 * @package PHPMongoDB
 */

class Config {

    public static $theme = 'default';
    public static $autocomplete=false;
    public static $language = array(
        'english' => 'English',
        'german' => 'German',
    );
    public static $server=array(
        'name' => "Localhost",
        'server'=>false,
        'host' => "127.0.0.1",
        'port'=>"27017",
        'timeout'=>0,
    );
    public static $authentication = array(
        'authentication'=>false,
        'user' => 'admin',
        'password' => 'admin'
    );
    public static $authorization = array(
        'readonly'=>false,
    );

    /**
     *
     * @var array
     * @link http://in2.php.net/manual/en/mongoclient.construct.php (for more detail)
     */
    public static $connection = array(
        'server' => "", //mongodb://localhost:27017
        'options' => array(
            'replicaSet' => false,
        ), //
    );

}

?>
