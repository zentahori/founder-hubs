<?php

/**
 * The base MySQL settings of Osclass
 */
define('MULTISITE', 0);

$production_hosts = array(
    "https" => array("ciao-spider-net.ssl-lolipop.jp"),
    "http"  => array("spider-net.ciao.jp", "founderhubs.com", "www.founderhubs.com")
);

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1'
        || $_SERVER['SERVER_ADDR'] == '::1') {  // Development

    /** MySQL database name for Osclass */
    define('DB_NAME', 'osclass');

    /** MySQL database username */
    define('DB_USER', 'developer');

    /** MySQL database password */
    define('DB_PASSWORD', 'pass12345');

    /** MySQL hostname */
    define('DB_HOST', '127.0.0.1');

    /** Database Table prefix */
    define('DB_TABLE_PREFIX', 'oc_');

    define('REL_WEB_URL', '/founder-hubs/');

    define('WEB_PATH', 'http://localhost/founder-hubs/');

} else if (in_array($_SERVER['HTTP_HOST'], $production_hosts["https"])
              || in_array($_SERVER['HTTP_HOST'], $production_hosts["http"])) { // Production

    /** MySQL database name for Osclass */
    define('DB_NAME', 'LAA0658931-osclass');

    /** MySQL database username */
    define('DB_USER', 'LAA0658931');

    /** MySQL database password */
    define('DB_PASSWORD', '********');

    /** MySQL hostname */
    define('DB_HOST', 'mysql101.phy.lolipop.lan');

    /** Database Table prefix */
    define('DB_TABLE_PREFIX', 'oc_');

    define('REL_WEB_URL', '');

    $domain = in_array($_SERVER['HTTP_HOST'], $production_hosts["https"])
            ? "https://" . $_SERVER['HTTP_HOST'] . "/"
            : "http://" . $_SERVER['HTTP_HOST'] . "/";
    define('WEB_PATH', $domain);

} else { // Staging

    /** MySQL database name for Osclass */
    define('DB_NAME', 'heroku_fd6d6848392cda3');

    /** MySQL database username */
    define('DB_USER', 'b3e21e1b897559');

    /** MySQL database password */
    define('DB_PASSWORD', 'b74655d3');

    /** MySQL hostname */
    define('DB_HOST', 'us-cdbr-iron-east-02.cleardb.net');

    /** Database Table prefix */
    define('DB_TABLE_PREFIX', 'oc_');

    define('REL_WEB_URL', '/osclass/');

    define('WEB_PATH', 'https://spider-net.herokuapp.com/');

}

?>
