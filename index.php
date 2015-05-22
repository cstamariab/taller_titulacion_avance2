<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="vista/css/bootstrap.css"/>
        <link rel="stylesheet" href="vista/css/navbar.css"/>
         <script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
         <script>
         $(document).ready(function (){
             $('body').css("background","black"));
         });
         </script>
    </head>
    <body> 
         <nav class="navbar  navbar-inverse ">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Taller de Titulacion</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav ">
                            <li class="active"><a href="index.php">Cargar Datos.</a></li>
                            <li ><a href="maqueteando.php">Ver Tablas</a></li>
                         </ul>
                        
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </nav>
            <div class="container containers">
                <div class="page-header">
                    <h3>Taller de Titulacion.</h3>
                </div>
                <div class="jumbotron">
                    <?php
                    include ('controlador/mantenedor.php');
                    $mantenedor = new mantenedor();
                    $limpio = $mantenedor->concatLineas();
                    $mantenedor->insertar_Archivo($limpio);
       
                    ?>
                </div>
            </div> 
            
            <script src="js/bootstrap.min.js"></script>
            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            
    </body>
</html>
