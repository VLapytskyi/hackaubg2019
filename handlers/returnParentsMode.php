<?php
include_once('../include/login.php');
include_once('../include/config.php');
include_once('../include/dbconnection.php');
include_once('../include/init_session.php');
include_once('../include/child_dashboard.php');

init_session();

if (empty($_POST["returnPM_password"]) || !is_string($_POST["returnPM_password"])) {
    goto_child_error("Password is not entered");
}

$mysqliobj = database_connect();
$sql = 'SELECT parent_id FROM parents WHERE (parent_id = '.$_SESSION['parent_id'].' AND password = PASSWORD("'.addslashes($_POST['returnPM_password']).'"));';
if (!$result = $mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems");
    exit;
}

if ($result->num_rows !== 1) {
    goto_child_error("Password is incorrect");
    exit;
}


$mysqliobj->close();

$_SESSION['child_mode'] = FALSE;


header('Location: '.$GLOBALS['projectbaseurl']);
exit;

?>