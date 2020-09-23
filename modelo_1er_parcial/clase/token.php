<?php
use \Firebase\JWT\JWT;
class Token
{
    private static $llave = 'pro3-parcial';

    public static function CrearToken($id)
    {
        $key = self::$llave;
        $payload = array(
            "id" => $id
        );
        
        return JWT::encode($payload, $key);
    }

    public static function DecodificarToken($jwt)
    {
        return JWT::decode($jwt, self::$llave, array('HS256'));
    }
}
?>