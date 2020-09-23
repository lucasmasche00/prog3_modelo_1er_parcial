<?php
require_once __DIR__ . '/materia.php';
require_once __DIR__ . '/jSend.php';
class MateriaApi
{
    const RECURSO_MATERIA = 'materia';
    const DIR_MATERIA_JSON = __DIR__ . '/../archivo/materias.txt';
    
    public static function Alta()
    {
        $jSend = new JSend('error');
        $token = $_SERVER['HTTP_TOKEN'] ?? '';
        try
        {
            $usuarioLogeado = Token::DecodificarToken($token);
            $nombre = $_POST['nombre'] ?? '';
            $cuatrimestre = $_POST['cuatrimestre'] ?? '';
            if($nombre !== '' && $cuatrimestre !== '')
            {
                $lista = Archivo::TraerTodosObjetosDeJson(self::DIR_MATERIA_JSON);

                $id = Materia::GenerarId($lista);

                $materia = new Materia($id, $nombre, $cuatrimestre);
                
                Archivo::GuardarObjetoJson(self::DIR_MATERIA_JSON, $materia);
                
                $jSend->status = 'success';
                $jSend->data->mensajeExito = 'Guardado exitoso';
            }
            else
            {
                $jSend->message = 'Todos los campos son obligatorios';
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

            $jSend->data->materias = Archivo::TraerTodosObjetosDeJson(self::DIR_MATERIA_JSON);
            
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