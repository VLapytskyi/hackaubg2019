<?php
include_once('../include/parents_main.php');
include_once('../include/login.php');
include_once('../include/config.php');
include_once('../include/dbconnection.php');
include_once('../include/init_session.php');
include_once('../include/child_dashboard.php');

if (empty($_POST['wish_name']) || !is_string($_POST['wish_name'])){
    goto_child_error("Incorrect wish name.");
    exit;
}
if ($_SESSION['child_mode'] === FALSE){
    goto_child_error("You need to login as a child to create wishes.");
    exit;
}
if ($_SESSION['child_id'] === FALSE){
    goto_parents_error("Child selection error.")
    exit;
}
$mysqliobj = database_connect();
$sql = 'INSERT INTO wishlist (child_id, name) VALUES ('.$_SESSION['child_id'].', '.$_POST['wish_name'].')';
if (!$result = $mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems");
    exit;
}

if ($result->num_rows !== 1) {
    goto_parents_error("Wish creation error.");
    exit;
}
header('Location: '.$GLOBALS['projectbaseurl']);
exit;
?>