<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Perfil</title>
        <meta name="description" content="">
        <link rel="icon" href="resources/img/icona.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!--Google fonts links-->
        <script src="/EEmobi/resources/js/jquery-google.min.js"></script>
        <link rel="stylesheet" href="/EEmobi/resources/css/test/bootstrap.min.css">   
        <script src="/EEmobi/resources/js/bootstrap.min.js"></script>
        <!--For Plugins external css-->
        <script src="resources/js/eventListener.js"></script>
        <script src="resources/js/functions.js"></script>
        <script type="text/javascript" src="/EEmobi/resources/js/scrollUp.js"></script>
        <script src="resources/js/starsPlugin.js"></script>
        <!--Theme custom css -->
        <link rel="stylesheet" href="/EEmobi/resources/css/test/style.css">
        <link rel="stylesheet" href="/EEmobi/resources/css/test/styleTimeline.css">
        <link rel="stylesheet" href="resources/css/test/starsStyle.css">

        <link rel="stylesheet" href="/EEmobi/resources/css/test/perfil.css">
        <script src="/EEmobi/resources/js/toggleTable.js"></script>
        <link rel="stylesheet" href="/EEmobi/resources/css/test/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/EEmobi/resources/css/test/jquery.dataTables.min.css"/>

        <script type="text/javascript" src="/EEmobi/resources/js/jquery.dataTables.min.js"></script>


        <!--Theme Responsive css-->
        <link rel="stylesheet" href="/EEmobi/resources/css/test/responsive.css" />


    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="logo"><a href="/EEmobi"><img src="/EEmobi/resources/img/logo_opt.png"></li>
                    </ul>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <!-- <a class="navbar-brand" href="#"><img src="resources/img/uab.png" alt="Logo" /></a>-->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="./searchSubject.php">Cercar per assignatures</a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right ">
                         <li class="welcome"><?php echo $_SESSION['nom']; ?></li> 
                         <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-lg" aria-hidden="true"></i>  <span class="caret"></span></a>
                            <ul class="dropdown-menu">

                            <?php if(isset($_SESSION['admin'])){ ?>
                              <li><a href="/EEmobi/admin.php">Administració</a></li>
                                <?php } ?>
                              <li><a href="/EEmobi/logout.php">Sortir <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>                             
                            </ul>
                        </li>
                    </ul>  

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        