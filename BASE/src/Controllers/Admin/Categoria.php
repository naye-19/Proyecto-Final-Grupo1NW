<?php 
namespace Controllers\Admin;

use Dao\Security\Estados;

class Categoria extends \Controllers\PrivateController
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

    private $CategoriaId = 0;
    private $CategoriaNom = "";
    private $CategoriaEst = "";
    private $CategoriaEst_ACT = "";
    private $CategoriaEst_INA = "";

    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nueva Categoría",
        "UPD" => "Editar %s %s",
        "DEL" => "Eliminar %s %s",
        "DSP" => "%s %s"
    );

    private $readonly = "";
    private $showaction= true;
    private $notDisplayIns= false;

    private $hasErrors = false;
    private $aErrors = array();

    public function run() :void
    {
        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->CategoriaId = isset($_GET["CategoriaId"])?$_GET["CategoriaId"]:0;
        if (!$this->isPostBack()) 
        {
            if ($this->mode !== "INS") 
            {
                $this->_load();
            } else 
            {
                $this->mode_dsc = $this->mode_adsc[$this->mode];
            }
        } 
        else 
        {
            $this->_loadPostData();
            if (!$this->hasErrors) 
            {
                switch ($this->mode){
                case "INS":
                    if (\Dao\Mnt\Categorias::insert($this->CategoriaNom, Estados::ACTIVO)) 
                    {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=admin_categorias",
                            "¡Categoría Agregada Satisfactoriamente!"
                        );
                    }
                break;

                case "UPD":
                    if (\Dao\Mnt\Categorias::update($this->CategoriaNom, $this->CategoriaEst, $this->CategoriaId)) 
                    {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=admin_categorias",
                            "¡Categoría Actualizada Satisfactoriamente!"
                        );
                    }
                break;

                case "DEL":
                    if (\Dao\Mnt\Categorias::delete($this->CategoriaId)) 
                    {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=admin_categorias",
                            "¡Categoría Eliminada Satisfactoriamente!"
                        );
                    }
                break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("admin/categoria", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Categorias::getOne($this->CategoriaId);
        if ($_data) 
        {
            $this->CategoriaId = $_data["CategoriaId"];
            $this->CategoriaNom = $_data["CategoriaNom"];
            $this->CategoriaEst = $_data["CategoriaEst"];
            $this->_setViewData();
        }
    }

    private function _loadPostData()
    {
        $this->CategoriaId = isset($_POST["CategoriaId"]) ? $_POST["CategoriaId"] : 0;
        $this->CategoriaNom = isset($_POST["CategoriaNom"]) ? $_POST["CategoriaNom"] : "";
        $this->CategoriaEst = isset($_POST["CategoriaEst"]) ? $_POST["CategoriaEst"] : "ACT";

        if (\Utilities\Validators::IsEmpty($this->CategoriaNom)) 
        {
            $this->aErrors[] = "¡La categoría no puede ir vacia!";
        }

        if (!\Utilities\Validators::ValidarSoloLetras($this->CategoriaNom)) 
        {
            $this->aErrors[] = "¡La categoría no es válida!";
        }

        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->CategoriaEst_ACT = ($this->CategoriaEst === "ACT") ? "selected" : "";
        $this->CategoriaEst_INA = ($this->CategoriaEst === "INA") ? "selected" : "";
        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->CategoriaId,
            $this->CategoriaNom
        );

        $this->notDisplayIns = ($this->mode=="INS") ? false : true;
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>
