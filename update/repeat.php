<?php
require 'count.php';
require 'establish.php';
echo "<br>";
$sql = "INSERT INTO repeat_activity (id_activity, time_repeat, count_repeat) VALUES (";
$sql = $sql . $data_activity["id_activity"] . ", ";
$sql = $sql . "CURRENT_TIMESTAMP(), ";
$sql = $sql . "1)";
$result = $conn->query($sql);

$sql = "UPDATE activity SET num_repeat = num_repeat + 1 WHERE id_activity='" . $data_activity["id_activity"] . "' AND id_machine ='".$_GET["id_mc"] . "'";
$data_repeat = $conn->query($sql);

require 'terminate.php';
?>