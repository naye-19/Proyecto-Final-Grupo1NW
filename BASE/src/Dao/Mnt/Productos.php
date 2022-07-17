<?php

namespace Dao\Mnt;

class Productos extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * FROM productos", array());
    }

    public static function getOne($ProdId)
    {
        $sqlstr = "SELECT a.ProdId, a.ProdNombre, a.ProdDescripcion, a.ProdPrecioVenta, a.ProdPrecioCompra, a.ProdEst, a.ProdStock, b.MediaId, b.MediaDoc, b.MediaPath
        FROM productos a LEFT JOIN media b ON a.ProdId = b.ProdId
        WHERE a.ProdId=:ProdId;";
        return self::obtenerUnRegistro($sqlstr, array("ProdId"=>$ProdId));
    }

    public static function insert($ProdNombre, $ProdDescripcion, $ProdPrecioVenta, $ProdPrecioCompra, $ProdEst, $ProdStock)
    {
        $insstr = "INSERT INTO productos (ProdNombre, ProdDescripcion, ProdPrecioVenta, ProdPrecioCompra, ProdEst, ProdStock) values (:ProdNombre, :ProdDescripcion, :ProdPrecioVenta, :ProdPrecioCompra, :ProdEst, :ProdStock);";
        return self::executeNonQuery(
            $insstr,
            array(
                "ProdNombre"=>$ProdNombre, 
                "ProdDescripcion"=>$ProdDescripcion, 
                "ProdPrecioVenta"=>$ProdPrecioVenta,
                "ProdPrecioCompra"=>$ProdPrecioCompra,
                "ProdEst"=>$ProdEst,
                "ProdStock"=>$ProdStock
            )
        );
    }

    public static function update($ProdNombre, $ProdDescripcion, $ProdPrecioVenta, $ProdPrecioCompra, $ProdEst, $ProdStock, $ProdId)
    {
        $updsql = "UPDATE productos SET ProdNombre=:ProdNombre, ProdDescripcion=:ProdDescripcion, ProdPrecioVenta=:ProdPrecioVenta, ProdPrecioCompra=:ProdPrecioCompra, ProdEst=:ProdEst, ProdStock=:ProdStock where ProdId=:ProdId;";
        return self::executeNonQuery(
            $updsql,
            array(
                "ProdNombre"=>$ProdNombre, 
                "ProdDescripcion"=>$ProdDescripcion,
                "ProdPrecioVenta"=>$ProdPrecioVenta,
                "ProdPrecioCompra"=>$ProdPrecioCompra,
                "ProdEst"=>$ProdEst,
                "ProdStock"=>$ProdStock,
                "ProdId"=>$ProdId
            )
        );
    }

    public static function delete( $ProdId)
    {
        $delsql = "delete from productos where ProdId=:ProdId;";
        return self::executeNonQuery(
            $delsql,
            array( "ProdId" => $ProdId)
        );
    }

    static public function searchProductos($ProductoBusqueda)
    {
        $sqlstr = "SELECT * FROM productos WHERE ProdNombre LIKE :ProductoBusqueda
        OR ProdPrecioVenta LIKE :ProductoBusqueda OR ProdEst LIKE :ProductoBusqueda;";
        
        return self::obtenerRegistros($sqlstr, array("ProductoBusqueda"=>"%".$ProductoBusqueda."%"));
    }

}

?>