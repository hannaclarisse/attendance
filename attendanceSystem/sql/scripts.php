<?php 
session_start();
class databaseHandler{
    public $conn;
    function __construct(){
    $dbservername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "attendance";
        $this->conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function checkAccount($email, $password){
        $query = "SELECT * FROM users WHERE email = '$email'  AND  password ='$password'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return $row["id"];
            }
        } else {
            return false;
        }
    }

    function getTimeInOut($id){
        $query = "SELECT * FROM `dtmonitoring` WHERE dtmonitoring.userid='$id' ORDER BY dateTime DESC";
        $result = mysqli_query($this->conn, $query);
        $records = array();
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $records[] = (object)[
                    'id' => $row['id'],
                    'datetime' => $row['datetime'],
                    'status' => $row['status']
                ];
            }
        }
        return $records;
    }

    // function insertTimein($userId, $value){
    //     $query = "INSERT INTO `dtmonitoring`(`userid`, `status`)  VALUES ('$userId', $value) ";
    //     return mysqli_query($this->conn, $query);
    // }

    function insertTimein($userId, $value, $current_date_time){
        $query = "INSERT INTO `dtmonitoring`(`userid`, `status`, `datetime`)  VALUES ('$userId', '$value', '$current_date_time') ";
        if (mysqli_query($this->conn, $query)) {
            $value = (object) ['status' => true, 'msg' => ''];
        } else {
            $value = (object) ['status' => false, 'msg' => "Error description: " . mysqli_error($this->conn)];
        }
        return $value;
    }
    

    function insertTimeout($userId, $value, $current_date_time){
        $query = "INSERT INTO `dtmonitoring`(`userid`, `status`, `datetime`)  VALUES ('$userId', '$value', '$current_date_time') ";
        return mysqli_query($this->conn, $query);
    }

    function getUserInfo($id){
        $query = "SELECT *, CONCAT(lName, ', ', fName) AS fullname FROM users INNER JOIN dtmonitoring 
        ON users.id = dtmonitoring.userid WHERE users.id='$id'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return (object)[
                    'id' => $row['id'],
                    'fullname' => $row['fullname'],
                    'fName' => $row['fName'],
                    'contact' => $row['contact'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'userid' => $row['userid'],
                ];
            }
        }
    }

    function registerAccount($info){
        $query = "INSERT INTO users(fName, mName, lName, password, email, contact) 
        VALUES ('$info->firstName' ,'$info->middleName', '$info->lastName',
        '$info->password', '$info->email', '$info->contact')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}

?>