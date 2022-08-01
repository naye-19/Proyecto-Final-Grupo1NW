<?php

namespace Dao\Client;

class CarritoUsuario extends \Dao\Table
{
    public static function comprobarProductoEnCarritoUsuario($UsuarioId, $ProdId)
    {
        $sqlstr = "SELECT * FROM carritocompraclienteregistrado WHERE UsuarioId = :UsuarioId AND ProdId = :ProdId;";
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>intval($UsuarioId), "ProdId"=>$ProdId));
    }

    public static function insertarProductoCarritoUsuario($UsuarioId, $ProdId, $ProdCantidad, $ProdPrecioVenta)
    {
        $insstr = "INSERT INTO carritocompraclienteregistrado VALUES (:UsuarioId, :ProdId, :ProdCantidad, :ProdPrecioVenta, NOW())";
        return self::executeNonQuery($insstr, array("UsuarioId"=>intval($UsuarioId), "ProdId"=>$ProdId, "ProdCantidad"=>$ProdCantidad, "ProdPrecioVenta"=>$ProdPrecioVenta));
    }

    public static function sumarProductoInventarioAnonimo($ProdId, $ProdCantidad)
    {
        $updstr = "UPDATE productos SET ProdStock = ProdStock + :ProdCantidad WHERE ProdId = :ProdId";
        return self::executeNonQuery($updstr, array("ProdId"=>intval($ProdId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function restarProductoInventarioUsuario($ProdId, $ProdCantidad)
    {
        $updstr = "UPDATE productos SET ProdStock = ProdStock - :ProdCantidad WHERE ProdId = :ProdId";
        return self::executeNonQuery($updstr, array("ProdId"=>intval($ProdId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function deleteProductoCarritoUsuario($UsuarioId, $ProdId)
    {
        $delsql = "DELETE FROM carritocompraclienteregistrado WHERE UsuarioId = :UsuarioId AND ProdId = :ProdId;";
        return self::executeNonQuery(
            $delsql,
            array("UsuarioId" => intval($UsuarioId), "ProdId"=>$ProdId)
        );
    }

    public static function getProductosCarritoUsuario($UsuarioId)
    {
        $sqlstr = "SELECT cr.*, p.ProdNombre, (cr.ProdCantidad * cr.ProdPrecioVenta) as 'TotalProducto', m.MediaDoc, m.MediaPath FROM carritocompraclienteregistrado cr INNER JOIN productos p on cr.ProdId = p.ProdId INNER JOIN media m on m.ProdId = p.ProdId WHERE UsuarioId = :UsuarioId GROUP BY cr.ProdId;"; 
        return self::obtenerRegistros($sqlstr, array("UsuarioId"=>intval($UsuarioId)));
    }

    public static function getTotalCarrito($UsuarioId)
    {
        $sqlstr = "SELECT SUM(cr.ProdCantidad * cr.ProdPrecioVenta) as 'Total' FROM carritocompraclienteregistrado cr INNER JOIN productos p on cr.ProdId = p.ProdId WHERE UsuarioId = :UsuarioId"; 
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>intval($UsuarioId)));
    }
}
?>