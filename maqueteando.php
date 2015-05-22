<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Taller de Titulacion</title>
        <link rel="stylesheet" href="vista/css/bootstrap.css"/>
        <link rel="stylesheet" href="vista/css/navbar.css"/>
        <script language="JavaScript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('button').click(function() {
                    $('iframe').height(600);
                });
            });
        </script>
    </head>
    <body id="body">

        <!-- Static navbar -->
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
                        <li ><a href="index.php">Cargar Datos.</a></li>
                        <li class="active"><a href="maqueteando.php">Ver Tablas</a></li>
                    </ul>

                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>

        <div class="container tablas">

            <form class="form-inline" role="form" method="post" target="mi-iframe" action="modelo/consulta.php">
                <div class="row">

                    <div class="col-md-2" id="mover">
                        <h4>Tickets</h4>

                        <div class="form-group">
                            <div class="input-group">
                                <table class="table  table-bordered">
                                    <tr>
                                        <td ><input type="checkbox" name="campos[]" value="tk.nro_ticket as nro_ticket"></td>
                                        <td>Nro_Ticket</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.fecha_creacion as fecha_creacion"></td>
                                        <td>Fecha_Creacion</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.operador as operador"></td>
                                        <td>Operador</td>
                                    </tr>											
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.nombre_operador as nombre_operador"></td>
                                        <td>Nombre_Operador</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.from_mail_operador as from_mail_operador"></td>
                                        <td>From_Mail_Operador</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.mail_destino as mail_destino"></td>
                                        <td>Mail_Destino</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.tipo_notificacion as tipo_notificacion"></td>
                                        <td>Tipo_Notificacion</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.titulo_subject as titulo_subject"></td>
                                        <td>Titulo_Subject</td>
                                    </tr>

                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.server_alert as server_alert"></td>
                                        <td>Server_Alert</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.fecha_close as fecha_close"></td>
                                        <td>Fecha_Close</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.operador_close as operador_close"></td>
                                        <td>Operador_Close</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.comentario_close as comentario_close"></td>
                                        <td>Comentario_Close</td>
                                    </tr>
                                    <tr>
                                        <td><input  type="checkbox" name="campos[]" value="tk.template as template"></td>
                                        <td>Template</td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-2">
                        <h4>Detalle Tickets</h4>

                        <div class="form-group">
                            <div class="input-group">
                                <table class="table  table-bordered">
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.llave_event as llave_event"></td>
                                        <td>LLave_Event</td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.maquina as maquina"></td>
                                        <td>Maquina</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.fecha_desde_evento as fecha_desde_evento"></td>
                                        <td>Fecha_Desde_Evento</td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.desc_alerta as desc_alerta"></td>
                                        <td>Desc_Alert</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.fecha_ultima_actualizacion as fecha_ultima_actualizacion"></td>
                                        <td>Fch_ult_Actualizacion</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.valor_alerta as valor_alerta" ></td>
                                        <td>Valor_Alerta</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.tipo_alerta as tipo_alerta"></td>
                                        <td>Tipo_Alerta</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.num_escalamiento as num_escalamiento"></td>
                                        <td>Num_Escalamiento</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.estado_gestion as estado_gestion"></td>
                                        <td>Estado_Gestion</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.estado_precheck as estado_precheck"></td>
                                        <td>Estado_precheck</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.estado_alert as estado_alert"></td>
                                        <td>estado_alert</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.server as server"></td>
                                        <td>Server_maquina</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.fecha_asociar_ticket as fecha_asociar_ticket"></td>
                                        <td>Fecha_Asociar_Ticket</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="tkd.marca_origen_event as marca_origen_event"></td>
                                        <td>Marca_Origen_Event</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h4>Grupos</h4>

                        <div class="form-group">
                            <div class="input-group">
                                <table class="table  table-bordered">
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="gr.llave_grupo_nodo as llave_grupo_nodo"></td>
                                        <td >Llave_cliente_grupo</td>
                                    </tr>
                                    
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="gr.grupo_nodo as grupo_nodo"></td>
                                        <td>Grupo_Nodo</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 ">
                        <h4>Clientes</h4>

                        <div class="form-group">
                            <div class="input-group">
                                <table class="table  table-bordered">
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="cl.cliente as cliente"></td>
                                        <td >Cliente</td>
                                    </tr>																								
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-2">
                        <h4>Nodo</h4>

                        <div class="form-group">
                            <div class="input-group">
                                <table class="table  table-bordered">
                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="nod.nodo as nodo"></td>
                                        <td >Nodo</td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="nod.devicetype as devicetype"></td>
                                        <td>DeviceType</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h4>Host</h4>

                        <div class="form-group">
                            <div class="input-group">
                                <table class="table  table-bordered">

                                    <tr>
                                        <td><input type="checkbox" name="campos[]" value="h.ip_nodo as ip_nodo" ></td>
                                        <td >Ip_Nodo </td>
                                    </tr>
                                    


                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-offset-10 ">
                        <button id="boton" class="btn btn-lg btn-primary">Consultar</button>


                    </div>
                    <hr>
                    <div id="iframe"  class="col-md-12">
                        <iframe name="mi-iframe"   src="modelo/consulta.php" width="100%" height="0" frameborder="0"></iframe> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-4">
                        <p>@ Proyecto Desarrollado por Christian Santa Maria Braniff. 2015</p>
                    </div>
                </div>


            </form>	

        </div>

 
        <script src="js/bootstrap.min.js"></script>
       

    </body>
</html>