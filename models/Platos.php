<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platos</title>
</head>
<body>
    
<?php

require_once 'config/Database.php';

class Platos extends Database{
    public $plato_id;
    public $menu_id;
    public $nombre_plato;
    public $descripcion;
    public $precio;
    public $cantidad;
    public $conex;

    public function __construct($plato_id, $menu_id, $nombre_plato, $descripcion, $precio, $cantidad) {
        $this->plato_id = $plato_id;
        $this->menu_id = $menu_id;
        $this->nombre_plato = $nombre_plato;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }
    
    //!======================================================================================
    public function crearPlato() { 
        $this->getConexion();

        $crea = mysqli_prepare($this->conex,"INSERT INTO platos(plato_id, menu_id, nombre_plato, descripcion, precio, cantidad) VALUES (?, ?, ?, ?, ?, ?)");
        $crea->bind_param("iisssi",$this->plato_id, $this->menu_id, $this->nombre_plato, $this->descripcion, $this->precio, $this->cantidad);
        $crea->execute();
    }

    //!======================================================================================
    public function mostrarPlatos() { 
        $this->getConexion();

        $sql = "SELECT * FROM platos";
        $result = mysqli_query($this->conex, $sql);
        $platos = Array(); // Se crea un array vacío para almacenar los resultados de la consulta
        // Se itera sobre cada fila de resultados de la consulta
        while($fila = mysqli_fetch_array($result)){
            Array_push($platos, $fila) ; // Se añade cada fila al array $platos
            echo json_encode($fila) . "<hr>"; // Imprimir la fila en formato JSON

            //echo $fila['nombre']; //? para traer datos específicos.
        }
    }

    //!=====================================================================================
    public function actualizarPlato($plato_id) {
        $this->getConexion();
        
        $stmt = mysqli_prepare($this->conex,"UPDATE platos SET menu_id=?, nombre_plato=?, descripcion=?, precio=?, cantidad=? WHERE plato_id=?");
    
        $stmt->blind_param("isssii", $this->menu_id, $this->nombre_plato, $this->descripcion, $this->precio, $this->cantidad, $this->plato_id);
        $stmt->execute();
    }
    
    //!=====================================================================================
    public function eliminarPlato($plato_id) {
        $this->getConexion();

        $query = "DELETE FROM platos WHERE plato_id = ?";
        $stmt = $this->conex->prepare($query);
        $stmt->bind_param("i", $plato_id);
        $stmt->execute();
        //$ress = $stmt->get_result();

        if($this->conex->error){  
            echo "   ..Error en la consulta sql: " . $this->conex->error;  
        }else{
            echo "    ..Eliminación exitosa" ;
        }  
    }
}
?>

</body>
</html>