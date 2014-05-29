<?php

class Helper {

    public static function getLoginDatabase() {
        $session = Application::getInstance('Session');
        $model = new Model();
        return array(
            'databases' => array(
                array(
                    'name' => isset($session->options['db']) ? $session->options['db'] : '',
                    'noOfCollecton' => isset($session->options['db'])?count($model->listCollections($session->options['db'], TRUE)):NULL,
                ),
            ),
        );
    }

}
