<?php
include_once('../include/config.php')
include_once('../include/init_session.php');

init_session();
$_SESSION['child_mode'] = TRUE;

header('Location: '.$GLOBALS['projectbaseurl']);
exit;

?>