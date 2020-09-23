<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/clase/token.php';
require_once __DIR__ . '/clase/jSend.php';
require_once __DIR__ . '/clase/archivo.php';
require_once __DIR__ . '/clase/userApi.php';
require_once __DIR__ . '/clase/loginApi.php';
require_once __DIR__ . '/clase/materiaApi.php';
require_once __DIR__ . '/clase/profesorApi.php';
require_once __DIR__ . '/clase/asignacionApi.php';

$path = $_SERVER['PATH_INFO'] ?? '';
$method = $_SERVER['REQUEST_METHOD'] ?? '';
$recurso = explode('/', $path)[1] ?? '';
$parametro = explode('/', $path)[2] ?? '';
$jSend = new JSend('error');

switch ($recurso)
{
    case UserApi::RECURSO_USER:
        switch ($method)
        {
            case 'POST':
                if($parametro === '')
                {
                    $respuesta = UserApi::Alta();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->mensajeExito = $stdJSend->data->mensajeExito;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            default:
                $jSend->message = 'Metodo HTTP no valido';
                break;
        }
        break;
    case LoginApi::RECURSO_LOGIN:
        switch ($method) {
            case 'POST':
                if($parametro === '')
                {
                    $respuesta = LoginApi::GenerarToken();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->token = $stdJSend->data->token;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            default:
                $jSend->message = 'Metodo HTTP no valido';
                break;
        }
        break;
    case MateriaApi::RECURSO_MATERIA:
        switch ($method) {
            case 'GET':
                if($parametro === '')
                {
                    $respuesta = MateriaApi::ListarTodo();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->materias = $stdJSend->data->materias;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            case 'POST':
                if($parametro === '')
                {
                    $respuesta = MateriaApi::Alta();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->mensajeExito = $stdJSend->data->mensajeExito;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            default:
                $jSend->message = 'Metodo HTTP no valido';
                break;
        }
        break;
    case ProfesorApi::RECURSO_PROFESOR:
        switch ($method) {
            case 'GET':
                if($parametro === '')
                {
                    $respuesta = ProfesorApi::ListarTodo();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->profesores = $stdJSend->data->profesores;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            case 'POST':
                if($parametro === '')
                {
                    $respuesta = ProfesorApi::Alta();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->mensajeExito = $stdJSend->data->mensajeExito;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            default:
                $jSend->message = 'Metodo HTTP no valido';
                break;
        }
        break;
    case AsignacionApi::RECURSO_ASIGNACION:
        switch ($method) {
            case 'GET':
                if($parametro === '')
                {
                    $respuesta = AsignacionApi::ListarTodo();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->profesores = $stdJSend->data->profesores;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            case 'POST':
                if($parametro === '')
                {
                    $respuesta = AsignacionApi::Alta();
                    $stdJSend = json_decode($respuesta);
                    switch ($stdJSend->status)
                    {
                        case 'success':
                            $jSend->status = 'success';
                            $jSend->data->mensajeExito = $stdJSend->data->mensajeExito;
                            break;
                        case 'error':
                            $jSend->message = $stdJSend->message;
                            break;
                        default:
                            $jSend->message = 'Error de envio';
                            break;
                    }
                }
                else
                {
                    $jSend->message = 'Direccion erronea';
                }
                break;
            default:
                $jSend->message = 'Metodo HTTP no valido';
                break;
        }
        break;
    default:
        $jSend->message = 'Direccion erronea';
        break;
}
echo json_encode($jSend);
?>