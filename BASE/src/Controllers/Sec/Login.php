<?php
namespace Controllers\Sec;
class Login extends \Controllers\PublicController
{
    private $txtEmail = "";
    private $txtPswd = "";
    private $errorEmail = "";
    private $errorPswd = "";
    private $generalError = "";
    private $hasError = false;

    public function run() :void
    {
        if ($this->isPostBack()) {
            $this->txtEmail = $_POST["txtEmail"];
            $this->txtPswd = $_POST["txtPswd"];

            if (!\Utilities\Validators::IsValidEmail($this->txtEmail)) {
                $this->errorEmail = "¡Correo no tiene el formato adecuado!";
                $this->hasError = true;
            }
            if (\Utilities\Validators::IsEmpty($this->txtPswd)) {
                $this->errorPswd = "¡Debe ingresar una contraseña!";
                $this->hasError = true;
            }
            if (! $this->hasError) {
                if ($dbUser = \Dao\Security\Security::getUsuarioByEmail($this->txtEmail)) {
                    if ($dbUser["UsuarioEst"] != \Dao\Security\Estados::ACTIVO) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        \Dao\Security\Bitacora::insert(
                            "project_nw", 
                            "ERROR: ". $dbUser["UsuarioId"] ." ". $dbUser["UsuarioEmail"]." tiene cuenta con estado ".$dbUser["UsuarioEst"],
                            "ACT",
                            $dbUser["UsuarioId"]
                        );
                    }
                    if (!\Dao\Security\Security::verifyPassword($this->txtPswd, $dbUser["UsuarioPswd"])) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        \Dao\Security\Bitacora::insert(
                            "project_nw",
                            "ERROR: ". $dbUser["UsuarioId"] ." ". $dbUser["UsuarioEmail"]." contraseña incorrecta",
                            "ACT",
                            $dbUser["UsuarioId"]
                        );
                        
                        // Aqui se debe establecer acciones segun la politica de la institucion.
                    }
                    if (! $this->hasError) {
                        \Utilities\Security::login(
                            $dbUser["UsuarioId"],
                            $dbUser["UsuarioNombre"],
                            $dbUser["UsuarioEmail"]
                        );
                        if (\Utilities\Context::getContextByKey("redirto") !== "") {
                            \Utilities\Site::redirectTo(
                                \Utilities\Context::getContextByKey("redirto")
                            );
                        } else {
                            $this->transferirArticulosCarritoAnonimo();
                            \Utilities\Site::redirectTo("index.php");
                        }
                    }
                } else {
                    error_log(
                        sprintf(
                            "ERROR: %s trato de ingresar",
                            $this->txtEmail
                        )
                    );
                    \Dao\Security\Bitacora::insert(
                        "project_nw",
                        "ERROR: ".$this->txtEmail." trato de ingresar",
                        "ACT",
                        $dbUser["UsuarioId"]
                    );
                    $this->generalError = "¡Credenciales son incorrectas!";
                }
            }
        }
        $dataView = get_object_vars($this);
        \Views\Renderer::render("security/login", $dataView);
    }

    private function transferirArticulosCarritoAnonimo() : void
    {
        $userId = \Utilities\Security::getUserId();

        $ArticulosCarritoAnonimo = \Dao\Client\CarritoAnonimo::getProductosCarritoAnonimo(session_id());

        if(!empty($ArticulosCarritoAnonimo))
        {
            foreach($ArticulosCarritoAnonimo as $articulo)
            {
                $_comprobar = \Dao\Client\CarritoUsuario::comprobarProductoEnCarritoUsuario($userId,$articulo["ProdId"]);
                if(empty($_comprobar))
                {
                    \Dao\Client\CarritoUsuario::insertarProductoCarritoUsuario($userId,$articulo["ProdId"],$articulo["ProdCantidad"],$articulo["ProdPrecioVenta"]);   
                }
                else
                {
                    \Dao\Client\CarritoUsuario::sumarProductoInventarioAnonimo($articulo["ProdId"], $_comprobar["ProdCantidad"]);
                    \Dao\Client\CarritoUsuario::deleteProductoCarritoUsuario($userId, $articulo["ProdId"]);
                    \Dao\Client\CarritoUsuario::insertarProductoCarritoUsuario($userId,$articulo["ProdId"],$articulo["ProdCantidad"],$articulo["ProdPrecioVenta"]);
                }
            }

            \Dao\Client\CarritoAnonimo::deleteAllCarritoAnonimo(session_id());
            \Utilities\Site::redirectTo("index.php?page=mnt_carrito");
        }

    }
}
?>
