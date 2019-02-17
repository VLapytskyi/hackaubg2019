<?php

function init_session() {
    session_start([
        'cookie_lifetime' => 5356800,
    ]);

    if (!isset($_SESSION['parent_id'])) {
        $_SESSION['parent_id'] = FALSE;
    }

    if (!isset($_SESSION['child_id'])) {
        $_SESSION['child_id'] = FALSE;
    }

    if (!isset($_SESSION['child_mode'])) {
        $_SESSION['child_mode'] = FALSE;
    }

}

?>