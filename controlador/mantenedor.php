<?php

class mantenedor {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';

    private function crearTablaResumen() {

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
            $drop = "drop table `resumen_total` where 1";
            //creando la tabla

            $tabla = "CREATE TABLE `resumen_total` (
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
            $dropp = mysqli_query($conexion, $drop);
            $crearTabla = mysqli_query($conexion, $tabla);


            if (!$crearTabla) { //if creacion tabla 
                echo '<p>Error al crear la tabla en la base de datos</p>';
            } else {
                echo '<p>La tabla se creo exitosamente.</p>';
            }
        }
    }

    public function concatLineas() {
        $patrones = array("/\t/");
        $auxiliar = array();
        $limpio = array();
        $limpiar = array("<br>", "\n", "\n<br>", "\n\r", "\v");
        error_reporting(0);

        $lineas = file('./recursos/registro.txt');

        $num_lineas = count($lineas);

        for ($i = 0; $i <= $num_lineas; $i++) {
            $cant_tab = count(explode("\t", $lineas[$i]));

            if ($cant_tab == 34 or $cant_tab == 35) {
                $auxiliar[] = $lineas[$i];
                $num_lineas = count($lineas);
            } else if ($cant_tab == 33) {
                $auxiliar[] = $lineas[$i];
                $num_lineas = count($lineas);
            } else if ($cant_tab < 33) {
                if (count(explode("\t", $lineas[$i - 1])) >= 33) {
                    $num_lineas++;
                } else {
                    $auxiliar[] = $lineas[$i - 1] . $lineas[$i];
                    unset($lineas[$i]);
                    $num_lineas = count($lineas);
                    $lineas = array_values($lineas);
                }
            } else if ($cant_tab > 35) {
                $auxiliar[] = $lineas[$i];
                $num_lineas = count($lineas);
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
            $limpio[$x] = $claves;

            // divide la frase mediante cualquier número de comas o caracteres de espacio,
            // lo que incluye " ", \r, \t, \n y \f
            $claves = explode("\t", $limpio[$x]);
            print_r($claves);
//          
        }
        return $limpio;
    }

    public function insertar_Archivo($limpio) {
        $this->crearTablaResumen();

        error_reporting(0);
        $errores = 0;
        $exitosos = 0;

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        //incrementa la memoria 
        ini_set('memory_limit', '2048M');
        //cambia el tiempo maximo de ejecucion de un script
        set_time_limit(300);

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
            if ($titulo_subject == "") {
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
            if ($comentario_close == "") {
                $comentario_close = "#Sin Comentarios";
            }
            $template = ltrim($datos[15]); // ok
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
                echo"<p> Datos ingresados Correctamente.</p>";
                $exitosos++;
            }
        }//termino del for
        echo "<h1>Registros Ingresados Exitosamente :$exitosos  </h1> ";
        echo "<p>Registros No Ingresados : $errores</p> ";
    }

    public function TablaGrupo() {

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table grupo as (select cliente,operador from resumen_total)";
        // agrego el campo id_grupo a la tabla
        $campo = "ALTER TABLE grupo ADD id_grupo int ;";
        // borro los registros de la tabla para poder agregar la llave primaria al campo id_grupo
        $borrar = "DELETE FROM `grupo` WHERE 1 ";
        //agrego la llave primaria
        $llave = "alter table grupo add primary key (id_grupo);";
        //modifico el campo id_grupo para que sea autoincrementable
        $index = "alter table grupo modify id_grupo int unsigned auto_increment;";
        //vuelvo a insertar los campos ..
        $insertar = "INSERT INTO grupo(cliente, operador)SELECT cliente, operador FROM resumen_total ";
        // ***
        // EJECUCION DE QUERYS
        $grupo1 = mysqli_query($conexion, $grupo);
        $campo1 = mysqli_query($conexion, $campo);
        $borrar1 = mysqli_query($conexion, $borrar);
        $llave1 = mysqli_query($conexion, $llave);
        $index1 = mysqli_query($conexion, $index);
        $insertar1 = mysqli_query($conexion, $insertar);
        //****
        if ($grupo1 || $campo1 || $borrar1 || $llave1 || $index1 || $insertar1) {
            echo"tabla creada con exito";
        } else {
            echo"Ocurrio un problema";
        }
    }

    public function tablaCliente() {

        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table clientes as (select cliente from resumen_total)";
        // agrego el campo id_grupo a la tabla
        $campo = "ALTER TABLE clientes ADD id_cliente int ;";
        // borro los registros de la tabla para poder agregar la llave primaria al campo id_grupo
        $borrar = "DELETE FROM `clientes` WHERE 1 ";
        //agrego la llave primaria
        $llave = "alter table clientes add primary key (id_cliente,cliente);";
        //modifico el campo id_grupo para que sea autoincrementable
        $index = "alter table clientes modify id_cliente int unsigned auto_increment;";
        //vuelvo a insertar los campos ..
        $insertar = "INSERT INTO clientes(cliente)SELECT cliente FROM resumen_total ";

        $llave = "alter table clientes drop primary key(id_cliente)";
        // ***
        // EJECUCION DE QUERYS
        $grupo1 = mysqli_query($conexion, $grupo);
        $campo1 = mysqli_query($conexion, $campo);
        $borrar1 = mysqli_query($conexion, $borrar);
        $llave1 = mysqli_query($conexion, $llave);
        $index1 = mysqli_query($conexion, $index);
        $insertar1 = mysqli_query($conexion, $insertar);
        //****
        if ($grupo1 || $campo1 || $borrar1 || $llave1 || $index1 || $insertar1) {
            echo"tabla creada con exito";
        } else {
            echo"Ocurrio un problema";
        }
    }

    public function tablaTicket() {
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table ticket as (select rt.nro_ticket,cli.cliente from resumen_total as rt,clientes cli)";

        $forania = "alter table ticket  add FOREIGN KEY (cliente) REFERENCES clientes (cliente) ";
        //modifico el campo id_grupo para que sea autoincrementable
        $llave = "alter table ticket add primary key (cliente, nro_ticket)";
        //vuelvo a insertar los campos ..
        $insertar = "INSERT INTO ticket(nro_ticket,cliente)SELECT rt.nro_ticket,cli.cliente  FROM  resumen_total as rt,clientes cli ";
        // ***
        // EJECUCION DE QUERYS
        $grupo1 = mysqli_query($conexion, $grupo);



        $forania1 = mysqli_query($conexion, $forania);


        $insertar1 = mysqli_query($conexion, $insertar);

        //****
        if ($grupo1 || $insertar1) {
            echo"<p>tabla ticket creada con exito</p>";
        } else {
            echo"Ocurrio un problema con el ticket";
        }
    }

    public function tablaNodo() {
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);
        mysqli_select_db($conexion, 'taller_titulacion');
        //Creo la tabla grupo e inserto los registros, con los campos de resumen_total
        $grupo = "create table grupo as (select cliente,operador from resumen_total)";
        // agrego el campo id_grupo a la tabla
        $campo = "ALTER TABLE grupo ADD id_grupo int ;";
        // borro los registros de la tabla para poder agregar la llave primaria al campo id_grupo
        $borrar = "DELETE FROM `grupo` WHERE 1 ";
        //agrego la llave primaria
        $llave = "alter table grupo add primary key (id_grupo);";
        //modifico el campo id_grupo para que sea autoincrementable
        $index = "alter table grupo modify id_grupo int unsigned auto_increment;";
        //vuelvo a insertar los campos ..
        $insertar = "INSERT INTO grupo(cliente, operador)SELECT cliente, operador FROM resumen_total ";
        // ***
        // EJECUCION DE QUERYS
        $grupo1 = mysqli_query($conexion, $grupo);
        $campo1 = mysqli_query($conexion, $campo);
        $borrar1 = mysqli_query($conexion, $borrar);
        $llave1 = mysqli_query($conexion, $llave);
        $index1 = mysqli_query($conexion, $index);
        $insertar1 = mysqli_query($conexion, $insertar);
        //****
        if ($grupo1 || $campo1 || $borrar1 || $llave1 || $index1 || $insertar1) {
            echo"tabla creada con exito";
        } else {
            echo"Ocurrio un problema";
        }
    }

    public function insertaArchivo2() {
        // ESTE NO SE USA !
        $this->crearTabla();
        $archivo = fopen("./recursos/registro.txt", "rb");
        $conexion = mysqli_connect($this->host, $this->user, $this->pass);

        while (feof($archivo) == false) {
            $datos = fgetcsv($archivo, 500, "\n");

            echo $nro_ticket = $datos[0]; // ok
            echo $nro_ticket = str_replace("<br>", "", $nro_ticket);

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
        fclose($archivo);
    }

}
