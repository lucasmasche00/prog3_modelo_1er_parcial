<?php
require_once __DIR__ . '/jSend.php';
require_once __DIR__ . '/userApi.php';
class LoginApi
{
    const RECURSO_LOGIN = 'login';
    const DIR_USER_JSON = __DIR__ . '/../archivo/users.txt';
    
    public static function GenerarToken()
    {
        $jSend = new JSend('error');
        $email = $_POST['email'] ?? '';
        $clave = $_POST['clave'] ?? '';
        $lista = Archivo::TraerTodosObjetosDeJson(self::DIR_USER_JSON);
        foreach ($lista as $value)
        {
            if($value->email === $email && $value->clave === sha1($clave))
            {
                $jwt = Token::CrearToken($email);
                $jSend->status = 'success';
                $jSend->data->token = $jwt;
                return json_encode($jSend);
            }
        }
        $jSend->message = 'Email y/o clave incorrecto/s';
        return json_encode($jSend);
    }
}
?>