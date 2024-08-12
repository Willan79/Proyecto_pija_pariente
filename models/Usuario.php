<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>
<body>
    
<?php

require_once './config/Database.php';

class Usuario extends Database{
    
    public $cliente_id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $direccion;
    public $contrasena;
    public $conex;
    
    public function __construct($cliente_id, $nombre, $apellido, $email, $telefono, $direccion, $contrasena) {
        $this->cliente_id = $cliente_id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->contrasena = $contrasena;
    }

    //====================================================================================

    //! registrarCliente
    public function registrarCliente() {    
        $this->getConexion();
        
        // (mysqli_prepare) preparación de la consulta a basede datos.
        $prep = mysqli_prepare($this->conex,"INSERT INTO clientes(cliente_id, nombre, apellido, email, telefono, direccion, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?)" );
        
        //(blind_param) Llenar los espacios que se dejaron (?, ?, ?, ?, ?, ?, ?)
        $prep->bind_param("issssss",$this->cliente_id, $this->nombre ,$this->apellido ,$this->email ,$this->telefono ,$this->direccion ,$this->contrasena);
        
        //(execute) Ejecuta el código 
        $prep->execute();
        
        // (get_result) Devuelve un booleano para saber si se hizo la consulta o no.
        $ress = $prep->get_result();
        
        if($this->conex->error){
            echo "   ..Error en la consulta sql: " . $this->conex->error;  
        }else{
            echo "   ..Registro de usuario exitoso";
        }
    }
    //===============================================================================

    //! eliminarCliente
    public function eliminarCliente($cliente_id) {
        $this->getConexion();
        
        $sql = "DELETE FROM clientes WHERE cliente_id = ?";
        $stmt = $this->conex->prepare($sql);
        $stmt->bind_param("i", $cliente_id);
        $stmt->execute();
        $ress = $stmt->get_result();
        
        if($this->conex->error){  
            echo "..Error en la consulta sql: " . $this->conex->error;  
        }else{
            echo "..Eliminación exitosa" ;
        }  
    }

    //===========================================================================

    //! actualizarCliente() 

    public function actualizarCliente($cliente_id) {
        $argumento;
        $this->getConexion();
        if (!$this->conex) {
            die("Error: No se pudo establecer una conexión válida a la base de datos.");
        }

        $sql = mysqli_prepare($this->conex, "UPDATE clientes SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ?, contraseña = ? WHERE cliente_id =?");
        if (!$sql) {
            die("Error al preparar la declaración: " . $this->conex->error);
        }
        $sql->bind_param("issssss", $this->nombre, $this->apellido, $this->email, $this->telefono, $this->direccion, $this->contraseña , $this->cliente_id);
        $sql->execute();
        $ress = $sql->get_result();
        
        If($ress == true){
            echo "sql correcto";
        }else{
            echo "  ..ERROR sql" ;
        }  
    }

    //===========================================================================

    //! mostrar Cliente
    public function mostrarCliente() { 
        $this->getConexion();

        $sql = "SELECT * FROM clientes ";
        $result = mysqli_query($this->conex, $sql);
        
        $cliente = Array();
        while($fila = mysqli_fetch_array($result)){
            Array_push($cliente, $fila);
            echo json_encode($fila) . " <br> " . "<hr>"; //para traer todos los dotos

            //echo "<br>" . $fila['nombre'] . " " . $fila["apellidos"]; //para traer datos específicos.
        }
    }  
    
}

?>
</body>
</html>
