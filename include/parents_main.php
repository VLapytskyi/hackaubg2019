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

    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<script> alert("'.$_SESSION['error_message'].'"); </script>';
    }
    ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-fluid">
      <ul class="nav nav-tabs bg-dark">
  <li class="nav-item">
    <a class="nav-link active" href="#">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Pictures</a>
  </li>
</ul>
      <button type="button" class="btn btn-raised btn-lg">Chad</button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">  +  </button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="form-control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="form-control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
    </div>
    <div class="container">
      <!-- On rows -->
<tr class="table-active">...</tr>
<tr class="table-success">...</tr>
<tr class="table-warning">...</tr>
<tr class="table-danger">...</tr>
<tr class="table-info">...</tr>

<!-- On cells (`td` or `th`) -->
<tr>
  <td class="table-active">...</td>
  <td class="table-success">...</td>
  <td class="table-warning">...</td>
  <td class="table-danger">...</td>
  <td class="table-info">...</td>
</tr>

    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>

    <?php

    // REPLACE
    //echo $_SESSION['error_message'];

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