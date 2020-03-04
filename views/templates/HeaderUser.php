<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>UAB Experience</title>
        <meta name="description" content="">
        <link rel="icon" href="resources/img/icona.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="resources/js/jquery-google.min.js"></script>
        <link rel="stylesheet" href="resources/css/test/bootstrap.min.css">
        <link rel="stylesheet" href="resources/css/test/starsStyle.css">
        <script src="resources/js/starsPlugin.js"></script>
        <!--local fonts-->
                <script type="text/javascript">
            var isLogged = true;
        </script>
        <script src="resources/js/initMap.js"></script>
        <script src="resources/js/eventListener.js"></script>
        <script src="resources/js/functions.js"></script>
        <script src="resources/js/newMap.js"></script>        
        <link rel="stylesheet" href="resources/css/test/style.css">
        <link rel="stylesheet" href="resources/css/test/font-awesome.min.css">
        <link rel="stylesheet" href="resources/css/test/responsive.css" />
        <script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBinJsJhkXxRljYWMp0FWHdOdyIlh9aanI&callback=initMap"></script>

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav navbar-left">
                <li class="logo"><a href="/EEmobi"><img src="/EEmobi/resources/img/logo_opt.png"/></a></li>
            </ul>
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
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

                    <ul class="nav navbar-nav navbar-left nav-scroll">
                        <li><a href="./searchSubject.php">Cercar per assignatures</a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right nav-scroll">
                       <li><a class="welcome" href="/EEmobi/Perfil"><?php echo $_SESSION['nom']; ?></a></li>
                     <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-lg" aria-hidden="true"></i>  <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            
                                <li><a href="/EEmobi/Perfil">Perfil</a></li>

                            
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
        