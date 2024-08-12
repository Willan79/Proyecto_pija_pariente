<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    
<?php
require_once 'config/Database.php';
require_once 'models/Usuario.php';
require_once 'models/Platos.php';

class Administrador extends Usuario{

    public function __construct($nombre, $apellido, $email, $telefono, $contrasena) {
       // parent::__construct($nombre, $apellido, $email, $telefono, $contrasena);// Heredados
        
    }

    public function crearPlato(){
      //  parent::crearPlato();
    }

    public function mostrarPlatos(){
        $this->getConexion();
       // parent::mostrarPlatos();
    }
    
    public function actualizarPlato($plato_id){
      //  parent::actualizarPlato($plato_id);
    }
        
    public function eliminarPlato($plato_id){
      //  parent::eliminarPlato($plato_id);
    }
    
    public function mostrarCliente() { 
        //$this->getConexion();
        mostrarCliente(); 
    }
    
}

?>

</body>
</html>