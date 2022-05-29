<?php
/**
 * DATABASE
 */
define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "zonanetgest");


/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);


/**
 *  URL
 */
define("URL_REGISTER", "http://localhost/ZonaNet/cadastro.php/");
define("URL_TOKEN", "http://localhost/ZonaNet/activateToken.php/");
define("URL_HOME", "http://localhost/ZonaNet/home.php/");
define("URL_CHANGE_INFOS", "http://localhost/ZonaNet/changeInfos.php/");