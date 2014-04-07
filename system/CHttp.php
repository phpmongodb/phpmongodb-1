<?php

class CHttp {

    protected $XSS=TRUE;
    
    public function onXSS(){
        $this->XSS=TRUE;
    }
    public function offXSS(){
        $this->XSS=FALSE;
    }
    /**

     * @return string request type, such as GET, POST, HEAD.
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     */
    public function getType() {
        return strtoupper(isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET');
    }

    /**
     * Returns whether this is a POST request.
     * @return boolean whether this is a POST request.
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     */
    public function isPost() {
        return isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'], 'POST');
    }

    /**
     * Returns whether this is an AJAX (XMLHttpRequest) request.
     * @return boolean whether this is an AJAX (XMLHttpRequest) request.
     * @author Nanhe Kumar <nanhe.kumar@gmail.com>
     */
    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * Returns the named GET or POST parameter value.
     * If the GET or POST parameter does not exist, the second parameter to this method will be returned.
     * If both GET and POST contains such a named parameter, the GET parameter takes precedence.
     * @param string $name the GET parameter name
     * @param mixed $value the default parameter value if the GET parameter does not exist.
     * @return mixed the GET parameter value

     */
    public function getParam($name, $value = null) {
        $param= isset($_GET[$name]) ? $_GET[$name] : (isset($_POST[$name]) ? $_POST[$name] : $value);
        if($this->XSS && is_string($param)){
            $param=strip_tags($param);
        }
        return $param;
    }

    /**
     * Returns the named GET parameter value.
     * If the GET parameter does not exist, the second parameter to this method will be returned.
     * @param string $name the GET parameter name
     * @param mixed $value the default parameter value if the GET parameter does not exist.
     * @return mixed the GET parameter value

     */
    public function getQuery($name, $value = null) {
        return isset($_GET[$name]) ? $_GET[$name] : $value;
    }

    /**
     * Returns the named POST parameter value.
     * If the POST parameter does not exist, the second parameter to this method will be returned.
     * @param string $name the POST parameter name
     * @param mixed $value the default parameter value if the POST parameter does not exist.
     * @return mixed the POST parameter value

     */
    public function getPost($name, $value = null) {
        return isset($_POST[$name]) ? $_POST[$name] : $value;
    }

    /**
     * Returns part of the request URL that is after the question mark.
     * @return string part of the request URL that is after the question mark
     */
    public function getQueryString() {
        return isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
    }

    /**
     * Redirects the browser to the specified URL.
     * @param string $url URL to be redirected to. Note that when URL is not
     * absolute (not starting with "/") it will be relative to current request URL.
     * @param boolean $terminate whether to terminate the current application
     * @param integer $statusCode the HTTP status code. Defaults to 302. See {@link http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html}
     * for details about HTTP status code.
     */
    public function redirect($url, $terminate = true, $statusCode = 302) {
        if (strpos($url, '/') === 0 && strpos($url, '//') !== 0)
            $url = $this->getHost() . $url;
        header('Location: ' . $url, true, $statusCode);
        if ($terminate)
            exit();
    }
    public function serverSoftware(){
        return $_SERVER['SERVER_SOFTWARE'];
    }
}

?>