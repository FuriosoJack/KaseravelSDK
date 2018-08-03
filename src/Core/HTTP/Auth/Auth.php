<?php
namespace FuriosoJack\Kaseravel\Core\HTTP\Auth;
/**
 * Class AuthClient
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class Auth
{
    private $session;
    private $credentials;


    public function __construct(string $user, string $password)
    {
        $this->session = new Credentials($user,$password);




    }

}