<?php
class User
{
    public $email;
    public $clave;
    public $foto;

    public function __construct($email, $clave, $foto)
    {
        $this->email = $email;
        $this->clave = sha1($clave);
        $this->foto = $foto;
    }

    public static function GetInstance($obj)
    {
        return new User($obj->email, $obj->clave, $obj->foto);
    }

    public static function ListStdToUser($lista)
    {
        $listaObj = array();
        foreach ($lista as $value)
        {
            array_push($listaObj, self::GetInstance($value));
        }
        return $listaObj;
    }
    
    public static function FindById($lista, $id)
    {
        foreach ($lista as $value)
        {
            if($value->email != null && $id != null && $value->email === $id)
                return $value;
        }
        return false;
    }

    public static function IsInList($lista, $id)
    {
        return (!is_null($lista) && count($lista) > 0) ? ((self::FindById($lista, $id) === false) ? false : true) : false;
    }
}
?>