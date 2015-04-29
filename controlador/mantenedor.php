<?php

class mantenedor {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';

    private function crearTabla() {

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        // Creamos la base de datos.
        $consulta = "CREATE database IF NOT EXISTS taller_titulacion";
        $crearBD = mysqli_query($conexion, $consulta);

        if (!$crearBD) { // IF creacion de base de datos
            echo '<p>Error al crear la base de datos</p> </br>';
        } else {
            echo '<p>Base de datos Creada Exitosamente</p> </br>';
            // seleccionando bbdd
            mysqli_select_db($conexion, 'taller_titulacion');

            //creando la tabla
            $tabla = "CREATE TABLE IF NOT EXISTS `resumen_total` (
                        `id_resumen` int unsigned AUTO_INCREMENT,
                        `nro_ticket` varchar(15) ,
                        `fecha_creacion` datetime,
                        `operador` varchar(20) ,
                        `cliente` varchar(25) ,
                        `nombre_operador` varchar(50),
                        `from_mail_operador` varchar(30),
                        `mail_destino`  varchar (50),
                        `tipo_notificacion` varchar (30),
                        `titulo_subject` text,
                        `precheck` varchar (5) ,
                        `estado_ticket` varchar (5),
                        `server_alert` varchar (30),
                        `fecha_close` datetime,
                        `operador_close` varchar(20),
                        `comentario_close` text,
                        `template` varchar (20),
                        `llave_event` text ,
                        `maquina` varchar(30),
                        `fecha_desde_evento` datetime,
                        `nodo` varchar(40),
                        `desc_alerta` text,
                        `fecha_ultima_actualizacion` datetime,
                        `valor_alerta` varchar(50),
                        `tipo_alerta` varchar(15),
                        `num_escalamiento` int,
                        `estado_gestion` varchar(5),
                        `estado_precheck` varchar(5),
                        `estado_alert` varchar (5),
                        `alerta_desaparece` varchar (5),
                        `grupo_nodo` varchar(20),
                        `server` varchar(20),
                        `fecha_asociar_ticket` datetime,
                        `marca_origen_event` varchar(5),
                        `devicetype` varchar(15), 
                                      
                        PRIMARY KEY (`id_resumen`)
                        

                      )";

            $crearTabla = mysqli_query($conexion, $tabla);

            if (!$crearTabla) { //if creacion tabla 
                echo '<p>Error al crear la tabla en la base de datos</p>';
            } else {
                echo '<p>La tabla se creo exitosamente.</p>';
            }
        }
    }

    public function insertar_Archivo() {
        $this->crearTabla();
        
        error_reporting(0);
        $errores =0;
        $exitosos=0;
        $limpiar = array('<br>','\n','\t');
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        //incrementa la memoria 
        ini_set('memory_limit', '2048M');
        //cambia el tiempo maximo de ejecucion de un script
        set_time_limit(300);
        $lineas = file('./recursos/registro.txt');
        
        //Ignora primera linea del archivo
        //array_shift($lineas);
        //array_pop($lineas);
        
//        echo'<table class = "table table-bordered table-striped table-hover">
//         <thead>
//        <tr>
//            <th class="active">nro_ticket</th>
//            <th>fecha_creacion</th>
//            <th>operador</th>
//            <th>cliente</th>
//            <th>nombre_operador</th>
//            <th>from_mail_operador</th>
//            <th>mail_destino</th>
//            <th>tipo_notificacion</th>
//            <th>titulo_subjet</th>
//            <th>precheck</th>
//            <th>estado_ticket</th>
//            <th>server_alert</th>
//            <th>fecha_close</th>
//            <th>operador_close</th>
//            <th>comentario_close</th>
//            <th>template</th>
//            <th>llave_event</th>
//            <th>maquina</td>
//            <th>fecha_desde_evento</th>
//            <th>nodo</th>
//            <th>desc_alert</th>
//            <th>fecha_ultima_Actualizacion</th>
//            <th>valor_alerta</th>
//            <th>tipo_alerta</th>
//            <th>num_escalamiento</th>
//            <th>estado_gestion</th>
//            <th>estado_precheck</th>
//            <th>estado_alert</th>
//            <th>alerta_desaparece</th>
//            <th>grupo_nodo</th>
//            <th>server</th>
//            <th>fecha_asociar_ticket</th>
//            <th>marca_origen_event</th>
//            <th>devicetype</th>
//        </tr>
//        </thead>';
        
        foreach ($lineas as $linea_num => $linea) {
            
            
            $linea = str_replace($limpiar, "", $linea);
            echo "<p>".$linea."</p>";
            
            $datos = explode("\t", $linea);
            
            $nro_ticket = $datos[0]; // ok
           
            $fecha_creacion = $datos[1]; // ok
            $fecha_creacion = date('Y-m-d H:i:s', $fecha_creacion);
            $operador = $datos[2]; // ok
          

            $cliente = $datos[3]; // ok
            $nombre_operador = $datos[4]; // ok

            if ($nombre_operador == "") {
                $nombre_operador = "#Nombre no Ingresado."; // ok
            }

            $from_mail_operador = $datos[5]; //ok 

            if ($from_mail_operador == "") {
                $from_mail_operador = "#Email No Ingresado."; // ok
            }

            $mail_destino = $datos[6]; // ok

            if ($mail_destino == "") {
                $mail_destino = "#Email No Ingresado"; // ok
            }

            $tipo_notificacion = $datos[7]; // ok
            $titulo_subject = $datos[8]; // ok
            if ($titulo_subject == "") {
                $titulo_subject = "#Titulo No Ingresado"; // ok
            }
            $precheck = $datos[9]; // ok
            $estado_ticket = $datos[10]; // ok
            // en la descripcion aparecen 2 server  
            // modificador de server a server_alert
            $server_alert = $datos[11]; // ok
            $fecha_close = $datos[12]; // ok

            if ($fecha_close == "" || $fecha_close == null) {
                $fecha_close = "#Fecha No Ingresada";
            } else {
                $fecha_close = date('Y-m-d H:i:s', $fecha_close);
            }
            $operador_close = $datos[13]; // ok
            if ($operador_close == "") {
                $operador_close = "#Nombre no Ingresado";
            }
            $comentario_close = trim($datos[14]); // ok
            if ($comentario_close == "") {
                $comentario_close = trim("#Sin Comentarios");
            }
            $template = trim($datos[15]); // ok
            $llave_event = $datos[16]; // ok
            $maquina = $datos[17]; // ok
            $fecha_desde_evento = $datos[18]; //ok
            
            if($fecha_desde_evento == "" || $fecha_desde_evento == null)
            {
                $fecha_desde_evento = null;
                }
                else
                {
                    $fecha_desde_evento = date('Y-m-d H:i:s', $fecha_desde_evento);
                }
            
            $nodo = $datos[19]; // ok
            $desc_alerta = $datos[20]; // ok
            $fecha_ultima_actualizacion = $datos[21]; //ok
            if($fecha_ultima_actualizacion == "" || $fecha_ultima_actualizacion == null)
                {
                 $fecha_ultima_actualizacion = "#fecha no ingresada";
                 
                }else{
                    $fecha_ultima_actualizacion = date('Y-m-d H:i:s', $fecha_ultima_actualizacion);
                }
            $valor_alerta = $datos[22]; //ok
            $tipo_alerta = $datos[23]; // ok
            $num_escalamiento = $datos[24]; //ok
            $estado_gestion = $datos[25];  //ok
            $estado_precheck = $datos[26]; // ok
            $estado_alert = $datos[27]; // ok
            $alerta_desaparece = $datos[28]; // ok
            $grupo_nodo = $datos[29]; // ok
            $server = $datos[30]; // ok
            $fecha_asociar_ticket = $datos[31]; //ok
            $marca_origen_event = $datos[32]; // ok
            $devicetype = $datos[33]; //ok

            mysqli_select_db($conexion, 'taller_titulacion');
            
            $inserta = "INSERT INTO resumen_total (nro_ticket,fecha_creacion,operador,cliente,nombre_operador,from_mail_operador,mail_destino,tipo_notificacion,titulo_subject,precheck"
                    . ",estado_ticket,server_alert,fecha_close,operador_close,comentario_close,template,llave_event,maquina,fecha_desde_evento,nodo,desc_alerta"
                    . ",fecha_ultima_actualizacion,valor_alerta,tipo_alerta,num_escalamiento,estado_gestion,estado_precheck,estado_alert,alerta_desaparece"
                    . ",grupo_nodo,server,fecha_asociar_ticket,marca_origen_event,devicetype) "
                    . "VALUES('" . $nro_ticket . "','" . $fecha_creacion . "','" . $operador . "','" . $cliente . "','" . $nombre_operador . "'"
                    . ",'" . $from_mail_operador . "','" . $mail_destino . "','" . $tipo_notificacion . "','" . $titulo_subject . "','" . $precheck . "'"
                    . " ,'" . $estado_ticket . "','" . $server_alert . "','" . $fecha_close . "','" . $operador_close . "','" . $comentario_close . "'"
                    . ",'" . $template . "','" . $llave_event . "','" . $maquina . "','" . $fecha_desde_evento . "','" . $nodo . "','" . $desc_alerta . "','" . $fecha_ultima_actualizacion . "'"
                    . ",'" . $valor_alerta . "','" . $tipo_alerta . "','" . $num_escalamiento . "','" . $estado_gestion . "','" . $estado_precheck . "','" . $estado_alert . "'"
                    . ",'" . $alerta_desaparece . "','" . $grupo_nodo . "','" . $server . "','" . $fecha_asociar_ticket . "','" . $marca_origen_event . "','" . $devicetype . "')";

            $insertado = mysqli_query($conexion, $inserta);

            if (!$insertado) {
                echo "<p>OCURRIO UN ERROR AL INSERTAR LOS DATOS !!</p> ";
                $errores++;
            } else {
//                echo"<p> Datos ingresados Correctamente.</p>";
                $exitosos++;
//                echo'
//       
//        <tbody>
//        <tr>
//            <td>' . $nro_ticket . '</td>
//            <td>' . $fecha_creacion . '</td>
//            <td>'.$operador.'</td>
//            <td>'.$cliente.'</td>
//            <td>'.$nombre_operador.'</td>
//            <td>'.$from_mail_operador.'</td>
//            <td>'.$mail_destino.'</td>
//            <td>'.$tipo_notificacion.'</td>
//            <td>'.$titulo_subject.'</td>
//            <td>'.$precheck.'</td>
//            <td>'.$estado_ticket.'</td>
//            <td>'.$server_alert.'</td>
//            <td>'.$fecha_close.'</td>
//            <td>'.$operador_close.'</td>
//            <td>'.$comentario_close.'</td>
//            <td>'.$template.'</td>
//            <td>'.$llave_event.'</td>
//            <td>'.$maquina.'</td>
//            <td>'.$fecha_desde_evento.'</td>
//            <td>'.$nodo.'</td>
//            <td>'.$desc_alerta.'</td>
//            <td>'.$fecha_ultima_actualizacion.'</td>
//            <td>'.$valor_alerta.'</td>
//            <td>'.$tipo_alerta.'</td>
//            <td>'.$num_escalamiento.'</td>
//            <td>'.$estado_gestion.'</td>
//            <td>'.$estado_precheck.'</td>
//            <td>'.$estado_alert.'</td>
//            <td>'.$alerta_desaparece.'</td>
//            <td>'.$grupo_nodo.'</td>
//            <td>'.$server.'</td>
//            <td>'.$fecha_asociar_ticket.'</td>
//            <td>'.$marca_origen_event.'</td>
//            <td>'.$devicetype.'</td> 
//        </tr>
//        </tbody> ';
            }
        }
        echo "<h1>Registros Ingresados Exitosamente :$exitosos  </h1> ";
        echo "<p>Registros No Ingresados : $errores</p> ";
        
//         echo'</table>';
    }

    public function crearTablas() {
        
    }
    

    public function insertaArchivo2() {
        $this->crearTabla();
        $archivo = fopen( "./recursos/registro.txt", "rb" );
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
       
        while( feof($archivo) == false )
     {
         $datos = fgetcsv( $archivo, 500, "\n");

           echo $nro_ticket = $datos[0]; // ok
           echo $nro_ticket = str_replace("<br>", "", $nro_ticket);
           if($nro_ticket == "" || $nro_ticket == null)
               {
               $nro_ticket = "Sin numero";
               }
            echo$fecha_creacion = $datos[1]; // ok
            echo$fecha_creacion = date('Y-m-d H:i:s', $fecha_creacion);
            echo$operador = $datos[2]; // ok

           echo $cliente = $datos[3]; // ok
            echo $nombre_operador = $datos[4]; // ok

            if ($nombre_operador == "") {
                $nombre_operador = "#Nombre no Ingresado."; // ok
            }

            $from_mail_operador = $datos[5]; //ok 

            if ($from_mail_operador == "") {
                $from_mail_operador = "#Email No Ingresado."; // ok
            }

            $mail_destino = $datos[6]; // ok

            if ($mail_destino == "") {
                $mail_destino = "#Email No Ingresado"; // ok
            }

            $tipo_notificacion = $datos[7]; // ok
            $titulo_subject = $datos[8]; // ok
            if ($titulo_subject == "") {
                $titulo_subject = "#Titulo No Ingresado"; // ok
            }
            $precheck = $datos[9]; // ok
            $estado_ticket = $datos[10]; // ok
            // en la descripcion aparecen 2 server  
            // modificador de server a server_alert
            $server_alert = $datos[11]; // ok
            $fecha_close = $datos[12]; // ok

            if ($fecha_close == "" || $fecha_close == null) {
                $fecha_close = "#Fecha No Ingresada";
            } else {
                $fecha_close = date('Y-m-d H:i:s', $fecha_close);
            }
            $operador_close = $datos[13]; // ok
            if ($operador_close == "") {
                $operador_close = "#Nombre no Ingresado";
            }
            $comentario_close = $datos[14]; // ok
            if ($comentario_close == "") {
                $comentario_close = "#Sin Comentarios";
            }
            $template = $datos[15]; // ok
            $llave_event = $datos[16]; // ok
            $maquina = $datos[17]; // ok
            $fecha_desde_evento = $datos[18]; //ok
            $fecha_desde_evento = date('Y-m-d H:i:s', $fecha_desde_evento);
            $nodo = $datos[19]; // ok
            $desc_alerta = $datos[20]; // ok
            $fecha_ultima_actualizacion = $datos[21]; //ok
            $fecha_ultima_actualizacion = date('Y-m-d H:i:s', $fecha_ultima_actualizacion);
            $valor_alerta = $datos[22]; //ok
            $tipo_alerta = $datos[23]; // ok
            $num_escalamiento = $datos[24]; //ok
            $estado_gestion = $datos[25];  //ok
            $estado_precheck = $datos[26]; // ok
            $estado_alert = $datos[27]; // ok
            $alerta_desaparece = $datos[28]; // ok
            $grupo_nodo = $datos[29]; // ok
            $server = $datos[30]; // ok
            $fecha_asociar_ticket = $datos[31]; //ok
            $marca_origen_event = $datos[32]; // ok
            $devicetype = $datos[33]; 
        echo "--------------------------<br />";
          mysqli_select_db($conexion, 'taller_titulacion');
            $inserta = "INSERT INTO resumen_total (nro_ticket,fecha_creacion,operador,cliente,nombre_operador,from_mail_operador,mail_destino,tipo_notificacion,titulo_subject,precheck"
                    . ",estado_ticket,server_alert,fecha_close,operador_close,comentario_close,template,llave_event,maquina,fecha_desde_evento,nodo,desc_alerta"
                    . ",fecha_ultima_actualizacion,valor_alerta,tipo_alerta,num_escalamiento,estado_gestion,estado_precheck,estado_alert,alerta_desaparece"
                    . ",grupo_nodo,server,fecha_asociar_ticket,marca_origen_event,devicetype) "
                    . "VALUES('" . $nro_ticket . "','" . $fecha_creacion . "','" . $operador . "','" . $cliente . "','" . $nombre_operador . "'"
                    . ",'" . $from_mail_operador . "','" . $mail_destino . "','" . $tipo_notificacion . "','" . $titulo_subject . "','" . $precheck . "'"
                    . " ,'" . $estado_ticket . "','" . $server_alert . "','" . $fecha_close . "','" . $operador_close . "','" . $comentario_close . "'"
                    . ",'" . $template . "','" . $llave_event . "','" . $maquina . "','" . $fecha_desde_evento . "','" . $nodo . "','" . $desc_alerta . "','" . $fecha_ultima_actualizacion . "'"
                    . ",'" . $valor_alerta . "','" . $tipo_alerta . "','" . $num_escalamiento . "','" . $estado_gestion . "','" . $estado_precheck . "','" . $estado_alert . "'"
                    . ",'" . $alerta_desaparece . "','" . $grupo_nodo . "','" . $server . "','" . $fecha_asociar_ticket . "','" . $marca_origen_event . "','" . $devicetype . "')";

            $insertado = mysqli_query($conexion, $inserta);

    }
    fclose( $archivo );
        
    }

}
