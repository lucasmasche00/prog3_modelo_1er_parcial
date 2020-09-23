<?php
class Asignacion
{
    public $legajo;
    public $id;
    public $turno;

    public function __construct($legajo, $id, $turno)
    {
        $this->legajo = $legajo;
        $this->id = $id;
        $this->turno = $turno;
    }
    
    public static function FindById($lista, $obj)
    {
        foreach ($lista as $value)
        {
            if($value->legajo != null && isset($obj) && $value->legajo === $obj->legajo && $value->id === $obj->id && $value->turno === $obj->turno)
                return $value;
        }
        return false;
    }

    public static function IsInList($lista, $obj)
    {
        return (!is_null($lista) && count($lista) > 0) ? ((self::FindById($lista, $obj) === false) ? false : true) : false;
    }
}
?>