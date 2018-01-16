<?php
require_once __DIR__ . "/BaseController.php";

class ProyectoController extends BaseController {
    
    public function __construct() {        
        parent::__construct();        
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
    Función que carga la lista de proyectos del usuario indicado en 'responsable', conseguida del modelo (Proyecto)*/
    public function index() {
        //Creamos el objeto 'Proyecto'
        $proyecto = new Proyecto($this->conexion);
        
        //HE COMENTADO LO SIGUIENTE (HARÁ FALTA LUEGO)
        //$proyecto->setResponsable($_GET['responsable']);
        
        //HE PUESTO LO SIGUIENTE PARA COMPROBACION
        $proyecto->setResponsable(1);
        
        //Conseguimos todas los proyectos (lista de los proyectos en BD)
        $listaProyectos = $proyecto->getAll();
        
        //Cargamos la vista proyectosView.php con la función 'view()' y le pasamos valores (usaremos 'proyectos')
        $this->view('board', array(
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
        
        //AQUÍ HABRÁ QUE CARGAR OTRA VISTA, NO LA INDICADA 'index.php' (ARREGLARLO)
        //Mandamos a la vista principal
        header('Location: index.php');
    }
    
    /*--------------------------------------------------------------
    Función manda al modelo para buscar los datos del proyecto seleccionado en el boton 'Ver Proyecto' */
    public function mostrarDatosProyecto() {
        //Creamos el objeto solo con el Id y con esto sacaremos todos sus datos de BD
        $proyectoDetalle = new Proyecto($this->conexion);
        $proyectoDetalle ->setIdProyecto($_GET['proyecto']);
        $profile = $proyectoDetalle->getProyectoById();
        
        include_once  __DIR__. "/../model/Tarea.php";
        //$idProyecto = $proyectoDetalle->getIdProyecto();
        $tareaProyecto = new Tarea($this->conexion);
        $tareaProyecto->setProyecto($proyectoDetalle->getIdProyecto());
        $listadoTareasProyecto = $tareaProyecto->getAll();
        
        //Mandamos a la función view() para crear la vista 'detalleComentarioView'
        $this->view('detalleProyecto',array(
            "proyecto"=>$profile,
            "tareas" => $listadoTareasProyecto,
            "titulo" => "DETALLE PROYECTO"
        ));
    }    
    
    /*-------------------------------------------------------------------
    Función que manda a modificar los datos del proyecto seleccionado*/
    public function modificarDatosProyecto() {        
        //Creamos el objeto completo y lo mandamos a actualizar al modelo
        $proyectoModificar = new Proyecto($this->conexion);
        $proyectoModificar->setIdProyecto($_POST['idProyecto']);
        $proyectoModificar->setNombre($_POST['nuevoNombre']);
        $proyectoModificar->setDescripcion($_POST['nuevoDescripcion']);
        $proyectoModificar->setFechaInicioProyecto($_POST['nuevoFechaInicioProyecto']);
        $proyectoModificar->setResponsable($_POST['nuevoResponsable']);
        $update = $proyectoModificar->update();
        
        //Volvemos a cargar index.php pasándole los datos del 'controller', 'action' y el id del proyecto para cargar de nuevo 'detalleProyectoView.php' 
        header('Location: index.php?controller=proyectos&action=verDetalle&idProyecto='. $proyectoModificar->getIdProyecto());
    }
    
    /*-------------------------------------------------------------------
    Función que manda a borrar el proyecto seleccionado*/
    public function borrarProyecto() {
        //Creamos el objeto solo con el Id y lo mandamos al modelo para borrar
        $proyectoBorrar = new Proyecto($this->conexion);
        $proyectoBorrar ->setIdProyecto($_GET['idProyecto']);
        $delete = $proyectoBorrar->remove();
        
        //AQUÍ HABRÁ QUE CARGAR OTRA VISTA, NO LA INDICADA 'index.php' (ARREGLARLO)
        //Volvemos a cargar index.php
        header('Location: index.php');
    }
    
    /*------------------------------------------------------------------
    Función para crear la vista con el nombre que le pasemos y con los datos que le indiquemos*/
    public function view($vista, $datos) {
        $data = $datos;
        
        require_once __DIR__. '/../views/'. $vista. 'View.php';        
    }
}
