<?php 

namespace Controllers\Admin;

class Producto extends \Controllers\PrivateController
{
    public function __construct()
    {
        
        $userInRole = \Utilities\Security::isInRol(
            \Utilities\Security::getUserId(),
            "ADMINISTRADOR"
        );
        
        parent::__construct();
    }

    private $ProdId = 0;
    private $ProdNombre = "";
    private $ProdDescripcion = "";
    private $ProdPrecioVenta = 0;
    private $ProdPrecioCompra = 0;
    private $ProdEst = "";
    private $ProdStock = 0;
    private $ProdStock_ACT = "";
    private $ProdStock_INA = "";
    private $MediaId = 0;
    private $MediaPath = "public/img/productos/";
    private $Media = array();

    private $mode = "";
    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nuevo Producto",
        "UPD" => "Editar Código: %s Nombre: %s",
        "DEL" => "Eliminar Código: %s Nombre: %s",
        "DSP" => "Visualizar Código: %s Nombre: %s"
    );

    private $readonly = "";
    private $showaction= true;
    private $notDisplayIns= false;
    private $notDisplayDel= true;

    private $hasErrors = false;
    private $aErrors = array();

    public function run() :void
    {
        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->ProdId = isset($_GET["ProdId"])?$_GET["ProdId"]:"";

        if (!$this->isPostBack()) 
        {
            if ($this->mode !== "INS") 
            {
                $this->_load();
            } 
            else 
            {
                $this->mode_dsc = $this->mode_adsc[$this->mode];
            }
        } 
        else 
        {
            $this->_loadPostData();
            if (!$this->hasErrors) 
            {
                switch ($this->mode)
                {
                    case "INS":

                        $inserto = false;

                        if (\Dao\Mnt\Productos::insert($this->ProdNombre, $this->ProdDescripcion, $this->ProdPrecioVenta, $this->ProdPrecioCompra, $this->ProdEst, $this->ProdStock)) 
                        {
    
                            foreach ($this->Media['name'] as $item => $name)
                            {
                                
                                if ( !empty($this->Media['name'][$item]) )
                                {
                                    if (\Dao\Mnt\Media::insert($this->Media['name'][$item], $this->MediaPath.$this->Media['name'][$item]))
                                    {
                                        move_uploaded_file($this->Media['tmp_name'][$item],$this->MediaPath.$this->Media['name'][$item]);
                                        $inserto = true;
                                    }
                                }
                                else
                                {
                                    if (\Dao\Mnt\Media::insert("producto_default.jpg", "public/img/producto_default.jpg"))
                                    {
                                        
                                        \Utilities\Site::redirectToWithMsg(
                                            "index.php?page=admin_productos",
                                            "¡Producto Agregado Satisfactoriamente!"
                                        );
                                    }
                                }
                            }

                            if ($inserto)
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_productos",
                                    "¡Producto Agregado Satisfactoriamente!"
                                );
                            }
                            
                        }
                    break;

                    case "UPD":

                        $actualizo = false;

                        if (\Dao\Mnt\Productos::update($this->ProdNombre, $this->ProdDescripcion, $this->ProdPrecioVenta, $this->ProdPrecioCompra, $this->ProdEst, $this->ProdStock, $this->ProdId)) 
                        {

                            $_datosMedia = \Dao\Mnt\Media::getAll($this->ProdId);

                            foreach ($this->Media['name'] as $item => $name)
                            {
                                
                                if (!empty($_FILES['imagenes']['name'][$item]))
                                {
                                    foreach ($_datosMedia as $_mediaDB)
                                    {   
                                        if ($_mediaDB['MediaPath'] == "public/img/producto_default.jpg")
                                        {
                                            \Dao\Mnt\Media::delete($this->ProdId, $_mediaDB['MediaId']);
                                        }
                                        else
                                        {
                                            \Dao\Mnt\Media::delete($this->ProdId, $_mediaDB['MediaId']);
                                            @unlink("public/img/productos/".$_mediaDB['MediaDoc']);
                                        }
                                    }

                                    if ( !empty($this->Media['name'][$item]) )
                                    {
                                        if (\Dao\Mnt\Media::update($this->Media['name'][$item], $this->MediaPath.$this->Media['name'][$item], $this->ProdId))
                                        {  
                                            move_uploaded_file($this->Media['tmp_name'][$item],$this->MediaPath.$this->Media['name'][$item]);
                                            $actualizo = true;
                                        }

                                    }

                                }
                                else
                                {
                                    foreach ($_datosMedia as $_mediaDB)
                                    {   
                                        if (!empty($_mediaDB['MediaDoc']))
                                        {
                                            \Utilities\Site::redirectToWithMsg(
                                                "index.php?page=admin_productos",
                                                "¡Producto Actualizado Satisfactoriamente!"
                                            );
                                        }
                                        else
                                        {
                                            if (\Dao\Mnt\Media::update("producto_default.jpg", "public/img/producto_default.jpg", $this->ProdId))
                                            {

                                                \Utilities\Site::redirectToWithMsg(
                                                    "index.php?page=admin_productos",
                                                    "¡Producto Actualizado Satisfactoriamente!"
                                                );
                                            }
                                        }
                                    }
                                    
                                }
                            }

                            if ($actualizo)
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_productos",
                                    "¡Producto Actualizado Satisfactoriamente!"
                                );
                            }
                            
                        }                   
                    break;

                    case "DEL":

                        $elimino = false;
                        $_dataMedia = \Dao\Mnt\Media::getAll($this->ProdId);
                                                
                        if (\DAO\Mnt\Productos::delete($this->ProdId)) 
                        {
                            foreach ($_dataMedia as $_media)
                            {
                                if ($_media['MediaPath'] == "public/img/producto_default.jpg")
                                {
                                    \Dao\Mnt\Media::delete($this->ProdId, $_media['MediaId']);
                                    $elimino = true;
                                }
                                else
                                {
                                    \Dao\Mnt\Media::delete($this->ProdId, $_media['MediaId']);
                                    unlink("public/img/productos/".$_media['MediaDoc']);
                                    $elimino = true;
                                }
                            }
                            
                            if ($elimino)
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_productos",
                                    "¡Producto Eliminado Satisfactoriamente!"
                                );
                            }
                        }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("admin/producto", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Productos::getOne($this->ProdId);

        if ($_data) 
        {
            $this->ProdId = $_data["ProdId"];
            $this->ProdNombre = $_data["ProdNombre"];
            $this->ProdDescripcion = $_data["ProdDescripcion"];
            $this->ProdPrecioVenta = $_data["ProdPrecioVenta"];
            $this->ProdPrecioCompra = $_data["ProdPrecioCompra"];
            $this->ProdEst = $_data["ProdEst"];
            $this->ProdStock = $_data["ProdStock"];

            $_dataMedia = \Dao\Mnt\Media::getAll($this->ProdId);
            if ($_dataMedia){
                $this->Media = $_dataMedia;
            }
            $this->_setViewData();
        }
    
    }

    private function _loadPostData()
    {
        $this->ProdId = isset($_POST["ProdId"]) ? $_POST["ProdId"] : 0 ;
        $this->ProdNombre = isset($_POST["ProdNombre"]) ? $_POST["ProdNombre"] : "" ;
        $this->ProdDescripcion = isset($_POST["ProdDescripcion"]) ? $_POST["ProdDescripcion"] : "";
        $this->ProdPrecioVenta = isset($_POST["ProdPrecioVenta"]) ? $_POST["ProdPrecioVenta"] : 0;
        $this->ProdPrecioCompra = isset($_POST["ProdPrecioCompra"]) ? $_POST["ProdPrecioCompra"] : 0;
        $this->ProdEst = isset($_POST["ProdEst"]) ? $_POST["ProdEst"] : "";
        $this->ProdStock = isset($_POST["ProdStock"]) ? $_POST["ProdStock"] : 0;
        $this->MediaId = isset($_POST["MediaId"]) ? $_POST["MediaId"] : 0;
        
        
        if (($_FILES['imagenes']['name'] != null)) 
        {
            
            foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) 
            {
                if ( !empty($_FILES['imagenes']['name'][$key]) ) 
                {
                    $this->Media['name'][$key] = $_FILES['imagenes']['name'][$key];
                    $this->Media['tmp_name'][$key] = $_FILES['imagenes']['tmp_name'][$key];
                    $this->Media['size'][$key] = $_FILES['imagenes']['size'][$key];
                }
                else
                {
                    $this->Media['name'][$key] = "";
                    $this->Media['tmp_name'][$key] = "";
                }
            }

        }
        
        if (\Utilities\Validators::IsEmpty($this->ProdNombre)) 
        {
            $this->aErrors[] = "El nombre del producto no puede ir vacio";
        }

        if(\Utilities\Validators::IsEmpty($this->ProdDescripcion))
        {
            $this->aErrors[] = "La descripción del producto no puede ir vacia";
        }

        if(!(\Utilities\Validators::ValidarDinero($this->ProdPrecioVenta)) || $this->ProdPrecioVenta<=0)
        {
            $this->aErrors[] = "El precio de venta no es válido.";
        }

        if(!(\Utilities\Validators::ValidarDinero($this->ProdPrecioCompra)) || $this->ProdPrecioCompra<=0)
        {
            $this->aErrors[] = "El precio de compra no es válido.";
        }

        if(!(\Utilities\Validators::ValidarNumeros($this->ProdStock)) || $this->ProdPrecioCompra<=0)
        {
            $this->aErrors[] = "El stock no es válido.";
        }

        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->ProdEst_ACT = ($this->ProdEst === "ACT") ? "selected" : "";
        $this->ProdEst_INA = ($this->ProdEst === "INA") ? "selected" : "";

        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->ProdId,
            $this->ProdNombre
        );

        $this->notDisplayIns = ($this->mode=="INS") ? false : true;
        $this->notDisplayDel = ($this->mode=="DEL") ? false : true;
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>