<?php 
require('partial/functions.php');

if(isset($_SESSION['adpto'])){
    header('Location:home.php');
        exit();
}
//Soumission de formulaire
if(isset($_POST['btnConnexion'])){
    //Recupération des données
    $username = htmlspecialchars(trim($_POST['username']));
    $pwd = htmlspecialchars(trim($_POST['pwd']));
    //Vérification des champs
    if(empty($username)){
        $mgs = '<div class="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Veuiller entrer votre E-mail</strong>
    </div>';
    }elseif(empty($pwd)){
        $mgs = '<div class="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Vérifiez votre mot de passe</strong>
    </div>';
    }elseif (count(loginAdmin($username, md5($pwd))) == 0){
        $mgs = '<div class="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>mote de passe ou e-mail incorrect </strong>
    </div>';
    } else{
        //Récupération de l'admin dans la variable session
        $_SESSION['adpto'] = loginAdmin($username, md5($pwd));
        //Redirection vers la page de connexion
        header('Location:home.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion</title>

        <!-- Bootstrap CSS -->
        <link href="Assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--Bar de navigation-->
        
        <nav class="navbar navbar-inverse" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color: #333">SendMe</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
            
            </div><!-- /.navbar-collapse -->
        </nav>
        <br><br>
        <?=@$mgs?>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="border:1px solid black; box-shadow: 1px 2px gray; border-radius: 10px; margin-bottom: 5px; background-color:hsl(77, 52.50%, 84.30%)">
                    <h3 class="text-center">Espace de connexion</h3>
                <!-- Formulaire de connection-->
                    <form action="" method="post">
                        <div class="row">
                           <div class="col-md-12">
                            <label for="username">Nom d'utilisateur: <strong class="text-danger"></strong>*</label>
                            <input type="text" name="username" class="form-control" id="username"/>
                           </div> 
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-md-12">
                            <label for="pwd">Mot de passe: <strong class="text-danger"></strong>*</label>
                               <input type="text" name="pwd" class="form-control" id="pwd"  class="glyphicon glyphicon-eye-close" aria-hidden="true">
                                  <span ></span>                         
                            
                           </div> 
                        </div>
                        <br>
                        <div class="row">
                           <div class="col-md-12 text-center">
                            <button class="btn btn-primary" name="btnConnexion" type="submit">
                            <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                             Connexion</button>
                           </div> 
                        </div>
                        <br><br>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="Assets/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="Assets/js/bootstrap.min.js"></script>
    </body>
</html>