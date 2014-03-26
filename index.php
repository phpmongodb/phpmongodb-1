<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 * @link http://www.phpmongodb.org
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors',1);
define('PMDDA',TRUE);
require(dirname(__FILE__).'/system/Engine.php');
$engine=new Engine();
$engine->start();
$engine->stop();
?>
