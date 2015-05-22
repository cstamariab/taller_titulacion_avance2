<?php

class mantenedor {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';

    public function mostrarConsulta($campos) {

        $conexion = new mysqli($this->host, $this->user, $this->pass, "taller_titulacion");
        $consulta = "select $campos from grupos gr , clientes cl , nodos nod,ticket tk ,ticket_detalle tkd , host h where cl.cliente= gr.cliente and gr.llave_grupo_nodo = nod.llave_grupo_nodo and cl.cliente = tk.cli_nombre and tk.nro_ticket = tkd.nro_ticket and nod.nodo =h.nodo  limit 0 , 1000 ";
        $resultado = $conexion->query($consulta);
        $nfilas = $resultado->num_rows;
        if ($nfilas > 0) {

   echo '<link rel="stylesheet" href="../vista/css/bootstrap.css"/> '
      . '<link rel="stylesheet" href="../vista/css/navbar.css"/>'
           . '<style>body{background:background: #7d7e7d; /* Old browsers */
background: -moz-linear-gradient(top,  #7d7e7d 0%, #0e0e0e 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7d7e7d), color-stop(100%,#0e0e0e)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #7d7e7d 0%,#0e0e0e 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #7d7e7d 0%,#0e0e0e 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #7d7e7d 0%,#0e0e0e 100%); /* IE10+ */
background: linear-gradient(to bottom,  #7d7e7d 0%,#0e0e0e 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#7d7e7d", endColorstr="#0e0e0e",GradientType=0 ); /* IE6-9 */
border-radius: 5px;
box-shadow: 2 2 2  black;;}</style>'
      . '<div class="container-fluid">'
                    . '<div class="row"> '
                       . '<div class="col-xs-12">'
                         . '<table class="table table-striped table-bordered">';
                   
            $datos = explode(",", $campos);
            $cant_campos = count($datos);
            error_reporting(0);
            $cabecera="<tr>";
            for($i=0;$i<=$cant_campos-1;$i++){
                $cabecera .="<th>".$datos[$i]."</th>"; 
            }
            $cabecera .="</tr>";
            echo $cabecera;
            while ($fila = $resultado->fetch_assoc()) {
                echo ' <tr>';
                if ($fila["nro_ticket"] != null) {
                    echo '<td class="success"> ' . $fila["nro_ticket"] . '</td>';
                }
                if ($fila["fecha_creacion"] != null) {
                    echo '<td> ' . $fila["fecha_creacion"] . '</td>';
                }
                if ($fila["operador"] != null) {
                    echo '<td> ' . $fila["operador"] . '</td>';
                }
                if ($fila["nombre_operador"] != null) {
                     echo '<td> ' . $fila["nombre_operador"] . '</td>';
                }
                  if ($fila["from_mail_operador"] != null) {
                     echo '<td> ' . $fila["from_mail_operador"] . '</td>';
                }
                 if ($fila["mail_destino"] != null) {
                     echo '<td> ' . $fila["mail_destino"] . '</td>';
                }
                 if ($fila["tipo_notificacion"] != null) {
                     echo '<td> ' . $fila["tipo_notificacion"] . '</td>';
                }
                  if ($fila["titulo_subject"] != null) {
                     echo '<td> ' . $fila["titulo_subject"] . '</td>';
                }
                 if ($fila["server_alert"] != null) {
                     echo '<td> ' . $fila["server_alert"] . '</td>';
                }
                 if ($fila["fecha_close"] != null) {
                     echo '<td> ' . $fila["fecha_close"] . '</td>';
                }
                 if ($fila["operador_close"] != null) {
                     echo '<td> ' . $fila["operador_close"] . '</td>';
                }
                if ($fila["comentario_close"] != null) {
                     echo '<td> ' . $fila["comentario_close"] . '</td>';
                }
                if ($fila["template"] != null) {
                     echo '<td> ' . $fila["template"] . '</td>';
                }
                if ($fila["llave_event"] != null) {
                     echo '<td> ' . $fila["llave_event"] . '</td>';
                }
                if ($fila["maquina"] != null) {
                     echo '<td> ' . $fila["maquina"] . '</td>';
                }
                if ($fila["fecha_desde_evento"] != null) {
                     echo '<td> ' . $fila["fecha_desde_evento"] . '</td>';
                }
               
                if ($fila["desc_alerta"] != null) {
                     echo '<td> ' . $fila["desc_alerta"] . '</td>';
                }
                if ($fila["fecha_ultima_actualizacion"] != null) {
                     echo '<td> ' . $fila["fecha_ultima_actualizacion"] . '</td>';
                }
                if ($fila["valor_alerta"] != null) {
                     echo '<td> ' . $fila["valor_alerta"] . '</td>';
                }
                if ($fila["tipo_alerta"] != null) {
                     echo '<td> ' . $fila["tipo_alerta"] . '</td>';
                }
                if ($fila["num_escalamiento"] != null) {
                     echo '<td> ' . $fila["num_escalamiento"] . '</td>';
                }
                if ($fila["estado_gestion"] != null) {
                     echo '<td> ' . $fila["estado_gestion"] . '</td>';
                }
                if ($fila["estado_precheck"] != null) {
                     echo '<td> ' . $fila["estado_precheck"] . '</td>';
                }
                if ($fila["estado_alert"] != null) {
                     echo '<td> ' . $fila["estado_alert"] . '</td>';
                }
                
                if ($fila["server"] != null) {
                     echo '<td> ' . $fila["server"] . '</td>';
                }
                if ($fila["fecha_asociar_ticket"] != null) {
                     echo '<td> ' . $fila["fecha_asociar_ticket"] . '</td>';
                }
                 if ($fila["marca_origen_event"] != null) {
                     echo '<td> ' . $fila["marca_origen_event"] . '</td>';
                }
                
                  if ($fila["llave_grupo_nodo"] != null) {
                     echo '<td> ' . $fila["llave_grupo_nodo"] . '</td>';
                }
                if ($fila["grupo_nodo"] != null) {
                     echo '<td> ' . $fila["grupo_nodo"] . '</td>';
                }
                 if ($fila["cliente"] != null) {
                     echo '<td> ' . $fila["cliente"] . '</td>';
                }
                if ($fila["nodo"] != null) {
                     echo '<td> ' . $fila["nodo"] . '</td>';
                }
                if ($fila["devicetype"] != null) {
                     echo '<td> ' . $fila["devicetype"] . '</td>';
                }
                if ($fila["ip_nodo"] != null) {
                     echo '<td> ' . $fila["ip_nodo"] . '</td>';
                }
                
                

                echo'</tr>';
            }

     
            echo'</table></div></div>'
            
            . '</div>';
        }
    }

    private function TablaResumen() {

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        // Creamos la base de datos.
        $dropBD = "drop database taller_titulacion";
        $consulta = "CREATE database IF NOT EXISTS taller_titulacion";
        $dropsBD = mysqli_query($conexion, $dropBD);
        $crearBD = mysqli_query($conexion, $consulta);

        if (!$crearBD) { // IF creacion de base de datos
            echo '<p>Error al crear la base de datos</p> ';
        } else {
            
            // seleccionando bbdd
            mysqli_select_db($conexion, 'taller_titulacion');
            $drop = "drop table if exists `resumen_total` where 1";
            //creando la tabla

            $tabla = "CREATE TABLE `resumen_total` (
                        `id_resumen` int unsigned AUTO_INCREMENT,
                        `nro_ticket` varchar(15) not null ,
                        `fecha_creacion` datetime,
                        `operador` varchar(20) ,
                        `cliente` varchar(25) not null,
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
                        `llave_event` varchar(250) ,
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
            $dropp = mysqli_query($conexion, $drop);
            $crearTabla = mysqli_query($conexion, $tabla);


            if (!$crearTabla) { //if creacion tabla 
                echo '<p>Error al crear la tabla en la base de datos</p>';
            } else {
               
            }
        }
    }

    public function concatLineas() {
        $this->TablaResumen();

        $auxiliar = array();
        $limpio = array();
        $limpiar = array("<br>", "\n", "\n<br>", "\n\r", "\n\n<br>");

        ini_set('memory_limit', '2048M');
        //cambia el tiempo maximo de ejecucion de un script
        set_time_limit(3600);
        error_reporting(0);
        $lineas = file('./recursos/registro.txt');

        $num_lineas = count($lineas);

        for ($i = 0; $i <= $num_lineas; $i++) {
            $cant_tab = count(explode("\t", $lineas[$i]));

            if ($cant_tab == 33) {

                $auxiliar[] = $lineas[$i];

                $num_lineas = count($lineas);
            } else if ($cant_tab > 33) {

                $auxiliar[] = $lineas[$i];
                $num_lineas = count($lineas);
            } else if ($cant_tab < 33) {
                if (count(explode("\t", $lineas[$i - 1])) >= 33) {
                    
                } else {
                    $auxiliar[] = $lineas[$i - 1] . $lineas[$i];
                    unset($lineas[$i]);

                    $lineas = array_values($lineas);
                    $num_lineas = count($lineas);
                }
            }
        }

        $countAux = count($auxiliar);

        for ($z = 0; $z <= $countAux; $z++) {
            $auxiliar[$z] = str_replace($limpiar, "", $auxiliar[$z]);
            $limpio[] = $auxiliar[$z];
        }
        $can_limpio = count($limpio);
        for ($x = 0; $x <= $can_limpio; $x++) {

            $cadena = $limpio[$x];



            $claves = preg_replace("/\t hrs./", "", $cadena);
            $cadena = $claves;
            $claves = preg_replace("/hrs./", "", $cadena);
            $cadena = $claves;
            
            
          

            $claves = preg_replace("/se normalizo el \t/", "se normalizo el", $cadena);


            $limpio[$x] = $claves;
        }

        return $limpio;
    }

    public function insertar_Archivo($limpio) {

        $errores = 0;
        $exitosos = 0;
        $coincidencias = 0;
        error_reporting(0);
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        //incrementa la memoria 
        ini_set('memory_limit', '2048M');
        //cambia el tiempo maximo de ejecucion de un script
        set_time_limit(3600);

        $cant_limpio = count($limpio);
        for ($i = 0; $i <= $cant_limpio; $i++) {


            $datos = explode("\t", $limpio[$i]);

            $nro_ticket = $datos[0]; // ok

            $fecha_creacion = $datos[1]; // ok
            $fecha_creacion = date('Y-m-d h:i:s', $fecha_creacion);
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
            if ($titulo_subject == null or $titulo_subject == "") {
                $titulo_subject = "#Titulo No Ingresado"; // ok
            }
            $precheck = $datos[9]; // ok
            $estado_ticket = $datos[10]; // ok
            // en la descripcion aparecen 2 server  
            // modificador de server a server_alert
            $server_alert = $datos[11]; // ok
            $fecha_close = $datos[12]; // ok

            if ($fecha_close == "") {
                $fecha_close = "#Fecha No Ingresada";
            } else {
                $fecha_close = date('Y-m-d h:i:s', $fecha_close);
            }
            $operador_close = $datos[13]; // ok
            if ($operador_close == "") {
                $operador_close = "#Nombre no Ingresado";
            }
            $comentario_close = $datos[14]; // ok

            $template = $datos[15]; // ok
            $llave_event = $datos[16]; // ok
            $maquina = $datos[17]; // ok
            $fecha_desde_evento = $datos[18]; //ok

            if ($fecha_desde_evento == "") {
                $fecha_desde_evento = "#fecha no ingresada";
            } else {
                $fecha_desde_evento = date('Y-m-d h:i:s', $fecha_desde_evento);
            }

            $nodo = $datos[19]; // ok
            $desc_alerta = $datos[20]; // ok
            $fecha_ultima_actualizacion = $datos[21]; //ok
            if ($fecha_ultima_actualizacion == "") {
                $fecha_ultima_actualizacion = "#fecha no ingresada";
            } else {
                $fecha_ultima_actualizacion = date('Y-m-d h:i:s', $fecha_ultima_actualizacion);
            }
            $valor_alerta = $datos[22]; //ok
            $tipo_alerta = $datos[23]; // ok
            $num_escalamiento = $datos[24]; //ok
            $estado_gestion = $datos[25];  //ok
            $estado_precheck = $datos[26]; // ok
            $estado_alert = $datos[27]; // ok
            $alerta_desaparece = $datos[28]; // ok
            $grupo_nodo = $datos[29];
            if ($grupo_nodo == null) {
                $grupo_nodo = "TODOS";
            }// ok
            $server = $datos[30]; // ok
            $fecha_asociar_ticket = $datos[31]; //ok
            $marca_origen_event = $datos[32]; // ok
            $devicetype = $datos[33]; //ok

            mysqli_select_db($conexion, 'taller_titulacion');

//           if(preg_match("/^[a-z3-9]+$/", substr($nro_ticket,0,1)) == 1 ) {
            if (preg_match("/([A-Z]+[0-9]+[0-9]+-+[0-9]+[0-9])/", $nro_ticket) == 1 and $llave_event != null and $cliente != null and $nro_ticket != "E009-1003" and ( $grupo_nodo != "true" or $grupo_nodo != "false")) {
                // string only contain the a to z , A to Z, 0 to 9

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
                }
            }
        }//termino del for
       
        echo "<h2>Registros Ingresados Exitosamente :$exitosos  </h2> ";
        
        $this->TablaCliente();
        $this->tablaTicket();
        $this->tablaGrupoNodo();
        $this->tablaNodo();
        $this->tablaTicketDetalle();
        $this->tablaHost();
    }

    public function TablaCliente() {

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $drop = "drop table if exists clientes";
        $grupo = "create table clientes (PRIMARY KEY (`cliente`)) as select `cliente`  from `resumen_total` group by `cliente` ";
        // agrego el campo id_grupo a la tabla
        // ***
        // EJECUCION DE QUERYS
        $drops = mysqli_query($conexion, $drop);
        $grupo1 = mysqli_query($conexion, $grupo);


        //****
        if ($grupo1 || $drops) {

            echo"<h2>Tabla CLIENTES creada con exito.</h2>";
        } else {
            echo"<p>Ocurrio un problema al crear la tabla cliente</p>";
        }
    }

    public function tablaTicket() {

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        $drop = "drop table ticket";
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table ticket (PRIMARY KEY (`nro_ticket`),FOREIGN KEY (`cli_nombre`) REFERENCES clientes (`cli_nombre`)) as SELECT `nro_ticket`, `fecha_creacion`, `operador`, `nombre_operador`,`cliente` as `cli_nombre` , `from_mail_operador`, `mail_destino`, `tipo_notificacion`, `titulo_subject`, `precheck`, `estado_ticket`, `server_alert`, `fecha_close`, `operador_close`, `comentario_close`, `template` FROM `resumen_total`   group by nro_ticket";

        // borro los registros de la tabla para poder agregar la llave primaria al campo id_grupo
        // ***
        // EJECUCION DE QUERYS

        $drops = mysqli_query($conexion, $drop);
        $grupo1 = mysqli_query($conexion, $grupo);


        //****
        if ($grupo1 || $drops) {
            echo"<h2>Tabla TICKETS creada con exito.</h2>";
        } else {
            echo"<h2>Ocurrio un problema al crear la tabla TICKETS</h2>";
        }
    }

    public function tablaTicketDetalle() {

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $drop = "drop table detalle_ticket";
        $grupo = "Create table ticket_detalle (PRIMARY KEY (llave_event) , FOREIGN KEY (nodo,grupo_nodo)references nodos(llave_grupo_nodo,nodo)) as SELECT `llave_event`,`nro_ticket`,`maquina`,`fecha_desde_evento`,`nodo`,`desc_alerta`,`fecha_ultima_actualizacion`,`valor_alerta`,`tipo_alerta`,`num_escalamiento`,`estado_gestion`,`estado_precheck`,`estado_alert`,`alerta_desaparece`,CONCAT(`cliente`,'::',`grupo_nodo`)as grupo_nodo ,`server`,`fecha_asociar_ticket`,`marca_origen_event` FROM resumen_total  group by llave_event ";

        // EJECUCION DE QUERYS
        $drops = mysqli_query($conexion, $drop);
        $grupo1 = mysqli_query($conexion, $grupo);


        //****
        if ($grupo1 || $drops) {
            echo"<h2>Tabla DETALLE_TICKETS creada con exito</h2>";
            
        } else {
            echo"Ocurrio un problema con el ticket";
        }
    }

//
    public function tablaGrupoNodo() {
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        $drop = "drop table grupos WHERE 1 ";
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table grupos (PRIMARY KEY (`llave_grupo_nodo`),FOREIGN KEY (`cliente`) references clientes(`cliente`)) as select concat(cliente,'::',grupo_nodo) as `llave_grupo_nodo` ,`cliente`,`grupo_nodo` from resumen_total group by cliente,grupo_nodo  ";
        // agrego el campo id_grupo a la tabla
        // ***
        // EJECUCION DE QUERYS
        $borrar1 = mysqli_query($conexion, $drop);
        $grupo1 = mysqli_query($conexion, $grupo);



        //****
        if ($grupo1 || $borrar1) {
            echo"<h2>Tabla GRUPOS creada con exito</h2>";
        } else {
            echo"<p>Ocurrio un problema Creando  la Tabla Grupo_Nodo .</p>";
        }
    }

    public function tablaNodo() {
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        $drop = "drop table nodos WHERE 1 ";
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table nodos(PRIMARY KEY (`llave_grupo_nodo`,`nodo`) ,FOREIGN KEY (`llave_grupo_nodo`)references grupos (llave_grupo_nodo)) as select concat(cliente,'::',grupo_nodo) as llave_grupo_nodo ,nodo,devicetype from resumen_total group by llave_grupo_nodo, nodo ";
        // agrego el campo id_grupo a la tabla
        // ***
        // EJECUCION DE QUERYS
        $borrar1 = mysqli_query($conexion, $drop);
        $grupo1 = mysqli_query($conexion, $grupo);



        //****
        if ($grupo1 || $borrar1) {
            echo"<h2>Tabla NODOS creada con exito</h2>";
        } else {
            echo"<p>Ocurrio un problema Creando  la Tabla Nodo .</p>";
        }
    }

    public function tablaHost() {
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        $drop = "drop table host WHERE 1 ";
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table Host( id_host int unsigned auto_increment , PRIMARY KEY (`id_host`) ,ip_nodo varchar(20),FOREIGN KEY (`nodo`)references nodos (`nodo`))auto_increment=168000000 as SELECT  nodo FROM `ticket_detalle` WHERE 1 group by nodo  ";
        $update = "UPDATE `host` SET `ip_nodo`=inet_ntoa(`id_host`) ";


        // ***
        // EJECUCION DE QUERYS
        $borrar1 = mysqli_query($conexion, $drop);
        $grupo1 = mysqli_query($conexion, $grupo);
        $update1 = mysqli_query($conexion, $update);



        //****
        if ($grupo1 || $borrar1 || $update1) {
            echo"<h2>Tabla HOST creada con exito</h2>";
        } else {
            echo"<p>Ocurrio un problema Creando  la Tabla HOST .</p>";
        }
    }

}
