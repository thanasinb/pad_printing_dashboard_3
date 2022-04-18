<?php
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'update/establish.php';
        if ($_POST['selected_radio']==1){
            $sql = "UPDATE machine_queue SET comp_date='0000-00-00', comp_time='00:00:00', id_task = (";
            $sql = $sql . "SELECT id_task FROM planning WHERE id_job=" . $_POST['id_job'] . " AND ";
            $sql = $sql . "operation=" . $_POST['operation_new'];
            $sql = $sql . ") WHERE id_machine='" . $_POST['id_machine'] . "' AND queue_number=1";
//            echo $sql;
            $conn->query($sql);
            $sql = "UPDATE machine_queue SET queue_number = queue_number - 1 WHERE id_machine='" . $_POST['id_mc'] . "' AND queue_number > 0";
            $conn->query($sql);
        }elseif ($_POST['selected_radio']==3) {
            $sql = "UPDATE planning SET task_complete=1 WHERE id_job=" . $_POST['id_job'] . " AND ";
            $sql = $sql . "operation=" . $_POST['operation'];
            $conn->query($sql);
        }elseif ($_POST['selected_radio']==4) {
            // FOR REMOVING TASK
            $sql = "DELETE FROM machine_queue WHERE id_machine='" . $_POST['id_mc'] . "' AND queue_number=1";
            $conn->query($sql);
//            echo  $sql;
        }elseif ($_POST['selected_radio']==5) {
            $sql = "UPDATE machine_queue SET queue_number = queue_number - 1 WHERE id_machine='" . $_POST['id_mc'] . "' AND queue_number > 0";
            $conn->query($sql);
        }elseif ($_POST['selected_radio']==6) {
            if ($_POST['is_current_task']==1){
                // FOR ADDING A NEW TASK TO QUEUE 1
                $sql = "INSERT INTO machine_queue (id_machine, queue_number, id_task) VALUES (";
                $sql = $sql . "'" . $_POST['id_machine'] . "',";
                $sql = $sql . "1,";
                $sql = $sql . "(SELECT id_task FROM planning WHERE ";
                $sql = $sql . "id_job=" . $_POST['id_job'] . " AND ";
                $sql = $sql . "operation=" . $_POST['operation_new'] . ")";
                $sql = $sql . ")";
            }else{
                // FOR ADDING A NEW TASK TO QUEUE 2
                $sql = "INSERT INTO machine_queue (id_machine, queue_number, id_task) VALUES (";
                $sql = $sql . "'" . $_POST['id_machine'] . "',";
                $sql = $sql . "2,";
                $sql = $sql . "(SELECT id_task FROM planning WHERE ";
                $sql = $sql . "id_job=" . $_POST['id_job'] . " AND ";
                $sql = $sql . "operation=" . $_POST['operation_new'] . ")";
                $sql = $sql . ")";
            }
            $conn->query($sql);
//            echo $sql;
        }
        require 'update/terminate.php';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Job overview by Machine</title>
        <link href="css/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="js/font-awesome/5.15.3/js/all.min.js"></script>
        <script src="js/feather-icons/4.28.0/feather.min.js"></script>
        <link rel="stylesheet" href="css/reorder-columns/dragtable.css">
        <link rel="stylesheet" href="css/reorder-columns/bootstrap-table.min.css">
        <link rel="stylesheet" href="css/majorette.css">
        <script src="js/jquery/jquery.min.js"></script>
        <script src="js/jquery/jquery-ui.min.js"></script>
        <script src="js/reorder-columns/jquery.dragtable.js"></script>
        <script src="js/reorder-columns/bootstrap-table.min.js"></script>
        <script src="js/reorder-columns/bootstrap-table-reorder-columns.js"></script>
<!--        <script src="js/majorette/pp-dragtable.js"></script>-->
        <script type="text/javascript" src="js/datetimepicker4/moment.min.js"></script>
        <script type="text/javascript" src="js/datetimepicker4/tempusdominus-bootstrap-4.min.js"></script>
        <link rel="stylesheet" href="css/datetimepicker4/tempusdominus-bootstrap-4.min.css" />
        <?php
        require 'js/majorette/date_picker.php'
        ?>
        <script type="text/javascript" src="js/majorette/pp-machine-assign-date.js"></script>
        <script type="text/javascript" src="js/majorette/pp-machine-currentTaskModal.js"></script>
        <script type="text/javascript" src="js/majorette/pp-machine-refresh.js"></script>
        <script type="text/javascript" src="js/majorette/pp-machine-multiplier.js"></script>
        <script type="text/javascript" src="js/majorette/pp-machine-clock.js"></script>
    </head>
    <body class="nav-fixed">
    <?php require 'pp-machine-sidenavAccordion.php'; ?>
        <div id="layoutSidenav">
            <?php require 'pp-machine-layoutSidenav_nav.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark pb-5">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4 mt-n10">
                        <!-- Example DataTable for Dashboard Demo-->
                        <div class="card mb-4 w-100" id="table-machine">
                            <div class="card-header bg-red fw-bold text-white fs-4 d-flex justify-content-between">
                                <div>Job overview by Machine</div>
                                <div>
                                    <span class="hours"></span> :
                                    <span class="min"></span> :
                                    <span class="sec"></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <!--                                    <thead class="table-dark">-->
                                    <thead class="text-black" style="background-color: #ffea07">

                                    <?php require 'pp-machine-table-head.php' ?>
                                    </thead>
                                    <!--                                    <tfoot class="table-dark">-->
                                    <tfoot class="text-black" style="background-color: #ffea07">
                                    <?php require 'pp-machine-table-head.php' ?>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    require "pp-machine-list-machine-script-readonly.php";
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="js/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="js/simple-datatables@latest" type="text/javascript"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
        <script src="js/litepicker/dist/bundle.js"></script>
        <script src="js/litepicker.js"></script>
    </body>
</html>
