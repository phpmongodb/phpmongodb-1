<?php

/**
 * @package PHPmongoDB
 * @version 1.0.0
 * @link http://www.phpmongodb.org
 */
defined('PMDDA') or die('Restricted access');

class ServerController extends Controller {
    
    public function Execute(){
        $response=NULL;
        $model=new Database();
        if($this->request->isPost())
        {
            $code = trim($this->request->getParam('code'));
            $db = trim($this->request->getParam('db'));
            $response=$model->execute($db,$code);
        }
        $dbList=$model->listDatabases();
        if (!isset($dbList['databases'])) {
            $dbList=Helper::getLoginDatabase();
        }
        
        $this->display('execute',array(
                                        'databases'=>$dbList,
                                        'code' =>isset($code)?$code:'db.getCollectionNames()',
                                        'response'=>$response
                                    )
                );
    }
    
}