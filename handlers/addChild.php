<?php

include_once('../include/parents_main.php');
include_once('../include/login.php');
include_once('../include/config.php');
include_once('../include/dbconnection.php');
include_once('../include/init_session.php');

init_session();

if ($_SESSION['parent_id'] === FALSE) {
    goto_login_error("You are not logged in.");
    exit;
}

if ($_SESSION['child_mode'] === TRUE) {
    goto_child_error("You are in the child mode, so you cannot change some settings.");
    exit;
}

if (empty($_POST['addChild_name']) || !is_string($_POST['addChild_name'])) {
    goto_parents_error("Name was not entered");
    exit;
}

$mysqliobj = database_connect();

// Perform an SQL query
$sql = 'INSERT INTO children (parent_id, name) VALUES('.$_SESSION['parent_id'].', "'.addslashes($_POST['addChild_name']).'");';

if (!$mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems. Please try again later.");
    exit;
}

$_SESSION['child_id'] = FALSE;
$_SESSION['child_mode'] = FALSE;

header('Location: '.$GLOBALS['projectbaseurl']);
exit;

$mysqliobj->close();

?>