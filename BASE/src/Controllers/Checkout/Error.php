<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
class Error extends PublicController
{
    public function run(): void
    {
        \Utilities\Site::redirectToWithMsg("index.php", "¡Transacción Cancelada!");
    }
}

?>
