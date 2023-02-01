<?php

namespace Z44\Hex2int;

use PHPUnit\Framework\TestCase;
use Z44\Hex2int\Controller\HomeController;

class HomeControllerTest extends TestCase
{
    private HomeController $homeController;

    protected function setUp() : void
    {
        $this->homeController = new HomeController();
    }

    /**
     * @test
     */
    public function index() : void
    {
        $this->homeController->index();

        $this->expectOutputRegex("[Hex to Integer]");
    }
}