<?php

namespace Z44\Hex2int;

use PHPUnit\Framework\{TestCase, Assert};
use Z44\Hex2int\App\HexConverter;
use Z44\Hex2int\Exception\InvalidHex;
use Z44\Hex2int\Model\{UserConvertRequest, UserConvertResponse};

class HexConverterTest extends TestCase
{
    /**
     * @test
     */
    public function validateStringHexIsValid() : void
    {   
        $_POST["hexstring"] = "0100A0E3";

        $request = new UserConvertRequest();
        $request->setHexcode($_POST["hexstring"]);

        $hexConverter = new HexConverter();
        $hexConverter->setHexlist($request);
        $hexlist = $hexConverter->getHexlist();

        // Big Endian
        Assert::assertEquals("E3A00001", $hexlist["BIG_ENDIAN"]);

        // Little Endian
        Assert::assertEquals("0100A0E3", $hexlist["LITTLE_ENDIAN"]);

        // Mid-Big Endian
        Assert::assertEquals("A0E30100", $hexlist["MID_BIG_ENDIAN"]);

        // Mid-Little Endian
        Assert::assertEquals("0001E3A0", $hexlist["MID_LITTLE_ENDIAN"]);
    }

    /**
     * @test
     */
    public function validateStringHexIsInValid() : void
    {
        $this->expectException(InvalidHex::class);

        $_POST["hexstring"] = "0100A0EX";

        $request = new UserConvertRequest();
        $request->setHexcode($_POST["hexstring"]);

        $hexConverter = new HexConverter();
        $hexConverter->setHexlist($request);
    }

    /**
     * @test
     */
    public function validateStringHexIsEmpty() : void
    {
        $this->expectException(InvalidHex::class);

        $_POST["hexstring"] = "                   ";

        $request = new UserConvertRequest();
        $request->setHexcode($_POST["hexstring"]);

        $hexConverter = new HexConverter();
        $hexConverter->setHexlist($request);
    }

    /**
     * @test
     */
    public function hex2int32() : void
    {
        /*
            INT32 Big Endian : 16818403
            INT32 Little Endian : -476053503
            INT32 Mid-Big Endian : 123808
            INT32 Mid-Little Endian : -1595735808
        */

        $_POST["hexstring"] = "0100A0E3";

        $request = new UserConvertRequest();
        $request->setHexcode($_POST["hexstring"]);

        $hexConverter = new HexConverter();
        $response = $hexConverter->hex2int32($request);
        $result = $response->getResult();

        // Big Endian
        Assert::assertEquals(16818403, $result["BIG_ENDIAN"]);

        // Little Endian
        Assert::assertEquals(-476053503, $result["LITTLE_ENDIAN"]);

        // Mid-Big Endian
        Assert::assertEquals(123808, $result["MID_BIG_ENDIAN"]);

        // Mid-Little Endian
        Assert::assertEquals(-1595735808, $result["MID_LITTLE_ENDIAN"]);
    }

    /**
     * @test
     */
    public function hex2uint() : void
    {
        /*
            UINT32 Big Endian : 16818403
            UINT32 Little Endian : 3818913793
            UINT32 Mid-Big Endian : 123808
            UINT32 Mid-Little Endian : 2699231488
        */

        $_POST["hexstring"] = "0100A0E3";

        $request = new UserConvertRequest();
        $request->setHexcode($_POST["hexstring"]);

        $hexConverter = new HexConverter();
        $response = $hexConverter->hex2uint32($request);
        $result = $response->getResult();

        // Big Endian
        Assert::assertEquals(16818403, $result["BIG_ENDIAN"]);

        // Little Endian
        Assert::assertEquals(3818913793, $result["LITTLE_ENDIAN"]);

        // Mid-Big Endian
        Assert::assertEquals(123808, $result["MID_BIG_ENDIAN"]);

        // Mid-Little Endian
        Assert::assertEquals(2699231488, $result["MID_LITTLE_ENDIAN"]);
    }
}