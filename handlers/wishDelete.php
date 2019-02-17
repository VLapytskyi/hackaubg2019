<?php
include_once('../include/parents_main.php');
include_once('../include/login.php');
include_once('../include/config.php');
include_once('../include/dbconnection.php');
include_once('../include/init_session.php');
include_once('../include/child_dashboard.php');

if (empty($_GET['WID']) || !is_numeric($_GET['WID'])){
    goto_parents_error("No wish selected.");
    exit;
}
if ($_SESSION['child_mode'] === TRUE){
    goto_child_error("You need to login as a parent to remove wishes.");
    exit;
}
if ($_SESSION['child_id'] === FALSE){
    goto_parents_error("Child selection error.")
    exit;
}
$mysqliobj = database_connect();
$sql = 'SELECT item_id FROM wishlist WHERE (item_id = '.(int)$_GET['WID'].' AND child_id = '.$_SESSION['child_id'].');';
if (!$result = $mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems");
    exit;
}

if ($result->num_rows !== 1) {
    goto_parents_error("Wish selection error.");
    exit;
}
$sql = 'DELETE FROM wishlist WHERE item_id = '.(int)$_GET['WID'].';';

header('Location: '.$GLOBALS['projectbaseurl']);
exit;

?>