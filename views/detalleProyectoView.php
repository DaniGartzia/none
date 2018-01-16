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
        <div class="container">
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
                        </tr>                    
                        <?php
                        }
                        ?>                        
                    </tbody>
                </table>
            </div>
            <aside class="col-lg-3">
                <h4><strong>Datos del proyecto:</strong></h4>
                Nombre: 
                <br>
                <input type="text" name="nombreProyecto" class="form-control" value="<?php echo $data['proyecto']->nombre ?>" disabled />
                <br><br>
                Descripción:
                <br>
                <input type="text" name="descripcionProyecto" class="form-control" value="<?php echo $data['proyecto']->descripcion ?>" disabled />
                <br>
                <a href="" class="btn btn-warning">Modificar Datos</a>
                <br>
                <hr style="border:1px solid black"/>
                <h4><strong>Otras Acciones:</strong></h4>
                <a href="" class="btn btn-info">Ver Participantes</a>
                <br><br>
                <a href="" class="btn btn-info">Ver Archivos</a>
                <br><br>
                <a href="" class="btn btn-info">Ver Comentarios</a>
                <br><br>
                <a href="" class="btn btn-danger">Borrar Proyecto</a>
            </aside>
        </div>		
        <?php include_once "footer.php"?>       
    </body>
</html>
