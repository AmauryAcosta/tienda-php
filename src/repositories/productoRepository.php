<?php
require_once("../config/database.php");
require_once("../interfaces/productoInterface.php");

class ProductoRepository implements IProducto {
    private $conn;
    public function__construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crearProducto($producto){
        $sql = "INSERT INTO productos (nombre, descripcion, tipo, precio, imagen) VALUES (:nombre, :descripcion, :tipo, :precio, :imagen)";
        $resultado = $this->conn->prepare($sql);
        $resultado->bind_param(":nombre", $producto->nombre);
        $resultado->bind_param(":descripción", $producto->descripcion);
        $resultado->bind_param(":tipo", $producto->tipo);
        $resultado->bind_param(":precio", $producto->precio);
        $resultado->bind_param(":imagen", $producto->imagen);

        if($resultado->execute()) {
            return ['mensaje' => 'Producto Creado'];
        }
        return ['Mensaje' => 'Error al crear el producto'];
    }

    public function actualizarProducto($producto){
        $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, tipo = :tipo, precio = :precio, imagen = :imagen WHERE idproducto = :idproducto";
        $resultado = $this->conn->prepare($sql);
        $resultado->bind_param(':idproducto', $producto->idproducto)
        $resultado->bind_param(":nombre", $producto->nombre);
        $resultado->bind_param(":descripción", $producto->descripcion);
        $resultado->bind_param(":tipo", $producto->tipo);
        $resultado->bind_param(":precio", $producto->precio);
        $resultado->bind_param(":imagen", $producto->imagen);

        if($resultado->execute()) {
            return ['mensaje' => 'Producto Actualizado'];
        }
        return ['Mensaje' => 'Error al actualizar el producto'];
    }

    public function borrarProducto($producto){
        $sql = "DELETE FROM productos WHERE idproducto = :idproducto";
        $resultado = $this->conn->prepare($sql);
        $resultado->bind_param(':idproducto', $idproducto)

        if($resultado->execute()) {
            return ['mensaje' => 'Producto Borrado'];
        }
        return ['Mensaje' => 'Error al Borrar el producto'];
    }

    public function obtenerProductos($productos){
        $sql = "SELECT * FROM productos";
        $resultado = $this->conn->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductosPorNombre($productos){
        $sql = "SELECT * FROM productos WHERE nombre = :nombre";
        $resultado = $this->conn->prepare($sql);
        $resultado = bindParam(':nombre', $nombre)
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>