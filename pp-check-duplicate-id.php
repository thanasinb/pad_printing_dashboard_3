<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'update/establish.php';

//$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!empty($_GET['idStaff'])){
    $idStaff = mysqli_real_escape_string($conn,$_GET['idStaff']);
    $query = "select count(1) as cntRfid from staff where id_staff='".$idStaff."'";
    $result = mysqli_query($conn,$query);
    $check_id = false; // return check_id ไปเช็คค่าซ้ำ
    echo "<script>check_id = true;</script>";
    echo "<script>$('#button_save_rfid').prop('disabled',false);</script>";


    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
        $count = $row['cntRfid'];
        if($count > 0){
            $response = "<span style='color: red;'>Staff ID นี้ถูกใช้งานแล้ว</span>";
            echo "<script>$('#submit_button').prop('disabled',true);</script>";
            echo "<script>$('#button_save_rfid').prop('disabled',true);</script>";
            echo "<script>check_id = false;</script>";
            if($_GET['temp_rfid'] == $_GET['idStaff']){
                $response = "<span style='color: green;'>Staff ID นี้สามารถใช้งานได้</span>";
                echo "<script>$('#button_save_rfid').prop('disabled',false);</script>";
                echo "<script>check_id = true;</script>";

            }
        }
        else{
            if(strlen($_GET['idStaff']) < 6) {  //check staff 6 number

                echo "<script>$('#submit_button').prop('disabled',true);</script>";
                echo "<script>$('#button_save_rfid').prop('disabled',true);</script>";
                $response = "<span style='color: red;'>Staff ID ต้องมี 6 หลัก</span>";
                echo "<script>check_id = true;</script>";

            }
            else{
                echo "<script>$('#submit_button').prop('disabled',false);</script>";
                echo "<script>$('#button_save_rfid').prop('disabled',false);</script>";
                $response = "<span style='color: green;'>Staff ID นี้สามารถใช้งานได้</span>";

            }
        }


    }

    echo $response;
    die;
}
require 'update/terminate.php';
?>