<?php

namespace Z44\Hex2int\Controller;

use Z44\Hex2int\App\View;

class HomeController
{
    public function index() : void
    {
        View::render("Home/index", array(
            "title" => "Hex to Integer 32 Bit"
        ));
    }
}