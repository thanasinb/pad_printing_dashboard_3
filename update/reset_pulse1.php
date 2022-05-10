<?php
require 'establish.php';

$sql = "SELECT id_task, id_staff FROM machine_queue WHERE id_machine='".$_GET['id_mc']."' AND queue_number=1";
$result = $conn->query($sql);
$data_pulse1 = $result->fetch_assoc();

$sql = "UPDATE activity SET no_pulse1=0  WHERE id_task='" . $_GET["id_task"] . "'AND id_staff='" . $_GET["id_staff"] . "' AND status_work=1";
$reset_pulse1 = $conn->query($sql);

echo "RESET NO_PULSE1 COMPLETE";

require 'terminate.php';
?>
