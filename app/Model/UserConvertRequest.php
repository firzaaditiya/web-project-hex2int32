<?php

namespace Z44\Hex2int\Model;

class UserConvertRequest
{
    private string $hexadecimalString;

    public function getHexcode() : string
    {
        return $this->hexadecimalString;
    }

    public function setHexcode(string $hexadecimalString) : void
    {
        $this->hexadecimalString = $hexadecimalString;
    }
}