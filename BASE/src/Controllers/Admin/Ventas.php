<?php 
namespace Controllers\Admin;

class Ventas extends \Controllers\PrivateController
{
    private $UsuarioBusqueda = "";

    public function __construct()
    {
        /*
        $userInRole = \Utilities\Security::isInRol(
            \Utilities\Security::getUserId(),
            "ADMINISTRADOR"
        );*/
        
        
        parent::__construct();
    }

    public function run() :void
    {
        $dataview = array();
        
        if ($this->isPostBack()) 
        {   
            $this->UsuarioBusqueda = isset($_POST["UsuarioBusqueda"]) ? $_POST["UsuarioBusqueda"] : "";

            if(!empty($this->UsuarioBusqueda))
            {
                $dataview["items"] = \Dao\Mnt\Ventas::searchVentas($this->UsuarioBusqueda);
                \Utilities\Context::setContext("UsuarioBusqueda", $this->UsuarioBusqueda);
            }
            else
            {
                $dataview["items"] = \Dao\Mnt\Ventas::getAll();
            }
        } 
        else
        {   
            $dataview["items"] = \Dao\Mnt\Ventas::getAll();
        }

        \Views\Renderer::render("admin/ventas", $dataview);
    }
}


