<?php
require_once __DIR__ . '/user.php';
require_once __DIR__ . '/jSend.php';
class UserApi
{
    const RECURSO_USER = 'user';
    const DIR_USER_JSON = __DIR__ . '/../archivo/users.txt';
    const DIR_USER_IMG = __DIR__ . '/../img/';
    const DIR_USER_IMG_BACKUP = __DIR__ . '/../backup/';
    
    public static function Alta()
    {
        $jSend = new JSend('error');
        $email = $_POST['email'] ?? '';
        
        if($email !== '')
        {
            $clave = $_POST['clave'] ?? '';
            if($clave !== '')
            {
                $file = $_FILES['foto'] ?? null;
                
                $lista = Archivo::TraerTodosObjetosDeJson(self::DIR_USER_JSON);
                
                if(!User::IsInList($lista, $email))
                {
                    if(!is_null($file))
                    {
                        $foto = Archivo::GuardarArchivo(self::DIR_USER_IMG, $file);
                        if($foto !== false)
                        {
                            $user = new User($email, $clave, $foto);
                            
                            Archivo::GuardarObjetoJson(self::DIR_USER_JSON, $user);
                            
                            $jSend->status = 'success';
                            $jSend->data->mensajeExito = 'Guardado exitoso';
                        }
                        else
                        {
                            $jSend->message = 'Error al guardar la foto';
                        }
                    }
                    else
                    {
                        $jSend->message = 'Foto valida requerida';
                    }
                }
                else
                {
                    $jSend->message = 'Email repetido';
                }
            }
            else
            {
                $jSend->message = 'Password valida requerida';
            }
        }
        else
        {
            $jSend->message = 'Email valido requerido';
        }
        return json_encode($jSend);
    }
}
?>