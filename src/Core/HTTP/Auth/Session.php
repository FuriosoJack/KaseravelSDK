<?php
namespace FuriosoJack\Kaseravel\Core\HTTP\Auth;
use Carbon\Carbon;
use FuriosoJack\Kaseravel\Core\HTTP\Response;

/**
 * Class Session
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class Session
{

    private $result;

    const KEY_SESSION = 'kaseravel';

    public function __construct()
    {

    }


    /**
     * Obteiene el array de la session con su key
     * @return array
     */
    public function getKeyInSession():array
    {
        $keyInSession = session()->get(self::KEY_SESSION);
        return reset($keyInSession);
    }

    /**
     * Se encarga de validar si la session ya expiro
     * @return bool
     */
    private function validateIfExpire():bool
    {
        $sessionExpire = $this->getKeyInSession()['SessionExpiration'];
        $dateNow = Carbon::parse($sessionExpire);
        //Si es menor igual que la fecha de expiracion
        return $dateNow->lte($sessionExpire);

    }

    /**
     * Verifica si existe el key
     * @return bool
     */
    private function existKey():bool
    {
        $hasExist = session()->has(self::KEY_SESSION);
        return $hasExist;
    }

    /**
     * Valida si existe la clave de la sesion y si no ha exipirado
     * @return bool
     */
    public function valid():bool
    {
        return $this->existKey() && $this->validateIfExpire();
    }


    /**
     * Se encarga de crear
     * @param Response $response
     */
    public function generate(Response $response)
    {
        if(!$this->valid()){
            //Solo se genera si la sesion actual no funciona
            $this->result = $response->getResult();
            session()->push(self::KEY_SESSION,[
                'Token' => $this->result->Token,
                'SessionExpiration' => $this->result->SessionExpiration
            ]);
        }
    }

    /**
     * @return mixed
     */
    public function getToken():string
    {
        return $this->getKeyInSession()['Token'];
    }




}