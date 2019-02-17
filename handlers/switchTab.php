<?php

include_once('../include/login.php');
include_once('../include/config.php');
include_once('../include/dbconnection.php');
include_once('../include/init_session.php');
include_once('../include/parents_main.php');

init_session();

if ($_SESSION['parent_id'] === FALSE) {
    goto_login_error("You are not logged in.");
    exit;
}

if ($_SESSION['child_mode'] === TRUE) {
    goto_child_error("You are in the child mode, so you cannot change some settings.");
    exit;
}

if (empty($_GET['cid']) || !is_numeric($_GET['cid'])) {
    goto_parents_error("Not all the necessary parameters were passed");
    exit;
}

$mysqliobj = database_connect();

$sql = 'SELECT child_id FROM children WHERE (parent_id = '.$_SESSION['parent_id'].' AND child_id = '.(int)$_GET['cid'].');';

if (!$result = $mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems");
    exit;
}

if ($result->num_rows !== 1) {
    goto_parents_error("Invalid child ID");
    exit;
}

$result->free();

$mysqliobj->close();

$_SESSION['child_id'] = (int)$_GET['cid'];
$_SESSION['child_mode'] = FALSE;

header('Location: '.$GLOBALS['projectbaseurl']);
exit;

?>