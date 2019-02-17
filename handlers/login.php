<?php

include_once('../include/login.php');
include_once('../include/config.php');
include_once('../include/dbconnection.php');
include_once('../include/init_session.php');

init_session();

if (empty($_POST['login_email']) || empty($_POST["login_password"]) || !is_string($_POST['login_email']) || !is_string($_POST["login_password"])) {
    goto_login_error("Login and/or password is not entered");
}

$mysqliobj = database_connect();

// Perform an SQL query
$sql = 'SELECT parent_id FROM parents WHERE (email = "'.addslashes($_POST['login_email']).'" AND password = PASSWORD("'.addslashes($_POST["login_password"]).'"));';

if (!$result = $mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems");
    exit;
}

if ($result->num_rows !== 1) {
    goto_login_error("Login and/or password is incorrect");
    exit;
}

$therecord = $result->fetch_assoc();
$_SESSION['parent_id'] = ( int ) $therecord['parent_id'];

$result->free();

$_SESSION['child_id'] = FALSE;

$mysqliobj->close();

$_SESSION['child_mode'] = FALSE;

header('Location: '.$GLOBALS['projectbaseurl']);
exit;

?>