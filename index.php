<?php
include_once("include/login.php");
include_once("include/parents_main.php");
include_once("include/child_dashboard.php");
include_once('include/init_session.php');

init_session();

if ($_SESSION['parent_id'] === FALSE) {
    display_login_page();
    exit;
}

if ($_SESSION['parent_id'] !== FALSE && $_SESSION['child_mode'] === FALSE) {
    display_parents_main();
    exit;
}

if ($_SESSION['parent_id'] !== FALSE && $_SESSION['child_id'] !== FALSE && $_SESSION['child_mode'] === TRUE) {
    display_child_dashboard();
    exit;
}

goto_login_error(NULL);
exit;

?>