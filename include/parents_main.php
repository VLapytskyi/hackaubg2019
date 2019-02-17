<?php

include_once("init_session.php");
include_once('login.php');
include_once('config.php');
include_once('dbconnection.php');

function display_parents_main () {

    $mysqliobj = database_connect();

    if ($_SESSION['child_mode'] === TRUE) {
        goto_login_error("You are in the child mode. Please re-login.");
        exit;
    }

    if ($_SESSION['child_id'] === FALSE) {
        
        $sql = 'SELECT child_id FROM children WHERE parent_id = '.$_SESSION['parent_id'].' ORDER BY child_id DESC;';

        if (!$result = $mysqliobj->query($sql)) {
            // Oh no! The query failed. 
            goto_login_error("Sorry, the website is experiencing problems");
            exit;
        }

        if ($result->num_rows > 0) {
            $therecord = $result->fetch_assoc();
            $_SESSION['child_id'] = ( int ) $therecord['child_id'];
        } else {
            $_SESSION['child_id'] = FALSE;
        }

        $result->free();
    }

    $_SESSION['child_mode'] = FALSE;

    // TODO EVERYTHING

    // REPLACE
    echo $_SESSION['error_message'];

    $mysqliobj->close();
    unset($_SESSION['error_message']);
}

function goto_parents_error ($message) {
    init_session();

    $_SESSION['child_mode'] = FALSE;
    $_SESSION['error_message'] = $message;

    header('Location: '.$GLOBALS['projectbaseurl']);
    exit;
}

?>