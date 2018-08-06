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
    private $clientApiResponse;

    private $responseJsonObject;

    private $result;
    private $erorr;
    private $status;
    private $code;

    public function __construct(ClientApi $response)
    {
        $this->clientApiResponse = $response;

        $this->processResponse();

    }

    private function processResponse()
    {
        if($this->clientApiResponse->error != ""){
            $error = $this->clientApiResponse->error;
            throw new \Exception($error);
        }

        if($this->clientApiResponse->response === FALSE){
            $responseLine = $this->clientApiResponse->response_status_lines;
            $responseLine = implode($responseLine);
            throw new \Exception($responseLine);
        }

        $this->responseJsonObject = json_decode($this->clientApiResponse->response);

            //Se valida si existe algun error
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

    public function getStatusCode()
    {
        return $this->code;
    }




}