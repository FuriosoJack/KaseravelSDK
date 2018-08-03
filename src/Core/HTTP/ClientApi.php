<?php


namespace FuriosoJack\Kaseravel\Core\HTTP;

/**
 * Class ClientApi
 * @package FuriosoJack\Kaseravel\Core\HTTP\Request
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class ClientApi
{
    const API_BASE_PATH = "/api/v1.0/";

    private $restClient;

    public function __construct(string $host, string $user, string $password)
    {
        $this->createRestClient($host,$user,$password);

    }

    private function createRestClient(string $host, string $user, string $password)
    {
        $url = 'https://'. $host . self::API_BASE_PATH;
        $this->restClient = new \RestClient([
            'base_url' => $url
        ]);

    }

    private function getUrl()
    {

    }

    public function execute(string $host, string $path, array $parameters = [], array $headers = []): Response
    {

    }



    private function getOptionsRestClient()
    {

    }



}