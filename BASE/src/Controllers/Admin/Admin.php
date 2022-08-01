<?php

/**
 * PHP Version 7.2
 *
 * @category Private
 * @package  Controllers
 * @author   Grupo 1
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers\Admin;

/**
 * Página Principal de Administradores
 *
 * @category Public
 * @package  Controllers/Admin
 * @author   Grupo 1
 * @license  MIT http://
 * @link     http://
 */
class Admin extends \Controllers\PrivateController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // $userInRole = \Utilities\Security::isInRol(
        //     \Utilities\Security::getUserId(),
        //     "ADMIN"
        // );
        parent::__construct();
    }
    /** 
     * Ejecuta el controlador
     */
    public function run() :void
    {
        \Views\Renderer::render("admin/admin", array());
    }
}
?>
