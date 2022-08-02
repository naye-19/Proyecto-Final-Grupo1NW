<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController
{
    public function run():void
    {
        $viewData = array();
        $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
            "test".(time() - 10000000),
            "http://localhost/PJNW/BASE/index.php?page=checkout_error",
            "http://localhost/PJNW/BASE/index.php?page=checkout_accept"
        );

        $UsuarioId = \Utilities\Security::getUserId();

        $Items = \Dao\Client\CarritoUsuario::getProductosCarritoUsuario($UsuarioId);

        foreach($Items as $key => $value)
        {
            $precioSinImpuesto = \Utilities\CalculoPrecios::CalcularPrecioSinImpuesto($value["ProdPrecioVenta"]);

            $Items[$key]["ProdPrecioSinImpuesto"] = round($precioSinImpuesto, 2);
            $Items[$key]["ProdImpuesto"] = round(($value["ProdPrecioVenta"] - $precioSinImpuesto), 2);
        }

        $Items = $this->currencyConverter($Items);

        foreach($Items as $item)
        {
            $PayPalOrder->addItem(strval($item["ProdNombre"]), substr($item["ProdNombre"], 0, 20), strval($item["ProdId"]), $item["ProdPrecioSinImpuesto"], $item["ProdImpuesto"], $item["ProdCantidad"], "PHYSICAL_GOODS");
        }
      
        $response = $PayPalOrder->createOrder();
        $_SESSION["orderid"] = $response[1]->result->id;
        \Utilities\Site::redirectTo($response[0]->href);
        die();

        \Views\Renderer::render("paypal/checkout", $viewData);
    }

    private function currencyConverter($Items)
    {
        $req_url = 'https://api.exchangerate-api.com/v4/latest/HNL';
        $response_json = file_get_contents($req_url);

        if(false !== $response_json) 
        {
            try 
            {
                $response_object = json_decode($response_json);
                $dollarconversion = $response_object->rates->USD;

                foreach($Items as $key => $value)
                {
                    $Items[$key]["ProdPrecioSinImpuesto"] = round(($value["ProdPrecioSinImpuesto"] * $dollarconversion), 2);
                    $Items[$key]["ProdImpuesto"] = round(($value["ProdImpuesto"] * $dollarconversion), 2);
                }

            }
            catch(Exception $e) 
            {
                error_log(
                    strval($e)
                );
            }
        }

        return $Items;
    }
}
