<?php
namespace Controllers\Mnt;

class DetalleProducto extends \Controllers\PublicController
{
    private $ProdId = 0;
    private $ProdNombre = "";
    private $ProdDescripcion = "";
    private $ProdPrecioVenta = "";
    private $ProdCantidad = 1;
    private $ProdStock = "";
    private $PrimaryMediaDoc = "";
    private $PrimaryMediaPath = "";
    private $AllProductMedia = array(); 
    private $Error = "";

    private $mode_dsc = "";

    public function run() :void
    {
        $this->ProdId = isset($_GET["ProdId"])?$_GET["ProdId"]:0;
       
        if($this->isPostBack()) 
        {
           $this->_loadPostData();
        }

        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        $this->_load();
        $dataview = get_object_vars($this);

        \Views\Renderer::render("mnt/detalleProducto", $dataview, $layout);
    }

    private function _load()
    {
        $_data = \Dao\Client\Productos::getOne($this->ProdId);
        $_productMedia = \Dao\Client\Productos::getAllProductMedia($this->ProdId);

        if ($_data) 
        {
            $this->ProdId = $_data["ProdId"];
            $this->ProdNombre = $_data["ProdNombre"];
            $this->ProdDescripcion = $_data["ProdDescripcion"];
            $precioFinal = ($_data["ProdPrecioVenta"]) + ($_data["ProdPrecioVenta"] * 0.15); 
            $this->ProdPrecioVenta = number_format($precioFinal, 2);
            $this->ProdStock = $_data["ProdStock"];
            $this->PrimaryMediaDoc = $_data["MediaDoc"];
            $this->PrimaryMediaPath = $_data["MediaPath"];
        }

        if($_productMedia)
        {
            $this->AllProductMedia = $_productMedia;
        }
    }

    private function _loadPostData()
    {
        $this->ProdPrecioVenta = isset($_POST["ProdPrecioVenta"])?$_POST["ProdPrecioVenta"]:""; 
        $this->ProdCantidad = isset($_POST["ProdCantidad"])?$_POST["ProdCantidad"]:""; 
        $this->ProdPrecioVenta = floatval(str_replace(",","",$this->ProdPrecioVenta));
        $this->ProdStock = isset($_POST["ProdStock"]) ? $_POST["ProdStock"] : "";

        if(!\Utilities\Security::isLogged())
        {
            $this->addProductCarritoAnonimo();
        }
        else
        {
            $this->addProductCarritoUsuario();
        }
    }

    private function addProductCarritoAnonimo()
    {
        $_comprobar = \Dao\Client\CarritoAnonimo::comprobarProductoEnCarritoAnonimo(session_id(), $this->ProdId);

        if(empty($_comprobar))
        {   
            if(!$this->validarCantidadDisponibleProducto())
            {
                $this->ingresarProductoCarritoAnonimo();
            }
        }
        else
        {
            if(!$this->validarCantidadDisponibleProducto())
            {
                $resultUpdate = \Dao\Client\CarritoAnonimo::sumarProductoInventarioAnonimo($this->ProdId, $_comprobar["ProdCantidad"]);
                $resultDelete = \Dao\Client\CarritoAnonimo::deleteProductoCarritoAnonimo(session_id(), $this->ProdId);

                if($resultDelete && $resultUpdate)
                {
                    $this->ingresarProductoCarritoAnonimo();
                }
            }
        }
    }

    private function addProductCarritoUsuario()
    {
        $UsuarioId = \Utilities\Security::getUserId();
        $_comprobar = \Dao\Client\CarritoUsuario::comprobarProductoEnCarritoUsuario($UsuarioId, $this->ProdId);

        if(empty($_comprobar))
        {
            if(!$this->validarCantidadDisponibleProducto())
            {   
               $this->ingresarProductoCarritoUsuario($UsuarioId);
            }
        }
        else
        {
            if(!$this->validarCantidadDisponibleProducto())
            {
                $resultUpdate = \Dao\Client\CarritoUsuario::sumarProductoInventarioAnonimo($this->ProdId, $_comprobar["ProdCantidad"]);
                $resultDelete = \Dao\Client\CarritoUsuario::deleteProductoCarritoUsuario($UsuarioId, $this->ProdId);
               
                if($resultDelete && $resultUpdate)
                {
                    $this->ingresarProductoCarritoUsuario($UsuarioId);
                }
            }
        }
    }

    private function validarCantidadDisponibleProducto()
    {
        $error = false;
        if($this->ProdCantidad > $this->ProdStock)
        {
            $this->Error = "No se cuenta con las suficientes unidades en existencia, unidades actuales: ".$this->ProdStock;
            $error = true;
        }

        return $error;
    }

    private function ingresarProductoCarritoAnonimo()
    {
        $resultInsert = \Dao\Client\CarritoAnonimo::insertarProductoCarritoAnonimo(session_id(), $this->ProdId, $this->ProdCantidad, $this->ProdPrecioVenta);
        $resultUpdate =  \Dao\Client\CarritoAnonimo::restarProductoInventarioAnonimo($this->ProdId, $this->ProdCantidad);

        if($resultInsert && $resultUpdate)
        {
            \Utilities\Site::redirectToWithMsg("index.php?page=mnt_detalleProducto&ProdId=".$this->ProdId, "Producto Agregado al Carrito con Éxito");
        }
    }

    private function ingresarProductoCarritoUsuario($UsuarioId)
    {
        $resultInsert = \Dao\Client\CarritoUsuario::insertarProductoCarritoUsuario($UsuarioId, $this->ProdId, $this->ProdCantidad, $this->ProdPrecioVenta);
        $resultUpdate = \Dao\Client\CarritoUsuario::restarProductoInventarioUsuario($this->ProdId, $this->ProdCantidad);

        if($resultInsert && $resultUpdate)
        {
            \Utilities\Site::redirectToWithMsg("index.php?page=mnt_detalleProducto&ProdId=".$this->ProdId, "Producto Agregado al Carrito con Éxito");
        }
    }
}
?>