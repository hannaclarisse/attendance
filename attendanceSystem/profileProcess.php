<?php
include('sql/scripts.php');
$dbh = new databaseHandler;
$id = $_SESSION["user_id"];
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];
$confirmPass = $_POST['confirmPass'];


if (isset($_POST['fName'])) {
    $info = (object) [
        'fName' => $_POST['fName'],
        'mName' => $_POST['mName'],
        'lName' => $_POST['lName'],
        'email' => $_POST['email'],
        'contact' => $_POST['contact'],
    ];
    if ($dbh->profileUpdate($info, $id)) {

        echo json_encode(array(
            "status" => 'success',
            "msg" => 'Profile Update Successfully.'
        ));
    }
}

if(isset($_POST['oldPass'])){
if ($oldPass !== $dbh->getSpecificInfo($id, 'password')) {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Current Password is incorrect"
    ));
} else if ($newPass !== $confirmPass) {
    echo json_encode(array(
        "status" => "error",
        "msg" => "Password does not match"
    ));
    
} else if($newPass == $dbh->getSpecificInfo($id, 'password')){
    echo json_encode(array(
        "status" => "error",
        "msg" => "The password that you entered already exist, enter new password."
    ));
}else {

    if($dbh->updateSpecificInfo($id, 'password', $newPass)){
        echo json_encode(array(
            "status" => "success",
            "msg" => "Change password successfully!"
        ));
    }
    
}
}