<?php
require_once __DIR__ . '/profesor.php';
require_once __DIR__ . '/jSend.php';
class ProfesorApi
{
    const RECURSO_PROFESOR = 'profesor';
    const DIR_PROFESOR_JSON = __DIR__ . '/../archivo/profesores.txt';
    
    public static function Alta()
    {
        $jSend = new JSend('error');
        $legajo = $_POST['legajo'] ?? 0;
        $token = $_SERVER['HTTP_TOKEN'] ?? '';
        try
        {
            $usuarioLogeado = Token::DecodificarToken($token);
            if(is_numeric($legajo) && $legajo > 0)
            {
                $nombre = $_POST['nombre'] ?? '';
                
                $lista = Archivo::TraerTodosObjetosDeJson(self::DIR_PROFESOR_JSON);

                if(!Profesor::IsInList($lista, $legajo))
                {
                    $profesor = new Profesor($legajo, $nombre);
                    
                    Archivo::GuardarObjetoJson(self::DIR_PROFESOR_JSON, $profesor);
                    
                    $jSend->status = 'success';
                    $jSend->data->mensajeExito = 'Guardado exitoso';
                }
                else
                {
                    $jSend->message = 'Legajo repetido';
                }
            }
            else
            {
                $jSend->message = 'Legajo valido requerido';
            }
        }
        catch (\Throwable $th)
        {
            $jSend->message = 'Token invalido';
        }
        return json_encode($jSend);
    }

    public static function ListarTodo()
    {
        $jSend = new JSend('error');
        $token = $_SERVER['HTTP_TOKEN'] ?? '';
        try
        {
            $usuarioLogeado = Token::DecodificarToken($token);

            $jSend->data->profesores = Archivo::TraerTodosObjetosDeJson(self::DIR_PROFESOR_JSON);
            
            $jSend->status = 'success';
        }
        catch (\Throwable $th)
        {
            $jSend->message = 'Token invalido';
        }
        return json_encode($jSend);
    }
}
?>