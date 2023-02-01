<?php

namespace Z44\Hex2int\Model;

class UserConvertResponse
{
    private array $result = array();

    public function getResult() : array
    {
        return $this->result;
    }

    public function setResult(array $result) : void
    {
        $this->result = $result;
    }
}