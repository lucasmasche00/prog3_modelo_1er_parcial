<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'clase/token.php';

$method = $_SERVER['REQUEST_METHOD'] ?? '';

switch ($method) {
    case 'POST':
        $legajo = $_POST['legajo'] ?? 0;
        $password = $_POST['password'] ?? '';//'martillo';
        $rol = 'admin';//traer rol
        $passwordGuardada = 'martillo';//traer el hash de la password (es un hash no la password en si)
        if(is_numeric($legajo) && $legajo > 0 && $password === $passwordGuardada)
        {
            $jwt = Token::CrearToken($legajo, $rol);
            echo $jwt;
        }
        else
        {
            echo "Legajo y/o password incorrecto/s";
        }
        break;
    
    default:
        echo 'Metodo HTTP no valido';
        break;
}
?>