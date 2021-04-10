<?php
use app\core\Application;

/** @var $params \app\models\UserModel
 */

$user = Application::$app->session->getAuth('user');

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ticketing System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/style.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
<!--    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">-->
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.bundle.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body style="background:#e4e4f0">

<div class="wrappNav">
    <nav class="navbar navbar-dark bg-dark justify-content-between adminNav">
        <a class="navbar-brand">Ticketing System Admin Panel</a>
    </nav>

</div>
<div class="sideBar">
    <ul class="list-group list-group-flush">
        <li class="list-group-item sideLi"><a href="/home">Home</a></li>
        <li class="list-group-item sideLi" ><a href="/userCreate">Create user</a></li>
        <li class="list-group-item sideLi" ><a href="/ticketing">Admin panel</a></li>
        <li class="list-group-item sideLi" ><a href="/reports">Reports</a></li>
        <li class="list-group-item sideLi" ><a href="/ticketCreate">Create ticket</a></li>
        <li class="list-group-item sideLi" ><a href="/myTickets">My tickets</a></li>
        <li class="list-group-item sideLi"><a href="/logout">Log out</a></li>
    </ul>
</div>
<div class="wrappCard">
    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Select2 -->
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">&nbsp;</div>
                {{ renderSection }}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

</div>




</body>
</html>