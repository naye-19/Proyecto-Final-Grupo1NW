<?php

namespace Dao\Mnt;

class Media extends \Dao\Table
{
    public static function getAll($ProdId)
    {
        $sqlstr = "Select * from media where ProdId=:ProdId;";
        return self::obtenerRegistros($sqlstr, array("ProdId"=>$ProdId));
    }

    public static function insert($MediaDoc, $MediaPath)
    {
        $ProdId = self::obtenerRegistros("Select max(ProdId) as ProdId from productos;", array());

        foreach($ProdId as $item){
            $ProdId = $item["ProdId"];
        }
        
        $insstr = "INSERT INTO media (MediaDoc, MediaPath, ProdId) values (:MediaDoc, :MediaPath, :ProdId);";
        return self::executeNonQuery(
            $insstr,
            array(
                "MediaDoc"=>$MediaDoc, 
                "MediaPath"=>$MediaPath, 
                "ProdId"=>$ProdId
            )
        );
    }

    public static function update($MediaDoc, $MediaPath, $ProdId)
    {
        $updsql = "INSERT INTO media (MediaDoc, MediaPath, ProdId) values (:MediaDoc, :MediaPath, :ProdId);";
        return self::executeNonQuery(
            $updsql,
            array(
                "MediaDoc"=>$MediaDoc, 
                "MediaPath"=>$MediaPath,
                "ProdId"=>$ProdId,
            )
        );
    }

    public static function delete($ProdId, $MediaId)
    {
        $delsql = "DELETE from media where ProdId=:ProdId and MediaId=:MediaId;";
        return self::executeNonQuery(
            $delsql,
            array( 
                "ProdId" => $ProdId,
                "MediaId" => $MediaId
            )
        );
    }

}

?>