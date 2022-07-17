<?php

namespace Dao\Client;

class Productos extends \Dao\Table
{
    public static function getProductosRecientes()
    {
        return self::obtenerRegistros("SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE ProdStock > 0 AND ProdEst = 'ACT' GROUP BY p.ProdId ORDER BY p.ProdId DESC LIMIT 8;", array());
    }

    public static function getProductCount()
    {
        $sqlstr = "SELECT COUNT(ProdId) as 'Total' FROM Productos WHERE ProdStock > 0 AND ProdEst = 'ACT' ;";
        return self::obtenerUnRegistro($sqlstr, array());
    }

    public static function getProductosforPage($Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE ProdStock > 0 AND ProdEst = 'ACT' GROUP BY p.ProdId LIMIT :Inicio, :Limite;"; 
        return self::obtenerRegistrosIntParams($sqlstr, array("Inicio"=>$Inicio, "Limite"=>$Limite));
    }

    public static function getOne($ProdId)
    {
        $sqlstr = "SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE p.ProdId = :ProdId AND ProdEst = 'ACT' GROUP BY p.ProdId;";
        return self::obtenerUnRegistro($sqlstr, array("ProdId"=>$ProdId));
    }

    public static function getAllProductMedia($ProdId)
    {
        $sqlstr = "SELECT * FROM media WHERE ProdId=:ProdId";
        return self::obtenerRegistros($sqlstr, array("ProdId"=>$ProdId));
    }

    static public function searchProductosCliente($UsuarioBusqueda, $Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM productos p INNER JOIN media m on p.ProdId = m.ProdId WHERE ProdEst = 'ACT' AND ProdStock > 0 AND (p.ProdNombre LIKE :UsuarioBusqueda) GROUP BY p.ProdId LIMIT :Inicio, :Limite;";
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%", "Inicio"=>intval($Inicio), "Limite"=>intval($Limite)));
    }

    static public function searchProductosClienteCount($UsuarioBusqueda)
    {
        $sqlstr = "SELECT COUNT(ProdId) as 'Total' FROM productos WHERE ProdStock > 0 AND ProdEst = 'ACT' AND (ProdNombre LIKE :UsuarioBusqueda);";
        
        return self::obtenerUnRegistro($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }
}

?>