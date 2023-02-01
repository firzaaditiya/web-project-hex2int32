<?php

namespace Z44\Hex2int\App;

use Z44\Hex2int\Model\{UserConvertRequest, UserConvertResponse};
use Z44\Hex2int\Exception\InvalidHex;

class HexConverter
{
    const BIG_ENDIAN = "BIG_ENDIAN";
    const LITTLE_ENDIAN = "LITTLE_ENDIAN";
    const MID_BIG_ENDIAN = "MID_BIG_ENDIAN";
    const MID_LITTLE_ENDIAN = "MID_LITTLE_ENDIAN";

    const BINARY = 2;
    const HEXADECIMAL = 16;
    const VALID_HEX = 8;

    private array $hexlist = array();

    public function getHexlist() : array
    {
        return $this->hexlist;
    }

    public function setHexlist(UserConvertRequest $request) : void
    {
        $this->validateStringHex(request: $request);
        
        $this->bindHex(request: $request);
    }

    public function hex2int32(UserConvertRequest $request) : UserConvertResponse
    {
        $result = array();
        $this->validateStringHex(request: $request);

        $this->bindHex(request: $request);

        // Big Endian
        $bindata = hex2bin($this->hexlist[self::BIG_ENDIAN]);
        $temp_result = (unpack("i", $bindata));
        $result[self::BIG_ENDIAN] = $temp_result[1];

        // Little Endian
        $bindata = hex2bin($this->hexlist[self::LITTLE_ENDIAN]);
        $temp_result = (unpack("i", $bindata));
        $result[self::LITTLE_ENDIAN] = $temp_result[1];

        // Mid-Big Endian
        $bindata = hex2bin($this->hexlist[self::MID_BIG_ENDIAN]);
        $temp_result = (unpack("i", $bindata));
        $result[self::MID_BIG_ENDIAN] = $temp_result[1];

        // Mid-Little Endian
        $bindata = hex2bin($this->hexlist[self::MID_LITTLE_ENDIAN]);
        $temp_result = (unpack("i", $bindata));
        $result[self::MID_LITTLE_ENDIAN] = $temp_result[1];
        
        $response = new UserConvertResponse();
        $response->setResult($result);
        return $response;
    }

    public function hex2uint32(UserConvertRequest $request) : UserConvertResponse
    {
        $result = array();
        $this->validateStringHex(request: $request);

        $this->bindHex(request: $request);

        // Big Endian
        $bindata = hex2bin($this->hexlist[self::BIG_ENDIAN]);
        $temp_result = (unpack("I", $bindata));
        $result[self::BIG_ENDIAN] = $temp_result[1];

        // Little Endian
        $bindata = hex2bin($this->hexlist[self::LITTLE_ENDIAN]);
        $temp_result = (unpack("I", $bindata));
        $result[self::LITTLE_ENDIAN] = $temp_result[1];

        // Mid-Big Endian
        $bindata = hex2bin($this->hexlist[self::MID_BIG_ENDIAN]);
        $temp_result = (unpack("I", $bindata));
        $result[self::MID_BIG_ENDIAN] = $temp_result[1];

        // Mid-Little Endian
        $bindata = hex2bin($this->hexlist[self::MID_LITTLE_ENDIAN]);
        $temp_result = (unpack("I", $bindata));
        $result[self::MID_LITTLE_ENDIAN] = $temp_result[1];
        
        $response = new UserConvertResponse();
        $response->setResult($result);
        return $response;
    }

    public function validateStringHex(UserConvertRequest $request) : void
    {
        $hexcode = str_replace(" ", "", $request->getHexcode());

        if ($hexcode == "" || $hexcode == " " || $hexcode == null) {
            throw new InvalidHex(message: "Error. Hex code cannot be empty");
        } else if (strlen($hexcode) > self::VALID_HEX) {
            throw new InvalidHex(message: "Sorry. please re-enter the hex code. make sure the length of the hex code does not exceed 8 characters");
        }

        for ($i = 0; $i < strlen($hexcode); $i++) {
            if ((bool)preg_match_all("/0|1|2|3|4|5|6|7|8|9|a|b|c|d|e|f/i", $hexcode[$i]) == false) {
                throw new InvalidHex(message: "Error with input string. Check to ensure that the input contains valid hex characters.");
            }
        }
    }

    private function bindHex(UserConvertRequest $request) : void
    {
        $hexcode = $request->getHexcode();

        // Big Endian
        $temporary = $hexcode[6].$hexcode[7].$hexcode[4].$hexcode[5].$hexcode[2].$hexcode[3].$hexcode[0].$hexcode[1];
        $this->hexlist[self::BIG_ENDIAN] = $temporary;

        // Little Endian
        $temporary = $hexcode[0].$hexcode[1].$hexcode[2].$hexcode[3].$hexcode[4].$hexcode[5].$hexcode[6].$hexcode[7];
        $this->hexlist[self::LITTLE_ENDIAN] = $temporary;

        // Mid-Big Endian
        $temporary = $hexcode[4].$hexcode[5].$hexcode[6].$hexcode[7].$hexcode[0].$hexcode[1].$hexcode[2].$hexcode[3];
        $this->hexlist[self::MID_BIG_ENDIAN] = $temporary;

        // Mid-Little Endian
        $temporary = $hexcode[2].$hexcode[3].$hexcode[0].$hexcode[1].$hexcode[6].$hexcode[7].$hexcode[4].$hexcode[5];
        $this->hexlist[self::MID_LITTLE_ENDIAN] = $temporary;
    }
}