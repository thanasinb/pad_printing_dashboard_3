<?php
require 'count.php';
require 'establish.php';
echo "<br>";
$sql = "INSERT INTO repeat_activity (id_activity, time_repeat, count_repeat) VALUES (";
$sql = $sql . $data_activity["id_activity"] . ", ";
$sql = $sql . "CURRENT_TIMESTAMP(), ";
$sql = $sql . "1)";
$result = $conn->query($sql);
$sql = "UPDATE activity SET id_activity = num_repeat + 1 WHERE id_task=" . $_GET["id_task"] . " AND id_machine='" . $_GET["id_mc"] ."' AND status_work = 1";
//$sql = "UPDATE activity SET num_repeat = num_repeat + 1 WHERE id_task = 2395 AND id_machine = '02-00' AND status_work = 1";

require 'terminate.php';
?>