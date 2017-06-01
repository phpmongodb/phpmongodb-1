<?php
/**
 * @package PHPmongoDB
 * @version 1.0.0
 */
defined('PMDDA') or die('Restricted access');

class Theme {

    private static $themePath = '/application/themes/';
    private static $themeUri;
    private static $homeUri;
    
    public static function getThemePath(){
        return self::$themePath.Config::$theme.'/';
    }

    public static function absolutePath() {
        return getcwd() . '/' . self::getThemePath();
    }

    public static function relativePath() {
        return realpath(self::absolutePath());
    }

    private static function __setThemeUri() {
        if (!isset(self::$homeUri)) {
            self::__setHomeUri();
        }

        self::$themeUri = self::$homeUri . self::getThemePath();
    }

    public static function __setHomeUri() {
        self::$homeUri = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {
            self::$homeUri .= "s";
        }
        self::$homeUri .= "://";

        if ($_SERVER["SERVER_NAME"] == '_') { //Fix nginx default server_name '_'
            $_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
        }
        if ($_SERVER["SERVER_PORT"] != "80") {
            self::$homeUri .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        } else {
            self::$homeUri .= $_SERVER["SERVER_NAME"];
        }
        self::$homeUri.= str_replace('/index.php', '', $_SERVER['PHP_SELF']);
    }


    public static function getPath() {
        if (!isset(self::$themeUri)) {
            self::__setThemeUri();
        }
        return self::$themeUri;
    }
    public static function getVersion($file){
       $file=getcwd().$file;
       if (file_exists($file)) {
           return filemtime($file);
       }
       return FALSE;
    }

    public static function URL($load = 'Index/Index', $queryString = array()) {
        if (!self::$homeUri) {
            self::__setThemeUri();
        }
        $url = self::__setThemeUri() . 'index.php?load=' . $load;
        if (is_array($queryString)) {
            foreach ($queryString as $k => $v) {
                if(is_string($v))
                    $url.= '&'.$k.'='.urlencode($v);
                else
                    $url.= '&'.$k.'='.$v;
            }
        }
        return $url;
    }

    public static function getHome() {
        if (!isset(self::$homeUri)) {
            self::__setHomeUri();
        }
        return self::$homeUri;
    }

    public static function currentURL($start = FALSE) {
        $url = self::$homeUri . '/index.php';
        if (!empty($_SERVER['QUERY_STRING'])) {
            $queryString = explode('&', $_SERVER['QUERY_STRING']);
            if (is_array($queryString)) {
                foreach ($queryString as $value) {
                    if ($start) {
                        $rercord = explode('=', $value);
                        if ($rercord[0] == 'start') {
                            continue;
                        }
                    }
                    $url.=(strpos($url, '?') !== false ? '&' : '?') . $value;
                }
            }
        }

        return $url;
    }

    public static function paginationURL($url, $start) {
        $url.=(strpos($url, '?') !== false ? '&' : '?') . 'start=' . $start.'&theme=true';
        return $url;
    }

    public static function pagination($total = 0, $split = 10) {
        $url = self::currentURL(TRUE);
        $current = (isset($_GET['start']) ? $_GET['start'] : 0);


        if ($total > $split && $current < $total) {
            $current = ($current >= $split ? ceil($current / $split) : 0);
            $page = 0;
            $end = ceil($total / $split);
            if ($total > $split) {

                if ($current > 5) {
                    $page = $current - 5;
                }
                if (($page + $split) <= $end) {
                    $end = $page + $split;
                }
            }

            echo '<div class="pagination">';
            echo '<ul>';
            if ($current != 0) {
                echo '<li><a href="' . self::paginationURL($url, (($current - 1) * $split)) . '">Prev</a></li>';
            }

            
            for (; $page < $end; $page++) {
                echo '<li class="' . ($current == $page ? "active" : "") . '"><a href="' . ($current != $page ? self::paginationURL($url, ($page * $split)) : 'javascript:void(0)') . '" >' . ($page + 1) . '</a></li>';
            }
            if ((($current * $split) + $split) < $total) {
                echo '<li><a href="' . self::paginationURL($url, (($current + 1) * $split)) . '">Next</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }

}
