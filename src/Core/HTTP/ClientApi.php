<?php


namespace FuriosoJack\Kaseravel\Core\HTTP;
use FuriosoJack\Kaseravel\Core\HTTP\Auth\Auth;

/**
 * Class ClientApi
 * @package FuriosoJack\Kaseravel\Core\HTTP\Request
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class ClientApi
{
    const API_BASE_PATH = "/api/v1.0/";

    private $restClient;

    private $host;



    public function __construct(string $host)
    {
        $this->host = $host;
        $this->createRestClient();

    }

    private function createRestClient()
    {
        $this->restClient = new \RestClient($this->getOptionsRestClient());
    }

    private function getRestClient(): \RestClient
    {
        return $this->restClient;
    }

    private function getUrl()
    {
        return 'https://'. $this->host . self::API_BASE_PATH;
    }

    public function execute(string $url, array $parameters = [], array $headers = []):Response
    {
        $responseRAW = $this->getRestClient()->get($url,$parameters,$headers)->response;
        return new Response($responseRAW);
    }


    private function getOptionsRestClient():array
    {
        return [
           'base_url' => $this->getUrl(),
           'curl_options' => [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
           ]
        ];

    }



}