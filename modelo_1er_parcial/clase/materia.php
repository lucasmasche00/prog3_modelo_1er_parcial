<?php
class Materia
{
    public $id;
    public $nombre;
    public $cuatrimestre;

    public function __construct($id, $nombre, $cuatrimestre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->cuatrimestre = $cuatrimestre;
    }

    public static function GenerarId($lista)
    {
        if(is_null($lista) || count($lista) <= 0)
            return 1;
        $stayInLoop = true;
        $newId = 1;
        while($stayInLoop)
        {
            $esRepetido = false;
            foreach ($lista as $value)
            {
                if($value->id === $newId)
                    $esRepetido = true;
            }
            if($esRepetido === false)
                $stayInLoop = false;
            else
                $newId++;
        }
        
        return $newId;
    }
}
?>