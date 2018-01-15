<?php

class ComentarioController extends BaseController {
    public function __construct() {
        require_once __DIR__. "/../model/Comentario.php";
    }
    
    /*-------------------------------------------------------------------
    Función que, según la acción pasada en la url, manda a cada función correspondiente*/
    public function run($accion){
        switch($accion) { 
            case "index" :
                $this->index();
                break;
            case "aniadirComentario" :
                $this->view('aniadirComentario', "");
                break;
            case "nuevoComentario" :
                $this->guardarComentario();
                break;
            case "verDetalle" :
                $this->mostrarDatosComentario();
                break;
            case "eliminar" :
                $this->borrarComentario();
                break;
            case "modificarComentario" :
                $this->modificarDatosComentario();
                break;
            default:
                $this->index();
                break;
        }
    }
    
    /*-------------------------------------------------------------------
    Función que carga la lista de archivos conseguida del modelo (Archivo)*/
    public function index() {
        //Creamos el objeto 'Comentario'
        $comentario = new Comentario($this->conexion);
        
        //Conseguimos todas los comentarios (lista de los comentarios en BD)
        $listaComentarios = $comentario->getAll();
        
        //Cargamos la vista comentariosView.php con la función 'view()' y le pasamos valores (usaremos 'comentarios')
        $this->view('comentarios', array(
            'comentarios' => $listaComentarios,
            'titulo' => 'COMENTARIOS'
        ));
    }
    
    /*--------------------------------------------------------------
    Función para crear el nuevo comentario (objeto 'Comentario') y mandarlo a su clase ('Comentario.php')*/
    public function guardarComentario() {
        if(isset($_POST['guardar'])) {
            //Construimos un nuevo objeto 'comentario' completo para mandar a BD            
            $comentario = new Comentario($this->conexion);           
            $comentario->setContenido($_POST['contenido']);
            $comentario->setFecha($_POST['fecha']);
            $comentario->setEditado($_POST['editado']);
            $comentario->setParticipante($_POST['participante']);
            $comentario->setProyecto($_POST['proyecto']);

            $insercion = $comentario->save();
        }
        //Mandamos a la vista principal
        header('Location: index.php');
    }
    
    /*--------------------------------------------------------------
    Función manda al modelo para buscar los datos del comentario seleccionado en el boton 'Ver Comentario' */
    public function mostrarDatosComentario() {
        //Creamos el objeto solo con el Id y con esto sacaremos todos sus datos de BD
        $comentarioDetalle = new Comentario($this->conexion);
        $comentarioDetalle ->setIdComentario($_GET['idComentario']);
        $profile = $comentarioDetalle->getProfile();
        
        //Mandamos a la función view() para crear la vista 'detalleComentarioView'
        $this->view('detalleComentario',array(
            "comentario"=>$profile,
            "titulo" => "DETALLE COMENTARIO"
        ));
    }
    
    /*-------------------------------------------------------------------
    Función que manda a borrar el comentario seleccionado*/
    public function borrarComentario() {
        //Creamos el objeto solo con el Id y lo mandamos al modelo para borrar
        $comentarioBorrar = new Comentario($this->conexion);
        $comentarioBorrar ->setIdComentario($_GET['idComentario']);
        $delete = $comentarioBorrar->delete();
        
        //Volvemos a cargar index.php
        header('Location: index.php');
    }
    
    /*-------------------------------------------------------------------
    Función que manda a modificar los datos del comentario seleccionado*/
    public function modificarDatosComentario() {
        //Seleccionamos el id del comentario y se manda para modificarlo a su modelo ('Comentario.php')
        $idComentario = $_POST['idComentario'];
        $contenido = $_POST['nuevoContenido'];
        $fecha = $_POST['nuevoFecha'];
        $editado = $_POST['nuevoEditado'];
        $participante = $_POST['nuevoParticipante'];
        $proyecto = $_POST['nuevoProyecto'];
        
        //Creamos el objeto completo y lo mandamos a actualizar al modelo
        $comentarioModificar = new Comentario($this->conexion);
        $comentarioModificar->setIdComentario($idComentario);
        $comentarioModificar->setContenido($contenido);
        $comentarioModificar->setFecha($fecha);
        $comentarioModificar->setEditado($editado);
        $comentarioModificar->setParticipante($participante);
        $comentarioModificar->setProyecto($proyecto);
        $update = $comentarioModificar->updateData();
        
        //Volvemos a cargar index.php pasándole los datos del 'controller', 'action' y el id del comentario para cargar de nuevo 'detalleComentarioView.php' 
        header('Location: index.php?controller=comentarios&action=verDetalle&idComentario='. $comentarioModificar->getIdComentario());
    }
}
