<?php

class ParticipanteController extends BaseController {
    public function __construct() {
        require_once __DIR__. "/../model/Participante.php";
    }
    
    /*-------------------------------------------------------------------
    Función que, según la acción pasada en la url, manda a cada función correspondiente*/
    public function run($accion){
        switch($accion) { 
            case "index" :
                $this->index();
                break;
            case "aniadirParticipante" :
                $this->view('aniadirParticipante', "");
                break;
            case "nuevoParticipante" :
                $this->guardarParticipante();
                break;
            case "verDetalle" :
                $this->mostrarDatosParticipante();
                break;
            case "eliminar" :
                $this->borrarParticipante();
                break;
            case "modificarParticipante" :
                $this->modificarDatosParticipante();
                break;
            default:
                $this->index();
                break;
        }
    }
    
    /*-------------------------------------------------------------------
    Función que carga la lista de participantes conseguida del modelo (Participante)*/
    public function index() {
        //Creamos el objeto 'Participante'
        $participante = new Participante($this->conexion);
        
        //Conseguimos todas los participantes (lista de los participantes en BD)
        $listaParticipantes = $participante->getAll();
        
        //Cargamos la vista participantesView.php con la función 'view()' y le pasamos valores (usaremos 'participantes')
        $this->view('participantes', array(
            'participantes' => $listaParticipantes,
            'titulo' => 'PARTICIPANTES'
        ));
    }
    
    /*--------------------------------------------------------------
    Función para crear el nuevo participante (objeto 'Participante') y mandarlo a su clase ('Participante.php')*/
    public function guardarParticipante() {
        if(isset($_POST['guardar'])) {
            //Construimos un nuevo objeto 'participante' completo para mandar a BD            
            $participante = new Participante($this->conexion);            
            $participante->setUsuario($_POST['usuario']);
            $participante->setProyecto($_POST['proyecto']);
            $insercion = $participante->save();
        }
        //Mandamos a la vista principal
        header('Location: index.php');
    }
    
    /*--------------------------------------------------------------
    Función manda al modelo para buscar los datos del participante seleccionado en el boton 'Ver Participante' */
    public function mostrarDatosParticipante() {
        //Creamos el objeto solo con el Id y con esto sacaremos todos sus datos de BD
        $participanteDetalle = new Participante($this->conexion);
        $participanteDetalle ->setIdParticipante($_GET['idParticipante']);
        $profile = $participanteDetalle->getProfile();
        
        //Mandamos a la función view() para crear la vista 'detalleParticipanteView'
        $this->view('detalleParticipante',array(
            "participante"=>$profile,
            "titulo" => "DETALLE PARTICIPANTE"
        ));
    }
    
    /*-------------------------------------------------------------------
    Función que manda a borrar el participante seleccionado*/
    public function borrarParticipante() {
        //Creamos el objeto solo con el Id y lo mandamos al modelo para borrar
        $participanteBorrar = new Participante($this->conexion);
        $participanteBorrar ->setIdParticipante($_GET['idParticipante']);
        $delete = $participanteBorrar->delete();
        
        //Volvemos a cargar index.php
        header('Location: index.php');
    }
    
    /*-------------------------------------------------------------------
    Función que manda a modificar los datos del participante seleccionado*/
    public function modificarDatosParticipante() {
        //Seleccionamos el id del participante y se manda para modificarlo a su modelo ('Participante.php')
        $idParticipante = $_POST['idParticipante'];
        $usuario = $_POST['nuevoUsuario'];
        $proyecto = $_POST['nuevoProyecto'];
        
        //Creamos el objeto completo y lo mandamos a actualizar al modelo
        $participanteModificar = new Participante($this->conexion);
        $participanteModificar->setIdParticipante($idParticipante);
        $participanteModificar->setUsuario($usuario);
        $participanteModificar->setProyecto($proyecto);        
        $update = $participanteModificar->updateData();
        
        //Volvemos a cargar index.php pasándole los datos del 'controller', 'action' y el id del participante para cargar de nuevo 'detalleParticipanteView.php' 
        header('Location: index.php?controller=participantes&action=verDetalle&idParticipante='. $participanteModificar->getIdParticipante());
    }
}
