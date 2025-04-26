<?php 
require('partial/utilitaire.php');
if(!isset($_SESSION['adpto'])){
    header('Location:login.php');
        exit();
}
?>

<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="Assets/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
       <?php include('include/topbar.php');?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <?php include('include/sidebar.php');?>
                </div>
                <div class="col-md-9">
                <?php include('views/main.php');?>
                    
                </div>
            </div>

        <!-- jQuery -->
        <script src="Assets/js/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="Assets/js/bootstrap.min.js"></script>
    </body>
</html>
