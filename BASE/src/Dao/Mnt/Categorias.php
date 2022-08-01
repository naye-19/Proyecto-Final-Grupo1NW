<?php

namespace Dao\Mnt;

class Categorias extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * FROM categorias;", array());
    }

    public static function getOne($CategoriaId)
    {
        $sqlstr = "SELECT * FROM categorias where CategoriaId=:CategoriaId;";
        return self::obtenerUnRegistro($sqlstr, array("CategoriaId"=>$CategoriaId));
    }

    public static function insert($CategoriaNom, $CategoriaEst)
    {
        $insstr = "INSERT INTO categorias (CategoriaNom, CategoriaEst) VALUES (:CategoriaNom, :CategoriaEst);";
        return self::executeNonQuery(
            $insstr,
            array("CategoriaNom"=>$CategoriaNom, "CategoriaEst"=>$CategoriaEst)
        );
    }

    public static function update($CategoriaNom, $CategoriaEst, $CategoriaId)
    {
        $updsql = "UPDATE categorias SET CategoriaNom=:CategoriaNom, CategoriaEst=:CategoriaEst WHERE CategoriaId=:CategoriaId;";
        return self::executeNonQuery(
            $updsql,
            array("CategoriaNom" => $CategoriaNom, "CategoriaEst" => $CategoriaEst, "CategoriaId" => $CategoriaId)
        );
    }

    public static function delete($CategoriaId)
    {
        $delsql = "DELETE FROM categorias WHERE CategoriaId=:CategoriaId;";
        return self::executeNonQuery(
            $delsql,
            array("CategoriaId" => $CategoriaId)
        );
    }

    static public function searchCategorias($UsuarioBusqueda)
    {
        $sqlstr = "SELECT * FROM categorias WHERE CategoriaNom LIKE :UsuarioBusqueda
        OR CategoriaEst LIKE :UsuarioBusqueda;";
        
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }
}

?>
