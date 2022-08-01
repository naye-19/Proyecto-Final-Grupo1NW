<?php

namespace Controllers\Mnt;

class Carrito extends \Controllers\PublicController
{
    private $Items = array();
    private $Total = 0.00;
    private $Subtotal = 0.00;

    public function run() :void
    {
        if(!$this->isPostBack()) 
        {
            if(!\Utilities\Security::isLogged())
            {
               $this->mostarProductosCarritoAnonimo();
            }
            else
            {
                $this->mostarProductosCarritoUsuario();
            }
        }
        else
        {   
            if(!\Utilities\Security::isLogged())
            {
                $this->eliminarProductoCarritoAnonimo();
            }
            else
            {
                $this->eliminarProductoCarritoUsuario();
            }
        }

        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        $allViewData= get_object_vars($this);
        \Views\Renderer::render("mnt/carrito", $allViewData, $layout);
    }

    private function mostarProductosCarritoAnonimo()
    {
        $this->Items = \Dao\Client\CarritoAnonimo::getProductosCarritoAnonimo(session_id());

        //Reformatear valor desde la base con decimales
        foreach($this->Items as $key => $value)
        {
            $this->Items[$key]["ProdPrecioVenta"] = number_format($value["ProdPrecioVenta"], 2);
            $this->Items[$key]["TotalProducto"] = number_format($value["TotalProducto"], 2);

            $precioSinImpuesto = \Utilities\CalculoPrecios::CalcularPrecioSinImpuesto($value["ProdPrecioVenta"]);

            $this->Items[$key]["ProdPrecioSinImpuesto"] = number_format($precioSinImpuesto, 2);
            $this->Items[$key]["ProdImpuesto"] = number_format(($value["ProdPrecioVenta"] - $precioSinImpuesto), 2);
            $this->Subtotal += $precioSinImpuesto;
            $this->Total += $value["ProdPrecioVenta"];

        }

        $this->Subtotal = number_format($this->Subtotal, 2);
        $this->Total = number_format($this->Total, 2);
    }

    private function eliminarProductoCarritoAnonimo()
    {
        $ProdId = isset($_POST["ProdId"])?$_POST["ProdId"]:"";
        $ProdCantidad = isset($_POST["ProdCantidad"])?$_POST["ProdCantidad"]:"";

        if(!empty($ProdId) && !empty($ProdCantidad))
        {
            $resultDelete = \Dao\Client\CarritoAnonimo::deleteProductoCarritoAnonimo(session_id(), $ProdId);
            $resultUpdate = \Dao\Client\CarritoAnonimo::sumarProductoInventarioAnonimo($ProdId, $ProdCantidad);

            if($resultDelete && $resultUpdate)
            {
                \Utilities\Site::redirectToWithMsg("index.php?page=mnt_carrito", "Producto Eliminado con Éxito");
            }
        }
    }

    private function mostarProductosCarritoUsuario()
    {
        $UsuarioId = \Utilities\Security::getUserId();

        $this->Items = \Dao\Client\CarritoUsuario::getProductosCarritoUsuario($UsuarioId);

        foreach($this->Items as $key => $value)
        {
            $this->Items[$key]["ProdPrecioVenta"] = number_format($value["ProdPrecioVenta"], 2);
            $this->Items[$key]["TotalProducto"] = number_format($value["TotalProducto"], 2);

            $precioSinImpuesto = \Utilities\CalculoPrecios::CalcularPrecioSinImpuesto($value["ProdPrecioVenta"]);

            $this->Items[$key]["ProdPrecioSinImpuesto"] = number_format($precioSinImpuesto, 2);
            $this->Items[$key]["ProdImpuesto"] = number_format(($value["ProdPrecioVenta"] - $precioSinImpuesto), 2);
            $this->Subtotal += $precioSinImpuesto;
            $this->Total += $value["ProdPrecioVenta"];
        }

        $this->Subtotal = number_format($this->Subtotal, 2);
        $this->Total = number_format($this->Total, 2);
    }

    private function eliminarProductoCarritoUsuario()
    {
        $UsuarioId = \Utilities\Security::getUserId();
        $ProdId = isset($_POST["ProdId"])?$_POST["ProdId"]:"";
        $ProdCantidad = isset($_POST["ProdCantidad"])?$_POST["ProdCantidad"]:"";

        if(!empty($ProdId) && !empty($ProdCantidad))
        {   
            $resultDelete = \Dao\Client\CarritoUsuario::deleteProductoCarritoUsuario($UsuarioId, $ProdId);
            $resultUpdate = \Dao\Client\CarritoUsuario::sumarProductoInventarioAnonimo($ProdId, $ProdCantidad);

            if($resultDelete && $resultUpdate)
            {
                \Utilities\Site::redirectToWithMsg("index.php?page=mnt_carrito", "Producto Eliminado con Éxito");
            }
        }
    }
}