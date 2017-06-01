<?php

class Session extends Data {

    const KEY = 'PMD_SESSION';

    public function get($key, $value = null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $value;
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function __get($name) {
        $this->data = $this->get(self::KEY);
        return parent::__get($name);
    }

    public function __set($name, $value) {
        $this->data = $this->get(self::KEY);
        parent::__set($name, $value);
        $this->set(self::KEY, $this->data);
    }

    public function start() {
        ini_set( 'session.cookie_httponly', 1 );
        if (session_status() === PHP_SESSION_NONE) {
            session_start ();
        }
    }

    public function __isset($name) {

        $this->data = $this->get(self::KEY);
        return parent::__isset($name);
    }

    /**
     * Ends the current session and store session data.
     */
    public function close() {
        if (session_id() !== '')
            @session_write_close();
    }

    /**
     * Frees all session variables and destroys all data registered to a session.
     */
    public function destroy() {
        if (session_id() !== '') {
            @session_unset();
            @session_destroy();
        }
    }

    public function isLogedIn() {
        return isset($this->isLogedIn);
    }
    public function setDefaultKey($value=  array()){
        if(!isset($_SESSION[self::KEY]))
            $this->set(self::KEY, $value);
    }
}

?>
