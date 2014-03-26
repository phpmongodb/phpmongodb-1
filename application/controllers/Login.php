<?php

/**
 * @package PHPmongoDB
 * @version 1.0.0
 * @link http://www.phpmongodb.org
 */
defined('PMDDA') or die('Restricted access');

class LoginController extends Controller {

    public function Index() {
        if ($this->request->isPost()) {
            if (Config::$authentication['authentication']) {
                $server = (isset(Config::$server['server']) && !empty(Config::$server['server'])) ? Config::$server['server'] : Config::$server['host'] . ':' . Config::$server['port'];
                $db = $this->request->getParam('db');
                $options = array(
                    'username' => $this->request->getParam('username'),
                    'password' => $this->request->getParam('password'),
                    'db' => !empty($db) ? $db : 'admin',
                );
                $mongo = PHPMongoDB::getInstance($server, $options);
                if ($mongo->getConnection()) {
                    $seesion=Application::getInstance('Session');
                    $seesion->isLogedIn = TRUE;
                    $seesion->server=$server;
                    $seesion->options=$options;
                    $this->request->redirect(Theme::URL('Index/Index'));
                } else {
                    $this->message->error = $mongo->getExceptionMessage();
                }
            } else if ($this->request->getParam('username') == Config::$authentication['user'] && $this->request->getParam('password') == Config::$authentication['password']) {
                $server = (isset(Config::$server['server']) && !empty(Config::$server['server'])) ? Config::$server['server'] : Config::$server['host'] . ':' . Config::$server['port'];
                $seesion=Application::getInstance('Session');
                $seesion->isLogedIn = TRUE;
                $seesion->server=$server;
                $seesion->options=array();
                $this->request->redirect(Theme::URL('Index/Index'));
            } else {
                $this->message->error = I18n::t('AUTH_FAIL');
            }
        }
        $data = array();
        $this->display('index', $data);
    }

    public function Logout() {
        Application::getInstance('Session')->destroy();
        $this->request->redirect(Theme::URL('Login/Index'));
    }

}
