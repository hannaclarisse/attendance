<?php
date_default_timezone_set('Asia/Manila');
$current_date_time = date('Y-m-d H:i:s');

include('sql/scripts.php');

if (!isset($_SESSION["user_id"])) {
    exit();
}
$id = $_SESSION["user_id"];

$dbh = new databaseHandler;

if (isset($_POST["GET_TIMEINOUT"])) {
    echo json_encode((array)$dbh->getTimeInOut($id));
}


if (isset($_POST['displayUser'])) {
    echo json_encode((array)$dbh->getUserInfo($_SESSION['id']));
}

if (isset($_POST['insertTimeIn'])) {
    echo json_encode((array)$dbh->insertTimein($id, 'Time in', $current_date_time));
}

if (isset($_POST['insertTimeOut'])) {
    echo json_encode((array)$dbh->insertTimein($id, 'Time out', $current_date_time));
}

// if ($dbh->insertTimein($userId, $value)) {
//     echo json_encode(array(
//         "status" => 'success',
//         'msg' => "Timein Successful!"
//     ));
// }

