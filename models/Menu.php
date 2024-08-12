<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
</head>
<body>

<?php
require_once 'config/Database.php';

class Menu extends Database{

    public function mostrarCategorias() { 
        $this->getConexion();

        $sql = "SELECT * FROM menu ";
        $result = mysqli_query($this->conex, $sql);
        
        $menu = Array();
        while($fila = mysqli_fetch_array($result)){
            Array_push($menu, $fila);
            //echo json_encode($fila) . " <br> "; //? Todos los datos

            echo "<br>" . $fila['categorías']; // solo el nombre de las categorías.
        }
    }    

}

?>

</body>
</html>