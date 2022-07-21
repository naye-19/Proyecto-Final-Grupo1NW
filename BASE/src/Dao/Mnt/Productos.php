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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public static function getProductCount()
    {
        $sqlstr = "SELECT COUNT(ProdId) as 'Total' FROM productos WHERE ProdStock > 0 AND ProdEst = 'ACT' ;";
        return self::obtenerUnRegistro($sqlstr, array());
    }

    /**
     * Obtiene la lista de productos por pagina, (Mostrar)
     *  @param $Inicio
     * @param $Limite
     */
    public static function getProductosforPage($Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE ProdStock > 0 AND ProdEst = 'ACT' GROUP BY p.ProdId LIMIT :Inicio, :Limite;"; 
        //$sqlstr = "SELECT * FROM productos p WHERE p.ProdStock > 0 AND p.ProdEst = 'ACT'  LIMIT :Inicio, :Limite;"; 
        return self::obtenerRegistrosIntParams($sqlstr, array("Inicio"=>$Inicio, "Limite"=>$Limite));
    }

    /**
     * Selecciona un producto en especifico por el id y estado activo
     * @param $ProdId
     */

   /**
    * Buscar el producto por la descripcion
    * @param $UsuarioBusqueda lo que escribe el usario para buscar.
    * @param $Inicio
    * @param $Limite
    */
    static public function searchProductosCliente($UsuarioBusqueda, $Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE p.ProdEst = 'ACT' AND p.ProdStock > 0 AND (p.ProdNombre LIKE :UsuarioBusqueda) or (p.ProdPrecioVenta like :UsuarioBusqueda) LIMIT :Inicio, :Limite;";
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%", "Inicio"=>intval($Inicio), "Limite"=>intval($Limite)));
    }
    /**
     * Encontramos los productos por un rango de precio especifico
     * @param $rangoInicial
     * @param $rangoFinal
     * @param $Inicio
     * @param $Limite
     * 
     */
    static public function searchProductosByPrice($rangoInicial,$rangoFinal,$Inicio,$Limite)
    {
        $sqlstr = "SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE p.ProdEst = 'ACT' AND p.ProdStock > 0 AND p.ProdPrecioVenta between :rangoInicial and :rangoFinal LIMIT :inicio, :limite;";
        return self::obtenerRegistros($sqlstr, array("rangoInicial" => $rangoInicial, "rangoFinal"=>$rangoFinal,"inicio"=>$Inicio,"limite"=>$Limite));
    }

    /**
     * Cuenta el total de productos que se encuentrarn en un rango especifico 
     * @param $rangoInicial
     * @param $rangoFinal
     */
    static public function searchProductosByPriceCount($rangoInicial,$rangoFinal){
        $sqlstr = "SELECT count(*) as 'Total' FROM productos p WHERE p.ProdEst = 'ACT' AND p.ProdStock > 0 AND p.ProdPrecioVenta between :rangoInicial and :rangoFinal;";
        return self::obtenerRegistros($sqlstr, array("rangoInicial" => $rangoInicial, "rangoFinal"=>$rangoFinal));
    }

     /**
     * Cuenta el total de productos que se encuentran por la descripcicon
     * @param $UsuarioBusqueda
     */
    static public function searchProductosClienteCount($UsuarioBusqueda)
    {
        $sqlstr = "SELECT COUNT(ProdId) as 'Total' FROM productos WHERE ProdStock > 0 AND ProdEst = 'ACT' AND (ProdNombre LIKE :UsuarioBusqueda);";
        return self::obtenerUnRegistro($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }
}
