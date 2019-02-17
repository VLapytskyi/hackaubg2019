<?php
include_once('login.php');
include_once('config.php');

function database_connect () {
$mysqliobj = new mysqli($GLOBALS['dbhost'], $GLOBALS['dbusername'], $GLOBALS['dbpassword'], $GLOBALS['dbdatabase']);

if ($mysqliobj->connect_errno) {
    goto_login_error("Sorry, the website is experiencing problems");
    exit;
}

return $mysqliobj;

}

?>