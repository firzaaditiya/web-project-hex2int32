<?php

namespace Z44\Hex2int\App;

class View
{
    static public function render(string $view, mixed $model) : void
    {
        require __DIR__ . "/../View/" . $view . ".php";
    }

    static public function redirect(string $url) : void
    {
        header("Location: $url");
    }
}