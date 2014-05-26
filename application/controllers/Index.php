<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 * @link http://www.phpmongodb.org
 */
defined('PMDDA') or die('Restricted access');
class IndexController extends Controller{
    public function Index(){
        $data=array(
            'phpversion'=>phpversion(),
            'webserver'=>$this->request->serverSoftware(),
            'mongoinfo'=>  $this->getModel()->getMongoInfo(),
        );
       
        $this->display('index',$data);
    }
    public function SetLanguage(){
        $this->isReadonly();
        $language= $this->request->getParam('language');
        $languages=Config::$language;
        //$this->debug($languages);
        if(array_key_exists($language,$languages)){
            $session=new Session();
           $session->language=$language;
        }else{
            $this->message->error = I18n::t('LAN_NOT_AVA');
        }
        $this->request->redirect($_SERVER['HTTP_REFERER']);
    }
    public function Status(){
        $model=new Model();
        $status=$model->serverStatus();
        $data=array(
            'status'=>$status,
            'cryptography'=>new Cryptography(),
        );
        //$this->display('status', $data);
        
    }
}