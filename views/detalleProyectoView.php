<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>DETALLE PROYECTO</title>
        <link href="/../reto3/css/main.css" rel="stylesheet" type="text/css" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <?php include_once "head.php";?>
        <div class="container" display="flex">
            <?php include_once "header.php"; ?>
            <div class="col-lg-9">
                <h3>Tareas del Proyecto</h3>                
            </div>
            <div class="col-lg-9">
                <table class="table col-lg-12">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha de inicio</th>
                            <th scope="col">Fecha finalización</th>
                            <th scope="col">Urgente</th>
                            <th scope="col">Finalizada</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <?php 
                        foreach($data['tareas'] as $tarea) {
                        ?>
                        <tr>
                            <td><?php echo $tarea['nombreTarea']; ?></td>
                            <td><?php echo $tarea['fechaInicioTarea']; ?></td>
                            <td><?php echo $tarea['fechaFinTarea']; ?></td>
                            <td><?php echo $tarea['urgente']; ?></td>
                            <td>
                                
                                <input type="checkbox" name="finalizada" value="si" style="transform: scale(2)">
                                
                            </td>
                        </tr>                    
                        <?php
                        }
                        ?>                        
                    </tbody>
                </table>
            </div>
            <aside class="col-lg-3" style="border: 1px solid black !important">
                <h4><strong>Proyecto:</strong></h4>
                Nombre: 
                <br>
                <input type="text" name="nombreProyecto" class="form-control" value="<?php echo $data['proyecto']->nombre ?>" disabled />
                <br>
                Descripción:
                <br>
                <input type="text" name="descripcionProyecto" class="form-control" value="<?php echo $data['proyecto']->descripcion ?>" disabled />
                <br>
                <a href="" class="btn btn-warning btn-sm" title="Modificar Datos" style="width: 176px !important">Modificar Datos</a>
                <br>
                <hr style="border:1px solid black"/>
                <h4><strong>Acciones:</strong></h4>
                <a href="" class="btn btn-success btn-sm" title="Nueva Tarea" style="width: 176px !important">Nueva Tarea</a>
                <br><br>
                <a href="" class="btn btn-info btn-sm" title="Ver Participantes" style="width: 176px !important">Ver Participantes</a>
                <br><br>
                <a href="" class="btn btn-info btn-sm" title="Ver Archivos" style="width: 176px !important">Ver Archivos</a>
                <br><br>
                <a href="" class="btn btn-info btn-sm" title="Ver Comentarios" style="width: 176px !important">Ver Comentarios</a>
                <br><br>
                <a href="" class="btn btn-danger btn-sm" title="Borrar Proyecto" style="width: 176px !important">Borrar Proyecto</a>
                <br><br>
            </aside>
        </div>		
        <?php include_once "footer.php"?>       
    </body>
</html>
