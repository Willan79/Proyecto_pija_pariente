<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de Datos</title>
</head>
<body>
    
<?php
// ! Configuración de conxión a base de datos

class Database {

    public $host = "localhost";
    public $db_name = "pija_pariente";
    public $username = "root";
    public $password = "";
    public $conex;

    // Función para crear la conexión a base de datos
    public function getConexion() {
        try{
            // Crear conexión
            $this->conex = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
            // Verificar conexión
            if ($this->conex) {
                echo "Conexión exitosa" . "<br>";
            }
            
        }catch(Exception $e){
            echo "Error de conexión" . $e->getMessage();
        }
        return $this->conex;
        //$conex->close();
    }
    
}

$bd = new Database();
$bd->getConexion();
?>
</body>
</html>