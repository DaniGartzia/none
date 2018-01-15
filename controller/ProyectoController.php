<?php

class ProyectoController extends BaseController {
    public function __construct() {
        require_once __DIR__. "/../model/Proyecto.php";
    }
    
    /*-------------------------------------------------------------------
    Función que, según la acción pasada en la url, manda a cada función correspondiente*/
    public function run($accion){
        switch($accion) { 
            case "index" :
                $this->index();
                break;
            case "aniadirProyecto" :
                $this->view('aniadirProyecto', "");
                break;
            case "nuevoProyecto" :
                $this->guardarProyecto();
                break;
            case "verDetalle" :
                $this->mostrarDatosProyecto();
                break;
            case "eliminar" :
                $this->borrarProyecto();
                break;
            case "modificarProyecto" :
                $this->modificarDatosProyecto();
                break;
            default:
                $this->index();
                break;
        }
    }
    
    /*-------------------------------------------------------------------
    Función que carga la lista de proyectos conseguida del modelo (Proyecto)*/
    public function index() {
        //Creamos el objeto 'Proyecto'
        $proyecto = new Proyecto($this->conexion);
        
        //Conseguimos todas los proyectos (lista de los proyectos en BD)
        $listaProyectos = $proyecto->getAll();
        
        //Cargamos la vista proyectosView.php con la función 'view()' y le pasamos valores (usaremos 'proyectos')
        $this->view('proyectos', array(
            'proyectos' => $listaProyectos,
            'titulo' => 'PROYECTOS'
        ));
    }
    
    /*--------------------------------------------------------------
    Función para crear el nuevo proyecto (objeto 'Proyecto') y mandarlo a su clase ('Proyecto.php')*/
    public function guardarProyecto() {
        if(isset($_POST['guardar'])) {
            //Construimos un nuevo objeto 'proyecto' completo para mandar a BD            
            $proyecto = new Proyecto($this->conexion);           
            $proyecto->setNombre($_POST['nombre']);
            $proyecto->setDescripcion($_POST['descripcion']);
            $proyecto->setFechaInicioProyecto($_POST['fechaInicioProyecto']);
            $proyecto->setResponsable($_POST['responsable']);
            $insercion = $proyecto->save();
        }
        //Mandamos a la vista principal
        header('Location: index.php');
    }
    
    /*--------------------------------------------------------------
    Función manda al modelo para buscar los datos del proyecto seleccionado en el boton 'Ver Proyecto' */
    public function mostrarDatosProyecto() {
        //Creamos el objeto solo con el Id y con esto sacaremos todos sus datos de BD
        $proyectoDetalle = new Proyecto($this->conexion);
        $proyectoDetalle ->setIdProyecto($_GET['idProyecto']);
        $profile = $proyectoDetalle->getProfile();
        
        //Mandamos a la función view() para crear la vista 'detalleComentarioView'
        $this->view('detalleProyecto',array(
            "proyecto"=>$profile,
            "titulo" => "DETALLE PROYECTO"
        ));
    }
    
    /*-------------------------------------------------------------------
    Función que manda a borrar el proyecto seleccionado*/
    public function borrarProyecto() {
        //Creamos el objeto solo con el Id y lo mandamos al modelo para borrar
        $proyectoBorrar = new Proyecto($this->conexion);
        $proyectoBorrar ->setIdProyecto($_GET['idProyecto']);
        $delete = $proyectoBorrar->delete();
        
        //Volvemos a cargar index.php
        header('Location: index.php');
    }
    
    /*-------------------------------------------------------------------
    Función que manda a modificar los datos del proyecto seleccionado*/
    public function modificarDatosProyecto() {
        //Seleccionamos el id del proyecto y se manda para modificarlo a su modelo ('Proyecto.php')
        $idProyecto = $_POST['idProyecto'];
        $nombre = $_POST['nuevoNombre'];
        $descripcion = $_POST['nuevoDescripcion'];
        $fechaInicioProyecto = $_POST['nuevoFechaInicioProyecto'];
        $responsable = $_POST['nuevoResponsable'];
        
        //Creamos el objeto completo y lo mandamos a actualizar al modelo
        $proyectoModificar = new Proyecto($this->conexion);
        $proyectoModificar->setIdProyecto($idProyecto);
        $proyectoModificar->setNombre($nombre);
        $proyectoModificar->setDescripcion($Descripcion);
        $proyectoModificar->setFechaInicioProyecto($fechaInicioProyecto);
        $proyectoModificar->setResponsable($responsable);
        $update = $proyectoModificar->updateData();
        
        //Volvemos a cargar index.php pasándole los datos del 'controller', 'action' y el id del proyecto para cargar de nuevo 'detalleProyectoView.php' 
        header('Location: index.php?controller=proyectos&action=verDetalle&idProyecto='. $proyectoModificar->getIdProyecto());
    }
}
