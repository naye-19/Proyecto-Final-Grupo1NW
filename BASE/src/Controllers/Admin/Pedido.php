<?php 
namespace Controllers\Admin;

use Dao\Security\Estados;

class Pedido extends \Controllers\PrivateController
{
    public function __construct()
    {
        /*
        $userInRole = \Utilities\Security::isInRol(
            \Utilities\Security::getUserId(),
            "ADMINISTRADOR"
        );
        */
        
        parent::__construct();
    }

    private $VentaId = 0;
    private $VentaFecha = "";
    private $VentaISV = "";
    private $VentaEst = "";
    private $VentaLinkDevolucion = "";
    private $VentaLinkOrden = "";
    private $VentaCantidadTotal = "";
    private $VentaComisionPayPal = "";
    private $VentaCantidadNeta = "";
    private $ClienteDireccion = "";
    private $ClienteTelefono = "";
    private $UsuarioNombre = "";
    private $Productos = array();

    private $mode_dsc = "";
    private $mode_adsc = array(
        "UPD" => "Editar Venta Código: %s, Nombre del Cliente: %s",
        "DSP" => "Visualizar Venta Código: %s, Nombre del Cliente: %s"
    );

    private $readonly = "";
    private $showaction= true;
    private $notDisplayIns= false;

    private $hasErrors = false;
    private $aErrors = array();

    public function run() :void
    {
        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->VentaId = isset($_GET["VentaId"])?$_GET["VentaId"]:0;
        if (!$this->isPostBack()) 
        {
            $this->_load();
        } 
        else 
        { 
            switch ($this->mode)
            {
                case "UPD":
                    if (\Dao\Mnt\Pedidos::update($this->VentaId)) 
                    {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=admin_pedidos",
                            "¡Estado del Pedido Actualizado Satisfactoriamente!"
                        );
                    }
                break;
            }
            
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("admin/pedido", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Pedidos::getOne($this->VentaId);
        $_productos= \Dao\Mnt\Pedidos::getProductos($this->VentaId);

        if ($_data && $_productos) 
        {
            $this->VentaId = $_data["VentaId"];
            $this->VentaFecha = $_data["VentaFecha"];
            $this->VentaISV = $_data["VentaISV"];
            $this->VentaEst = $_data["VentaEst"];
            $this->VentaLinkDevolucion = $_data["VentaLinkDevolucion"];
            $this->VentaLinkOrden = $_data["VentaLinkOrden"];
            $this->VentaCantidadTotal = $_data["VentaCantidadTotal"];
            $this->VentaComisionPayPal = $_data["VentaComisionPayPal"];
            $this->VentaCantidadNeta = $_data["VentaCantidadNeta"];
            $this->ClienteDireccion = $_data["ClienteDireccion"];
            $this->ClienteTelefono = $_data["ClienteTelefono"];
            $this->UsuarioNombre = $_data["UsuarioNombre"];
            $this->Productos = $_productos;
            $this->_setViewData();
        }
    }

    private function _setViewData()
    {
        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->VentaId,
            $this->UsuarioNombre
        );

        $this->notDisplayIns = ($this->mode=="INS") ? false : true;
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>
