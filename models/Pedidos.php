<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
    


<?php
class Pedidos extends Database{
    private $conn;
    private $table_name = "pedidos";

    public $estadoPedido;
    public $listaPlatos;
    public $fechaPedido;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function modificarPedido($id, $nuevosDatos) {
        $query = "UPDATE " . $this->table_name . " SET estadoPedido = :estadoPedido, listaPlatos = :listaPlatos, fechaPedido = :fechaPedido WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":estadoPedido", $nuevosDatos['estadoPedido']);
        $stmt->bindParam(":listaPlatos", $nuevosDatos['listaPlatos']);
        $stmt->bindParam(":fechaPedido", $nuevosDatos['fechaPedido']);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function modificarEstadoPedido($id, $nuevoEstado) {
        $this->getConexion();

        $query = "UPDATE  pedidos  SET estadoPedido = :estadoPedido WHERE pedidos_id = ?";
        $stmt = $this->conex->prepare($query);

        $stmt->bind_param("estadoPedido", $nuevoEstado);
        $stmt->bind_param(":pedidos_id", $pedidos_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>

</body>
</html>