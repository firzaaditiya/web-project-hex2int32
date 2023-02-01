<?php

namespace Z44\Hex2int;

use PHPUnit\Framework\{TestCase, Assert};

use Z44\Hex2int\Controller\ConvertController;

class ConvertControllerTest extends TestCase
{
    private ConvertController $convertController;

    protected function setUp() : void
    {
        $this->convertController = new ConvertController();
    }

    /**
     * @test
     */
    public function postConvert() : void
    {
        $_POST["hexstring"] = "0000000A";

        $this->convertController->postConvert();

        $this->expectOutputRegex("[Hex to Integer]");
        $this->expectOutputRegex("[10]");
        $this->expectOutputRegex("[167772160]");
        $this->expectOutputRegex("[2560]");
        $this->expectOutputRegex("[655360]");
    }

    /**
     * @test
     */
    public function postConvertInvalidHex() : void
    {
        $_POST["hexstring"] = "0000000X";

        $this->convertController->postConvert();

        $this->expectOutputRegex("[Hex to Integer]");
        $this->expectOutputRegex("[Error with input string. Check to ensure that the input contains valid hex characters.]");
    }

    /**
     * @test
     */
    public function postConvertEmptyHex() : void
    {
        $_POST["hexstring"] = "                      ";

        $this->convertController->postConvert();

        $this->expectOutputRegex("[Hex to Integer]");
        $this->expectOutputRegex("[Error. Hex code cannot be empty]");
    }
}