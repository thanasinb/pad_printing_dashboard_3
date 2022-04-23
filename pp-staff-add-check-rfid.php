<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'update/establish.php';

$result_staff = $conn->query($sql);

if(isset($_GET['idRfid_check'])) {
    $id_rfid = $_GET['id_rfid'];
    $conn = "SELECT * FROM staff WHERE id_rfid = '$id_rfid'";
    $result = mysqli_query($db, $conn);
    if(mysqli_num_rows($result)){
        echo 'taken';
        }else{
        echo 'not_taken';
        }
        exit();
    }
require 'update/terminate.php';
?>