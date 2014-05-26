<?php defined('PMDDA') or die('Restricted access'); ?>
<?php

class Database extends Model {

    public function createDB($name) {
        try {
            return $this->mongo->selectDB($name)->execute("function(){}");
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public function dropDatabase($db) {
        try {
            return $this->mongo->{$db}->drop();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function renameDatabase($oldDB, $newDB) {
        try {
            $response = $this->copyDatabase($oldDB, $newDB);
            if ($response['ok'] == 1) {
                try {
                    $response = $this->mongo->{$oldDB}->command(array('dropDatabase' => 1));
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            }else{
                return isset($response['errmsg'])?$response['errmsg']:'Report Bug Erro Code :PMD-RD-32';
            }
            
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function repair($db) {
        return $this->mongo->{$db}->repair();
    }
    public function execute($db,$code,array $args = array()) {
        try {
        return $this->mongo->{$db}->execute($code);
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

}
