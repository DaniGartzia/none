<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>PROYECTOS EN DESARROLLO</title>
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
        <form action="index.php?controller=empleados&action=alta" method="post" class="col-lg-5">
            <h3>Comenzar un nuevo proyecto</h3>
            <hr/>
            Nombre Proyecto: <input type="text" name="nombre" class="form-control" required/>
            Descripción del Proyecto: <input type="text" name="descripcion" class="form-control" required/>
            Fecha Inicial del Proyecto: <input type="date" name="fechaInicioProyecto" class="form-control" required/>
            Responsable: <input type="text" name="responsable" class="form-control" required/>
            <input type="submit" value="enviar" class="btn btn-success"/>
        </form>
        
        <div class="col-lg-7">
            <h3>Proyectos</h3>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
            <?php foreach($data["proyectos"] as $proyecto) {?>            
                <?php echo $proyecto["idProyecto"]; ?> -
                <?php echo $proyecto["nombre"]; ?> -
                <?php echo $proyecto["fechaInicioProyecto"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;         
                
                <!-- Enlace para el boton verDetalle para mostrar los datos del proyecto -->
                <a href="index.php?controller=proyectos&action=verDetalle&responsable=<?php echo $proyecto['idProyecto'] ?>" style="text-decoration: none">
                    <button type="button" class="btn btn-info btn-xs">Ver Detalle</button>
                </a>
                
                <!-- Enlace para el boton borrar para eliminar el proyecto -->
                <a href="index.php?controller=proyectos&action=eliminar&idProyecto=<?php echo $proyecto['idProyecto'] ?>" style="text-decoration: none">   
                    <button type="button" class="btn btn-danger btn-xs">Borrar</button>
                </a>             
                
                <hr/>
            <?php } ?>
        </section>
		
        <footer class="col-lg-12">
            <hr/>
           Ejemplo PHP + PDO + POO + MVC - Jon Vadillo - <a href="http://jonvadillo.es">jonvadillo.es</a> - Copyright &copy; <?php echo  date("Y"); ?>
        </footer>
    </body>
</html>
