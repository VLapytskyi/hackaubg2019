<?php
include_once('../include/config.php')
include_once('../include/init_session.php');
include_once('../include/login.php');
include_once('../include/parents_main.php');
init_session();

if ($_SESSION['parent_id'] === FALSE) {
    goto_login_error("You are not logged in.");
    exit;
}

if ($_SESSION['child_id'] === FALSE) {
    goto_parents_error("Child login problem.");
    exit;
}

$_SESSION['child_mode'] = TRUE;

header('Location: '.$GLOBALS['projectbaseurl']);
exit;

?>