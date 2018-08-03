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
     * @test
     */
    public function authBasic()
    {
        $clientAPi = new ClientApi("saas19.pccor.net");
        dd($clientAPi->execute('auth')->existError());


    }


}