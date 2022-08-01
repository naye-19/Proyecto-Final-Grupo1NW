<?php 

    namespace Utilities;

    class CalculoPrecios
    {
        public static function CalcularPrecioSinImpuesto($precioConImpuesto)
        {
            return ($precioConImpuesto / 1.15);
        }
    }

?>