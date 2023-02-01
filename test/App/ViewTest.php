<?php

namespace Z44\Hex2int;

use PHPUnit\Framework\TestCase;
use Z44\Hex2int\App\View;

require_once __DIR__ . "/../Helper/Helper.php";

class ViewTest extends TestCase
{
    /**
     * @test
     */
    public function render() : void
    {
        View::render(view: "Home/index", model: array(
            "title" => "Hex to Interger"
        ));

        $this->expectOutputRegex("[Hex to Interger]");
        $this->expectOutputRegex("[You can convert hexadecimal to integer 32 and unsigned integer 32]");
        $this->expectOutputRegex("[uint32 Big Endian]");
        $this->expectOutputRegex("[uint32 Little Endian]");
        $this->expectOutputRegex("[uint32 Mid-Big Endian]");
        $this->expectOutputRegex("[uint32 Mid-Little Endian]");
        $this->expectOutputRegex("[int32 Big Endian]");
        $this->expectOutputRegex("[int32 Little Endian]");
        $this->expectOutputRegex("[int32 Mid-Big Endian]");
        $this->expectOutputRegex("[int32 Mid-Little Endian]");
    }

    /**
     * @test
     */
    public function redirect() : void
    {
        View::redirect(url: "/");

        $this->expectOutputRegex("[Location: /]");
    }
}