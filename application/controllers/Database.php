<?php

/**
 * @package PHPmongoDB
 * @version 1.0.0
 * @link http://www.phpmongodb.org
 */
defined('PMDDA') or die('Restricted access');

class DatabaseController extends Controller {

    protected $model = FALSE;

    public function getModel() {
        if (!($this->model instanceof Database)) {
            return $this->model = new Database();
        } else {
            return $this->model;
        }
    }

    public function Index() {
        $dbList = $this->getModel()->listDatabases();
        $data = array(
            'dbList' => $dbList
        );


        $this->display('index', $data);
    }

    public function Create() {
        $this->isReadonly();
        $this->display('create');
    }

    public function Update() {
        $this->isReadonly();
        $db = urldecode($this->request->getParam('db'));
        $oldDb = urldecode($this->request->getParam('old_db'));
        if (!empty($db) || !empty($oldDb)) {
            $response = $this->getModel()->renameDatabase($oldDb, $db);
            if ($response['ok'] == 1)
                $this->message->sucess = I18n::t('D_R_S');
            else
                $this->message->error = $response;
            
        } else {
            $this->message->error = I18n::t('I_D_N');
        }
        $this->gotoDatabse();
    }

    public function Save() {
        $this->isReadonly();
        $db = $this->request->getParam('db');

        if (!empty($db)) {
            $response = $this->getModel()->createDB($db);
            if ($response['ok'] == 1)
                $this->message->sucess = I18n::t('D_C', $db);
            else
                $this->message->error = $response;
        } else {
            $this->message->error = I18n::t('E_D_N');
        }
        $this->gotoDatabse();
    }

    public function Drop() {
        $this->isReadonly();
        $db = $this->request->getParam('db');
        if (!empty($db)) {
            $response = $this->getModel()->dropDatabase($db);
            if ($response['ok'] == 1)
                $this->message->sucess = I18n::t('D_D', $db);
            else
                $this->message->error = $response;
        }
        $this->gotoDatabse();
    }

    protected function gotoDatabse() {
        $this->request->redirect(Theme::URL('Database/Index'));
    }

}
