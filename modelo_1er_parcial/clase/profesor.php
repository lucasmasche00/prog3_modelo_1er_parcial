<?php
class Profesor
{
    public $legajo;
    public $nombre;

    public function __construct($legajo, $nombre)
    {
        $this->legajo = $legajo;
        $this->nombre = $nombre;
    }
    
    public static function FindById($lista, $id)
    {
        foreach ($lista as $value)
        {
            if($value->legajo != null && $id != null && $value->legajo === $id)
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