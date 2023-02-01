<?php

namespace Z44\Hex2int\App;

class Router
{
    static private array $routes;

    static public function add(
        string $method,
        string $path,
        string $controller,
        string $function,
        array $middleware = []) : void
    {
        self::$routes[] = array(
            "method" => $method,
            "path" => $path,
            "controller" => $controller,
            "function" => $function,
            "middleware" => $middleware
        );
    }

    static public function run() : void
    {
        // default path
        $path = "/";

        // check if path is exist
        if (isset($_SERVER["PATH_INFO"])) {
            $path = $_SERVER["PATH_INFO"];
        }

        // get type method
        $method = $_SERVER["REQUEST_METHOD"];

        foreach(self::$routes as $route) {
            if ($path == $route["path"] && $method == $route["method"]) {
                foreach($route["middleware"] as $middleware) {
                    $instance_middleware_class = new $middleware;
                    $instance_middleware_class->before();
                }

                $controller_class = $route["controller"];
                $function = $route["function"];

                $controller = new $controller_class();
                $controller->$function();

                return;
            }
        }

        // if put the non valid url, will going to home page
        View::redirect("/");
    }
}