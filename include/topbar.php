
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">ADMIN-SENDME</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">
                
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <?=@$_SESSION['adsme']['nom']?>
            </a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Mon profil</a></li>
                    <li><a href="logout.php">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                         Se déconnecter
                    </a></li>
                    
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>


<ol class="breadcrumb">
    <li> 
        <a href="#">
            <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
            Voir le site
        </a>
    </li>
    <li class="active">Current</li>
</ol>
