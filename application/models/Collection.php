<?php

defined('PMDDA') or die('Restricted access');
/*
 * Model
 */

class Collection extends Model {

    public function createCollection($db, $collection, $capped = false, $size = 0, $max = 0) {
        try {
            $options=array('capped' => $capped,'size' =>$size,'max' =>$max);
            $this->mongo->{$db}->createCollection($collection,$options);
            $this->deleteTemporaryDb($db);
            if (!$capped) {
                $this->mongo->{$db}->selectCollection($collection)->ensureIndex(array("_id" => 1));
            }
            return TRUE;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function removeCollection($db, $collection, $criteria = array()) {
        try {
            return $this->mongo->{$db}->{$collection}->remove($criteria);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function dropCollection($db, $collection) {
        try {
            return $this->mongo->{$db}->{$collection}->drop();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function totalRecord($db, $collection,$query=false,$fromat = 'array') {
        try {
            if($fromat=='json'){
                $code = "return db.getCollection('" . $collection . "').find(" . $query . ").count();";
                $response = $this->mongo->{$db}->execute($code);
                if ($response['ok'] == 1) {
                    return $response['retval'];
                }
                return 10;//default limit
            }else{
                if(is_array($query)){
                    return $this->mongo->{$db}->{$collection}->find($query)->count();
                }else{
                    return $this->mongo->{$db}->{$collection}->count();
                }
            }
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function getIndexInfo($db, $collection) {
        try {
            return $this->mongo->{$db}->{$collection}->getIndexInfo();
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function deleteIndex($db, $collection, $name) {
        try {
            return $this->mongo->{$db}->command(array("deleteIndexes" => $this->mongo->{$db}->{$collection}->getName(), "index" => $name));
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function createIndex($db, $collection, $key, $options = array()) {

        try {
            return $this->mongo->{$db}->{$collection}->ensureIndex($key, $options);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    protected function getQueryForId($id, $idType = 'object', $fromat = 'array') {
        if ($fromat == 'json') {

            if ($idType == 'MongoId') {
                return '{"_id" : ObjectId("' . $id . '")}';
            }elseif($idType == 'MongoDate'){
                return '{"_id" : ISODate("' . $id . '")}';
            }elseif($idType == 'integer'){
                return '{"_id" : NumberInt("' . $id . '")}';
            }elseif($idType == 'double'){
                return '{"_id" : NumberLong("' . $id . '")}';
            }else {           
                return '{"_id" : "' . $id . '"}';
            }
        } else {
            if ($idType == 'MongoId') {
                return array('_id' => new MongoId($id));
            }else if ($idType == 'MongoDate') {
                list($sec,$usec)=  explode(',', $id);
                return array('_id' => new MongoDate($sec,$usec));
            }else if($idType=='integer'){
                return array('_id' => new MongoInt32($id));
            }else if($idType=='double'){
                return array('_id' => new MongoInt64($id));
            }else{
                return array('_id' => $id);
            }
        }
    }

    public function removeById($db, $collection, $id, $idType = 'object') {
        try {
            $query = $this->getQueryForId($id, $idType);
            return $this->mongo->{$db}->{$collection}->remove($query, array("justOne" => true));
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function findById($db, $collection, $id, $idType = 'object') {
        try {
            $query = $this->getQueryForId($id, $idType);
            return $this->mongo->{$db}->{$collection}->findOne($query);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function updateById($db, $collection, $id, $data, $fromat = 'array', $idType = 'object') {
        try {
            $query = $this->getQueryForId($id, $idType, $fromat);
            if ($fromat == 'json') {
                $code = "db.getCollection('" . $collection . "').update(" . $query . "," . $data . ");";
                return $this->mongo->{$db}->execute($code);
            } else {

                return $this->mongo->{$db}->{$collection}->update($query, $data);
            }
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

}

//End of class