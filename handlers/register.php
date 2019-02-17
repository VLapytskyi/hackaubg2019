<?php

include_once('../include/login.php');
include_once('../include/config.php');
include_once('../include/dbconnection.php');
include_once('../include/init_session.php');

init_session();

if (empty($_POST['register_name']) || empty($_POST["register_email"]) || empty($_POST["register_password"]) || empty($_POST["register_repassword"]) || !is_string($_POST['register_name']) || !is_string($_POST["register_email"]) || !is_string($_POST["register_password"]) || !is_string($_POST["register_repassword"])) {
    goto_login_error("At least one of the required fields was left empty");
}

if (!filter_var($_POST["register_email"], FILTER_VALIDATE_EMAIL)) {
    goto_login_error("The email address entered is not valid");
}

if (strlen($_POST['register_password']) < 6) {
    goto_login_error("The password should be at least 6 characters long");
}

if (strlen($_POST['register_password']) != strlen($_POST['register_repassword'])) {
    goto_login_error("The passwords don't match");
}

$mysqliobj = database_connect();

// Perform an SQL query
$sql = 'SELECT parent_id FROM parents WHERE email = "'.addslashes($_POST['register_email']).'";';

if (!$result = $mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems");
    exit;
}

if ($result->num_rows !== 0) {
    goto_login_error("Sorry, an account with this email is already registered");
    exit;
}

$result->free();

$sql = 'INSERT INTO parents (name, email, password) VALUES("'.addslashes($_POST['register_name']).'", "'.addslashes($_POST['register_email']).'", PASSWORD("'.addslashes($_POST['register_password']).'"));';

if (!$mysqliobj->query($sql)) {
    // Oh no! The query failed. 
    goto_login_error("Sorry, the website is experiencing problems. Please try again later.");
    exit;
}

$mysqliobj->close();

goto_login_error("Now you are registered. Please login using your newly created credentials.");
exit;

?>