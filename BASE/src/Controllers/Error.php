<?php

namespace Controllers;

class Error extends PublicController
{
    public function run() :void
    {
        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        http_response_code(400);
        \Views\Renderer::render(
            "error",
            array("page_title"=>"¡No se encuentra el recurso solicitado!"),
            $layout
        );
    }
}


?>
