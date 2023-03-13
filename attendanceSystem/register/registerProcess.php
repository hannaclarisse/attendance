<?php 
include_once('../sql/scripts.php');
$dbh = new databaseHandler;


$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"attendance");

$email = $_POST['email'];
$s_email = "SELECT * FROM `users` WHERE email='$email'";
$result_email = mysqli_query($con, $s_email);
$num_email = mysqli_num_rows($result_email); 


if($num_email == 1){
    echo json_encode(array(
        "status" => 'error',
        'msg' => "Email Taken is already taken"
    ));
}
else if (isset($_POST['password'])) {
    if ($_POST['password'] != $_POST['confirmPassword']) {
        echo json_encode(array(
            "status" => 'error',
            'msg' => "<b>Password and Confirm Password</b> didn't match"
        ));
    } 
    else {
        $account = (object) [
            'firstName' => $_POST['firstName'],
            'middleName' => $_POST['middleName'],
            'lastName' => $_POST['lastName'],
            'email' => $_POST['email'],
            'contact' => $_POST['contactNumber'],
            'password' => $_POST['password']
        ];

        if ($dbh->registerAccount($account)) {
            echo json_encode(array(
                "status" => 'success',
                'msg' => "Register Successful!"
            ));
        } else {
            echo json_encode(array(
                "status" => 'error',
                'msg' => "There is an error occur. Please try again."
            ));
        }
    }
}

?>