<?php

namespace Dao\Mnt;

class Ventas extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT v.*, u.UsuarioNombre FROM Ventas v INNER JOIN usuarios u on v.UsuarioId = u.UsuarioId WHERE VentaEst='ENVIADO';", array());
    }

    public static function getOne($VentaId)
    {
        $sqlstr = "SELECT v.*, u.UsuarioNombre FROM Ventas v INNER JOIN usuarios u on v.UsuarioId = u.UsuarioId WHERE VentaId=:VentaId;";
        return self::obtenerUnRegistro($sqlstr, array("VentaId"=>$VentaId));
    }

    public static function getProductos($VentaId)
    {
        $sqlstr = "SELECT vp.ProdId, ProdNombre, ProdDescripcion, ProdPrecioVenta, VentasProdCantidad FROM VentasProductos vp INNER JOIN Productos p ON vp.ProdId = p.ProdId WHERE vp.VentaId=:VentaId;";
        return self::obtenerRegistros($sqlstr, array("VentaId"=>$VentaId));
    }

    public static function getTotal($VentaId)
    {
        $sqlstr = "SELECT SUM(VentasProdCantidad * VentasProdPrecioVenta) as 'VentaSubtotal', (SUM(VentasProdCantidad * VentasProdPrecioVenta)) + (SUM(VentasProdCantidad * VentasProdPrecioVenta) * VentaISV) as 'VentaTotal' FROM ventas v INNER JOIN ventasproductos vp ON v.VentaId = vp.VentaId WHERE v.VentaId=:VentaId GROUP BY v.VentaId;";
        return self::obtenerRegistros($sqlstr, array("VentaId"=>$VentaId));
    }

    static public function searchVentas($UsuarioBusqueda)
    {
        $sqlstr = "SELECT v.*, u.UsuarioNombre FROM Ventas v INNER JOIN usuarios u on v.UsuarioId = u.UsuarioId 
        WHERE VentaId LIKE :UsuarioBusqueda OR VentaFecha LIKE :UsuarioBusqueda OR VentaISV LIKE :UsuarioBusqueda 
        OR VentaEst LIKE :UsuarioBusqueda OR VentaTipoPago LIKE :UsuarioBusqueda OR VentaPagoEnvio LIKE :UsuarioBusqueda 
        OR v.ClienteDireccion LIKE :UsuarioBusqueda OR v.ClienteTelefono LIKE :UsuarioBusqueda OR UsuarioNombre LIKE :UsuarioBusqueda;";
        
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }
}

?>
