<?php
namespace FuriosoJack\Kaseravel\Core\HTTP\Auth;
/**
 * Class Credentials
 * @author Juan Diaz - FuriosoJack <iam@furiosojack.com>
 */
class Credentials
{
    private $user;
    private $password;
    private $hash;
    public function __construct(string $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
        $this->buildHash();
    }

    /**
     * Se encarga de constuir el hash
     */
    private function buildHash()
    {
        $random = (int)helperman_random_string(10,'1234567890');

        $RawSHA256Hash = hash('sha256',$this->password);

        $CoveredSHA256HashTemp = hash('sha256',$this->password.$this->user);

        $CoveredSHA256Hash = hash('sha256',$CoveredSHA256HashTemp.$random);

        $RawSHA1Hash = hash('sha1',$this->password);

        $CoveredSHA1HashTemp = hash('sha1',$this->password.$this->user);

        $CoveredSHA1Hash = hash('sha1',$CoveredSHA1HashTemp.$random);

        $data = "user=" . $this->user . ",pass2=" . $CoveredSHA256Hash . ",pass1=" . $CoveredSHA1Hash . ",rpass2=" . $RawSHA256Hash . ",rpass1=" . $RawSHA1Hash . ",rand2=" . $random;

        $this->hash = base64_encode($data);
    }

    public function getHash():string
    {
        return $this->hash;

    }


}