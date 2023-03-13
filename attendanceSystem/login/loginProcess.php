<?php
include_once('../sql/scripts.php');
$dbh = new databaseHandler;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($id = $dbh->checkAccount($email, $password)) {
        echo json_encode(array(
            "status" => true
        ));
        $_SESSION['user_id'] = $id;
    } else {
        echo json_encode(array(
            "status" => false,
            'msg' => "Incorrect Username or Password!"
        ));
    }
}