<?php
require_once __DIR__ . '/asignacion.php';
require_once __DIR__ . '/jSend.php';
class AsignacionApi
{
    const RECURSO_ASIGNACION = 'asignacion';
    const DIR_ASIGNACION_JSON = __DIR__ . '/../archivo/materias-profesores.txt';
    
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
                $id = $_POST['id'] ?? '';
                $turno = $_POST['turno'] ?? '';
                
                if($id !== '' && $turno != '')
                {
                    if($turno === 'manana' || $turno === 'noche')
                    {
                        $lista = Archivo::TraerTodosObjetosDeJson(self::DIR_ASIGNACION_JSON);
        
                        $asignacion = new Asignacion($legajo, $id, $turno);
                        
                        if(!Asignacion::IsInList($lista, $asignacion))
                        {
                            Archivo::GuardarObjetoJson(self::DIR_ASIGNACION_JSON, $asignacion);
                            
                            $jSend->status = 'success';
                            $jSend->data->mensajeExito = 'Guardado exitoso';
                        }
                        else
                        {
                            $jSend->message = 'Asignacion repetida';
                        }
                    }
                    else
                    {
                        $jSend->message = 'Turno manana o noche';
                    }
                }
                else
                {
                    $jSend->message = 'Todos los campos son obligatorios';
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

            $jSend->data->asignacions = Archivo::TraerTodosObjetosDeJson(self::DIR_ASIGNACION_JSON);
            
            $jSend->status = 'success';
        }
        catch (\Throwable $th)
        {
            $jSend->message = 'Token invalido';
        }
        return json_encode($jSend);
    }

    public static function ListarUno($parametro)
    {
        $jSend = new JSend('error');
        
        $token = $_SERVER['HTTP_TOKEN'] ?? '';
        try
        {
            $usuarioLogeado = Token::DecodificarToken($token);

            $legajo = $parametro ?? 0;
            if(is_numeric($legajo) && $legajo > 0)
            {
                $lista = Archivo::TraerTodosObjetosDeJson(self::DIR_ASIGNACION_JSON);

                if(count($lista) > 0)
                {
                    $asignacion = Asignacion::FindById($lista, $legajo);
                    if($asignacion === false)
                    {
                        $jSend->message = 'No existe ese legajo';
                    }
                    else
                    {
                        $jSend->status = 'success';
                        $jSend->data->asignacion = $asignacion;
                    }
                }
                else
                {
                    $jSend->message = 'No hay datos cargados';
                }
            }
            else
            {
                $jSend->message = 'Direccion erronea';
            }
        }
        catch (\Throwable $th)
        {
            $jSend->message = 'Token invalido';
        }
        return json_encode($jSend);
    }
}
?>