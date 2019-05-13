<?php

class Template{
    
    public static function header(){
        
        echo "
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='utf-8' />
    <link rel='icon' type='image/png' href='../assets/img/favicon.ico'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />

    <title>Título: </title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name='viewport' content='width=device-width' />


    <!-- Bootstrap core CSS     -->
    <link href='../assets/css/bootstrap.min.css' rel='stylesheet' />

    <!-- Animation library for notifications   -->
    <link href='../assets/css/animate.min.css' rel='stylesheet'/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href='../assets/css/light-bootstrap-dashboard.css?v=1.4.0' rel='stylesheet'/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href='../assets/css/demo.css' rel='stylesheet' />


    <!--     Fonts and icons     -->
    <link href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href='../assets/css/pe-icon-7-stroke.css' rel='stylesheet' />
    ";

    /*
    session_start();
    if ((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:login.php');
    }
    $logado = $_SESSION['login'];
      */  

echo "
</head>
<body>
";
    }
    
    public static function footer(){
        
        echo "
    <footer class='footer'>
    <div class='container-fluid'>
        <nav class='pull-left'>
            <ul>
                <li>
                    <a href='#'>
                        Home
                    </a>
                </li>
                <li>
                    <a href='#'>
                        Nossa Empresa
                    </a>
                </li>
                <li>
                    <a href='#'>
                        Portfolio
                    </a>
                </li>
                <li>
                    <a href='#'>
                       Blog
                    </a>
                </li>
            </ul>
        </nav>
        <p class='copyright pull-right'>
            &copy; <script>document.write(new Date().getFullYear())</script> <a href='http://www.creative-tim.com'>Ler Para Crer</a>, made with love for a better web
        </p>
    </div>
    </footer>

</div>
</div>


</body>

<!--   Core JS Files   -->
<script src='../assets/js/jquery.3.2.1.min.js' type='text/javascript'></script>
<script src='../assets/js/bootstrap.min.js' type='text/javascript'></script>

<!--  Charts Plugin -->
<script src='../assets/js/chartist.min.js'></script>

<!--  Notifications Plugin    -->
<script src='../assets/js/bootstrap-notify.js'></script>

<!--  Google Maps Plugin    -->
<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src='../assets/js/light-bootstrap-dashboard.js?v=1.4.0'></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src='../assets/js/demo.js'></script>

<script type='text/javascript'>
$(document).ready(function(){

        demo.initChartist();

        $.notify({
        icon: 'pe-7s-gift',
        message: 'Benvindo à <b>Biblioteca Ler para Crer</b> - sua visita é muito importante para nós. Boa Leitura.'

    },{
        type: 'info',
        timer: 400
    });

});
</script>

</html>
            ";
    }
    
    public static function sidebar(){
        
        echo "
<!-- inicio do menu lateral -->
<div class='wrapper'>
    <div class='sidebar' data-color='#' data-image='../assets/img/sidebar-6.png'>

    <!--

        Tip 1: you can change the color of the sidebar using: data-color='blue | azure | green | orange | red | purple'
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class='sidebar-wrapper'>
            <div class='logo'>
                <a href='../view/index.php' class='simple-text'>
                    Biblioteca Ler para Crer
                </a>
            </div>

            <ul class='nav'>
                <li class='active'>
                    <a href='dashboard.html'>
                        <i class='pe-7s-notebook'></i>
                        <p>Acervo</p>
                    </a>
                </li>
                <li>
                    <a href='user.html'>
                        <i class='pe-7s-users'></i>
                        <p>Usuários</p>
                    </a>
                </li>
                <li>
                    <a href='../view/categoria.php'>
                        <i class='pe-7s-note2'></i>
                        <p>Categoria</p>
                    </a>
                </li>
                <li>
                    <a href='typography.html'>
                        <i class='pe-7s-news-paper'></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                    <a href='icons.html'>
                        <i class='pe-7s-science'></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href='maps.html'>
                        <i class='pe-7s-map-marker'></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href='notifications.html'>
                        <i class='pe-7s-bell'></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li class='active-pro'>
                    <a href='upgrade.html'>
                        <i class='pe-7s-rocket'></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    
<!-- fim do menu lateral -->
";
    }
    
    public static function navbar(){
        
        echo "

<!-- inicio do menu superior -->
    
    <div class='main-panel'>
        <nav class='navbar navbar-default navbar-fixed'>
            <div class='container-fluid'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navigation-example-2'>
                        <span class='sr-only'>Toggle navigation</span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </button>
                    <a class='navbar-brand' href='#'>Painel de Controle</a>
                </div>
                <div class='collapse navbar-collapse'>
                    <ul class='nav navbar-nav navbar-left'>
                        <li>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                                <i class='fa fa-dashboard'></i>
                                <p class='hidden-lg hidden-md'>Dashboard</p>
                            </a>
                        </li>
                        <li class='dropdown'>
                              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                                    <i class='fa fa-globe'></i>
                                    <b class='caret hidden-lg hidden-md'></b>
                                    <p class='hidden-lg hidden-md'>
                                            5 Notifications
                                            <b class='caret'></b>
                                    </p>
                              </a>
                              <ul class='dropdown-menu'>
                                <li><a href='#'>Notification 1</a></li>
                                <li><a href='#'>Notification 2</a></li>
                                <li><a href='#'>Notification 3</a></li>
                                <li><a href='#'>Notification 4</a></li>
                                <li><a href='#'>Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href=''>
                                <i class='fa fa-search'></i>
                                <p class='hidden-lg hidden-md'>Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class='nav navbar-nav navbar-right'>
                        <li>
                           <a href=''>
                               <p>Account</p>
                            </a>
                        </li>
                        <li class='dropdown'>
                              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                                <p>
                                    Dropdown
                                    <b class='caret'></b>
                                </p>

                              </a>
                              <ul class='dropdown-menu'>
                                <li><a href='#'>Action</a></li>
                                <li><a href='#'>Another action</a></li>
                                <li><a href='#'>Something</a></li>
                                <li><a href='#'>Another action</a></li>
                                <li><a href='#'>Something</a></li>
                                <li class='divider'></li>
                                <li><a href='#'>Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href='#'>
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class='separator hidden-lg'></li>
                    </ul>
                </div>
            </div>
        </nav>

<!-- fim do menu superior -->
            ";
    }
}