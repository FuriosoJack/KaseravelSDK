<?php


namespace FuriosoJack\Kaseravel\Core\HTTP;

/**
 * Class Response
 * @package FuriosoJack\Kaseravel\Core\HTTP
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class Response
{


    private $responseRAW;

    private $responseJsonObject;

    private $result;
    private $erorr;
    private $status;
    private $code;

    public function __construct($response)
    {
        $this->responseRAW = $response;
        $this->processResponse();

    }

    private function processResponse()
    {
        $this->responseJsonObject = json_decode($this->responseRAW);
        
        if($this->responseJsonObject->Error != "None"){
            $this->erorr = $this->responseJsonObject->Error;
        }else{
            $this->result = $this->responseJsonObject->Result;
        }

        $this->code = $this->responseJsonObject->ResponseCode;
        $this->status = $this->responseJsonObject->Status;
    }

    public function getError()
    {
        return $this->erorr;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function existError():bool
    {
        return !is_null($this->erorr);
    }




}