<?php

class Model {

    protected $mongo;

    public function __construct() {

        $session = Application::getInstance('Session');
        $mongo = PHPMongoDB::getInstance($session->server, $session->options);
        $exception = $mongo->getExceptionMessage();
        if ($exception)
            exit($exception);
        $this->mongo = $mongo->getConnection();
    }

    public function listDatabases() {
        try {
            return $this->mongo->admin->command(array("listDatabases" => 1));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getMongoInfo() {
        try {
            return $this->mongo->admin->command(array('buildinfo' => true));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function renameCollection($oldCollecton, $newCollection, $dbFrom, $dbTo = false) {
        if (!$dbTo) {
            $dbTo = $dbFrom;
        }

        try {
            $command = array("renameCollection" => "$dbFrom.$newCollection", "to" => "$dbTo.$oldCollecton");
            return $this->mongo->admin->command($command);
        } catch (MongoConnectionException $e) {
            exit($e);
        }
    }

    public function copyDatabase($fromdb, $todb, $fromhost = 'localhost') {
        try {
            $response = $this->mongo->admin->command(array('copydb' => 1, 'fromhost' => $fromhost, 'fromdb' => $fromdb, 'todb' => $todb));
            return $response;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function __call($name, $arguments) {
        try {
            return $this->mongo->{$arguments[0]}->$name($arguments[1]);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

//    public function listCollections($db,$includeSystemCollections = false ) {
//        return $this->mongo->{$db}->listCollections($includeSystemCollections);
//    }
//
//    public function getCollectionNames($db,$includeSystemCollections = false ) {
//        return $this->mongo->{$db}->getCollectionNames($includeSystemCollections);
//    }


    public function find($db, $collection, $query = array(), $fields = array(), $limit = false, $skip = false, $fromat = 'array') {
        try {
            if ($fromat == 'json') {
                $code = "return db." . $collection . ".find(" . $query . ").limit(" . $limit . ").skip(" . $skip . ").toArray();";
                $response = $this->mongo->{$db}->execute($code);
                if ($response['ok'] == 1) {
                    return $response['retval'];
                }
            } else {
                return $this->mongo->{$db}->{$collection}->find($query, $fields)->limit($limit)->skip($skip);
            }
            return false;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function insert($db, $collection, $a, $fromat = 'array', $options = array()) {
        try {
            if ($fromat == 'json') {
                $code = "db.getCollection('" . $collection . "').insert(" . $a . ");";
                return $this->mongo->{$db}->execute($code);
            } else {
                return $this->mongo->{$db}->{$collection}->insert($a);
            }
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function serverStatus() {
        try {
            $response = $this->mongo->admin->command(array('serverStatus' => 1,));
            return $response;
        } catch (Exception $e) {
            return $e->getMessage();
        }
       
    }

}

?>
