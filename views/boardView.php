<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>PROYECTOS EN DESARROLLO</title>
        <link href="/../reto3/css/main.css" rel="stylesheet" type="text/css" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
            section a{
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <?php include_once "head.php"?>
        <div class="container">
            <?php include_once "header.php"?>
            <div class="col-lg-9">
                <h3>Proyectos</h3>
                <hr/>
            </div>
            <section class="col-lg-9 usuario" style="height:400px;overflow-y:scroll;">
                <?php foreach($data["proyectos"] as $proyecto) {?>            
                    <?php echo $proyecto["idProyecto"]; ?> -
                    <?php echo $proyecto["nombre"]; ?> -
                    <?php echo $proyecto["fechaInicioProyecto"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;         

                    <!-- Enlace para el boton verDetalle para mostrar los datos del proyecto -->
                    <a href="index.php?controller=proyectos&action=verDetalle&proyecto=<?php echo $proyecto['idProyecto'] ?>" style="text-decoration: none">
                        <button type="button" class="btn btn-info btn-xs">Ver Detalle</button>
                    </a>

                    <!-- Enlace para el boton borrar para eliminar el proyecto -->
                    <a href="index.php?controller=proyectos&action=eliminar&idProyecto=<?php echo $proyecto['idProyecto'] ?>" style="text-decoration: none">   
                        <button type="button" class="btn btn-danger btn-xs">Borrar</button>
                    </a>             

                    <hr/>
                <?php } ?>
            </section>
            <aside class="col-lg-3">
                hola
            </aside>
        </div>		
        <?php include_once "footer.php"?>
    </body>
</html>
