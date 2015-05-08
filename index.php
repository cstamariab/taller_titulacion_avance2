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
    </head>
    <body>        
           <div class="container">
               <div class="page-header">
                   <h3>Taller de Titulacion.</h3>
               </div>
               <div class="jumbotron-fluid">
                             <?php
                            include ('controlador/mantenedor.php');
                            $mantenedor = new mantenedor();
                            $mantenedor->insertar_Archivo();
                            
                            ?>
               </div>
           </div> 

    </body>
</html>
