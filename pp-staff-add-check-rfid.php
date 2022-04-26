<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'update/establish.php';

//$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!empty($_GET['idRfid'])){
   $idRfid = mysqli_real_escape_string($conn,$_GET['idRfid']);
   $query = "select count(1) as cntRfid from staff where id_rfid='".$idRfid."'";
   $result = mysqli_query($conn,$query);
   $response = "<span style='color: green;'>RFID นี้สามารถใช้งานได้</span>";
   echo "<script>$('#button_save_rfid').prop('disabled',false);</script>";

   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);
      $count = $row['cntRfid'];
      if($count > 0){
          $response = "<span style='color: red;'>RFID นี้ถูกใช้งานแล้ว</span>";
          echo "<script>$('#submit_button').prop('disabled',true);</script>";
          echo "<script>$('#button_save_rfid').prop('disabled',true);</script>";
          if($_GET['temp_rfid'] == $_GET['idRfid']){
                    $response = "<span style='color: green;'>RFID นี้สามารถใช้งานได้</span>";
                    echo "<script>$('#button_save_rfid').prop('disabled',false);</script>";
                }
      }
   }
   if(strlen($_GET['idRfid']) < 10){
                      echo "<script>$('#submit_button').prop('disabled',true);</script>";
                      echo "<script>$('#button_save_rfid').prop('disabled',true);</script>";
                      $response = "<span style='color: red;'>RFID ต้องมี 10 หลัก</span>";

                }
   echo $response;
   die;
}
require 'update/terminate.php';
?>