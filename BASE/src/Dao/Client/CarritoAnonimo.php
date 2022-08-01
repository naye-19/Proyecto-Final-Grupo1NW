<?php

namespace Dao\Client;

class CarritoAnonimo extends \Dao\Table
{
    public static function comprobarProductoEnCarritoAnonimo($ClienteAnonimoId, $ProdId)
    {
        $sqlstr = "SELECT * FROM carritocompraclienteanonimo WHERE ClienteAnonimoId = :ClienteAnonimoId AND ProdId = :ProdId;";
        return self::obtenerUnRegistro($sqlstr, array("ClienteAnonimoId"=>$ClienteAnonimoId, "ProdId"=>$ProdId));
    }

    public static function insertarProductoCarritoAnonimo($ClienteAnonimoId, $ProdId, $ProdCantidad, $ProdPrecioVenta)
    {
        $insstr = "INSERT INTO carritocompraclienteanonimo VALUES (:ClienteAnonimoId, :ProdId, :ProdCantidad, :ProdPrecioVenta, NOW())";
        return self::executeNonQuery($insstr, array("ClienteAnonimoId"=>$ClienteAnonimoId, "ProdId"=>$ProdId, "ProdCantidad"=>$ProdCantidad, "ProdPrecioVenta"=>$ProdPrecioVenta));
    }

    public static function sumarProductoInventarioAnonimo($ProdId, $ProdCantidad)
    {
        $updstr = "UPDATE productos SET ProdStock = ProdStock + :ProdCantidad WHERE ProdId = :ProdId";
        return self::executeNonQuery($updstr, array("ProdId"=>intval($ProdId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function restarProductoInventarioAnonimo($ProdId, $ProdCantidad)
    {
        $updstr = "UPDATE productos SET ProdStock = ProdStock - :ProdCantidad WHERE ProdId = :ProdId";
        return self::executeNonQuery($updstr, array("ProdId"=>intval($ProdId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function deleteProductoCarritoAnonimo($ClienteAnonimoId, $ProdId)
    {
        $delsql = "DELETE FROM carritocompraclienteanonimo WHERE ClienteAnonimoId = :ClienteAnonimoId AND ProdId = :ProdId;";
        return self::executeNonQuery(
            $delsql,
            array("ClienteAnonimoId" => $ClienteAnonimoId, "ProdId"=>$ProdId)
        );
    }

    public static function deleteAllCarritoAnonimo($ClienteAnonimoId)
    {
        $delsql = "DELETE FROM carritocompraclienteanonimo WHERE ClienteAnonimoId = :ClienteAnonimoId;";
        return self::executeNonQuery($delsql, array("ClienteAnonimoId" => $ClienteAnonimoId));
    }

    public static function getProductosCarritoAnonimo($ClienteAnonimoId)
    {
        $sqlstr = "SELECT ca.*, p.ProdNombre, (ca.ProdCantidad * ca.ProdPrecioVenta) as 'TotalProducto', m.MediaDoc, m.MediaPath FROM carritocompraclienteanonimo ca INNER JOIN productos p on ca.ProdId = p.ProdId INNER JOIN media m on m.ProdId = p.ProdId WHERE ClienteAnonimoId = :ClienteAnonimoId GROUP BY ca.ProdId;"; 
        return self::obtenerRegistros($sqlstr, array("ClienteAnonimoId"=>strval($ClienteAnonimoId)));
    }

    public static function getTotalCarrito($ClienteAnonimoId)
    {
        $sqlstr = "SELECT SUM(ca.ProdCantidad * ca.ProdPrecioVenta) as 'Total' FROM carritocompraclienteanonimo ca INNER JOIN productos p on ca.ProdId = p.ProdId WHERE ClienteAnonimoId = :ClienteAnonimoId"; 
        return self::obtenerUnRegistro($sqlstr, array("ClienteAnonimoId"=>$ClienteAnonimoId));
    }
}
?>