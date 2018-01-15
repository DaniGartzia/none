<?php

class UsuarioController extends BaseController {
    /*private $conectar;
    private $conexion;*/
    
    public function __construct() {
        require_once __DIR__. "/../model/Usuario.php";

    }
    
    /*-------------------------------------------------------------------
    Función que, según la acción pasada en la url, manda a cada función correspondiente*/
    public function run($accion){
        switch($accion) { 
            case "index" :
                $this->index();
                break;
            case "aniadirUsuario" :
                $this->view('aniadirUsuario', "");
                break;
            case "nuevoUsuario" :
                $this->guardarUsuario();
                break;
            case "verDetalle" :
                $this->mostrarDatosUsuario();
                break;
            case "eliminar" :
                $this->borrarUsuario();
                break;
            case "modificarUsuario" :
                $this->modificarDatosUser();
                break;
            default:
                $this->index();
                break;
        }
    }
    
    /*------------------------------------------------------------------
    Función para crear la vista con el nombre que le pasemos y con los datos que le indiquemos*/
    public function view($vista, $datos) {
        $data = $datos;
        
        require_once __DIR__. '/../view/'. $vista. 'View.php';        
    }
    
    /*-------------------------------------------------------------------
    Función que carga la lista de usuarios conseguida del modelo (Usuario)*/
    public function index() {
        //Creamos el objeto 'Usuario'
        $usuario = new Usuario($this->conexion);
        
        //Conseguimos todas los usuarios (lista de los usuarios en BD)
        $listaUsuarios = $usuario->getAll();
        
        //Cargamos la vista usuariosView.php con la función 'view()' y le pasamos valores (usaremos 'usuarios')
        $this->view('usuarios', array(
            'usuarios' => $listaUsuarios,
            'titulo' => 'USUARIOS'
        ));
    }
    
    /*--------------------------------------------------------------
    Función para crear el nuevo usuario (objeto 'Usuario') y mandarlo a su clase (Usuario)*/
    public function guardarUsuario() {
        if(isset($_POST['guardar'])) {
            //Construimos un nuevo objeto 'bodega' completo para mandar a BD
            
            $usuario = new Usuario($this->conexion);
            
            
            $usuario->setUsername($_POST['username']);
            $usuario->setPassword($_POST['password']);
            $usuario->setEmail($_POST['email']);

            $insercion = $usuario->save();
        }
        //Mandamos a la vista principal
        header('Location: index.php');
    }
}
