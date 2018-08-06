<?php
namespace FuriosoJack\Kaseravel\Tests;
use FuriosoJack\Kaseravel\Core\HTTP\Auth\Credentials;
use FuriosoJack\Kaseravel\Core\HTTP\ClientApi;

/**
 * Class AuthTest
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class AuthTest extends TestCase
{

    /**
     * Disabled test
     * @test
     */
    public function authBasic()
    {
        $clientAPi = new Auth("saas19.pccor.net","user",'passs');
        $this->response =  $clientAPi->get('/system/users');

        $this->assertResponseStatus(0);

        $userID = "74893716";
        $this->response =  $clientAPi->get('/system/users/'.$userID);

        $this->assertResponseStatus(0);


        $this->response = $clientAPi->get('/assetmgmt/agents');
        $this->assertResponseStatus(0);


        $url = '/system/users/' . $userID . '/disabled';
        $response = $clientAPi->put($url);
        dd($response);


    }


}