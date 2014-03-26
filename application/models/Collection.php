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

    public function totalRecord($db, $collection) {

        try {
            return $this->mongo->{$db}->{$collection}->count();
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

            if ($idType == 'object') {
                return '{"_id" : ObjectId("' . $id . '")}';
            } else {
                return '{"_id" : "' . $id . '"}';
            }
        } else {
            if ($idType == 'object') {
                return array('_id' => new MongoId($id));
            } else {
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