<?php
defined('PMDDA') or die('Restricted access');
class WidgetController extends Controller {
    

    public function getDBList(){
        $model=new Model();      
        $dbList= $model->listDatabases();
        if(!$dbList) {
            $session = Application::getInstance('Session');
            $db = $session->options['db'];
            $dbList['databases'] = [['name' => $db, 'noOfCollecton' => '?']];
            return $dbList;
        }
       foreach ($dbList['databases'] as $k=>$db) {
           $dbList['databases'][$k]['noOfCollecton'] =count($model->listCollections($db['name'], TRUE));
       }
       return $dbList;
    }
     public function getCollectonList() {
        $chttp=new Chttp();
        $db = $chttp->getParam('db');
        if (!empty($db)) {
            $model = new Model(); 
            $collections = $model->listCollections($db, TRUE);
           
            $collectionList = array();
            foreach ($collections as $collection) {
                try {
                    $count = $collection->count();
                }
                catch(Exception $e) {
                    $count = "?";
                }
                $collectionList[] = array('name' => $collection->getName(), 'count' => $count);
            }
            return $collectionList;
        } else {
            return FALSE;
        }
    }
    public function getLanguageList(){
        return Config::$language;
    }
}
?>
