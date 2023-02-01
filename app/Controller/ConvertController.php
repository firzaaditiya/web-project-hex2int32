<?php

namespace Z44\Hex2int\Controller;

use Z44\Hex2int\Model\{UserConvertRequest, UserConvertResponse};
use Z44\Hex2int\App\{HexConverter, View};
use Z44\Hex2int\Exception\InvalidHex;

class ConvertController
{
    private UserConvertRequest $request;
    private UserConvertResponse $response;
    private HexConverter $hexConverter;

    const VALID_HEX = 8;
    const ZERO_HEX = "0";

    public function __construct()
    {
        $this->request = new UserConvertRequest();
        $this->response = new UserConvertResponse();
        $this->hexConverter = new HexConverter();
    }

    public function postConvert() : void
    {
        try {
            $hexcode = str_replace(" ", "", $_POST["hexstring"]);

            if ($hexcode == "" || $hexcode == " " || $hexcode == null) {
                throw new InvalidHex(message: "Error. Hex code cannot be empty");
            }

            if (strlen($hexcode) < self::VALID_HEX) {
                $temp = null;

                for ($i = strlen($hexcode); $i < self::VALID_HEX; $i++) {
                    $temp .= self::ZERO_HEX;
                }

                $hexcode = $temp . $hexcode;
            }

            $this->request->setHexcode(hexadecimalString: $hexcode);
        
            $this->hexConverter->validateStringHex(request: $this->request);

            $responseInt32 = $this->hexConverter->hex2int32(request: $this->request);
            $responseUint32 = $this->hexConverter->hex2uint32(request: $this->request);

            View::render(view: "Home/index", model: array(
                "title" => "Hex to Integer",
                "INT32" => $responseInt32->getResult(),
                "UINT32" => $responseUint32->getResult()
            ));
        } catch(InvalidHex $exception) {
            View::render(view: "Home/index", model: array(
                "title" => "Hex to Integer",
                "error" => $exception->getMessage()
            ));
        }
    }
}