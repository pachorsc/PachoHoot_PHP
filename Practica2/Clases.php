<?php
class Usu
{
    private $bd;
    private $nom;
    private $time;
    private $record;

    public function __construct($bd, $nom = "", $time = "", $record = "")
    {
        $this->bd = $bd;
        $this->nom = $nom;
        $this->time = $time;
        $this->record = $record;
    }

    public function __get($variable)
    {
        return $this->$variable;
    }

    public function __set($variable, $valor)
    {
        $this->$variable = $valor;
    }
    public function sacarTodos()
    {
        $sent = "SELECT nombre FROM usu;";

        $cons = $this->bd->prepare($sent);
        $cons->bind_result($this->nom);
        $cons->execute();
        $usus = [];
        while ($cons->fetch()) {
            array_push($usus, $this->nom);
        }
        return $usus;
    }
    public function tablaF()
    {
        $sent = "SELECT nombre, record FROM usu order by record;";
        $cons = $this->bd->prepare($sent);
        $cons->bind_result($this->nom, $this->record);
        $cons->execute();
        $usus = [];
        while ($cons->fetch()) {
            $usus[$this->nom] = $this->record;
        }
        return $usus;
    }
    public function getRecord()
    {
        //traemos el momento en el que usuario empezo el cuestionario y se lo restamos al momeno que termino y se lo insertamos a record
        $sent = "SELECT tim
        FROM usu
        ORDER BY tim DESC
        LIMIT 1;
        ;";

        $cons = $this->bd->prepare($sent);
        $cons->bind_result($this->time);
        $cons->execute();

        while ($cons->fetch()) {

            $ini = strtotime($this->time);
            $fin = strtotime(date('Y-m-d H:i:s'));
            $segundos = $fin - $ini;
            echo " tardo $segundos segundos";
            $this->record = $segundos;
        }
        //una vez tenemos los segundos que tardo, modificamos ese timepo en usuario
        $sent = "UPDATE `usu` 
        SET `record` = ? 
        WHERE `usu`.`nombre` = (SELECT nombre FROM usu ORDER BY tim DESC
            LIMIT 1 ); ";
        $cons = $this->bd->prepare($sent);
        $t = intval($this->record);
        $cons->bind_param('i', $t);
        $cons->execute();
        if ($cons->error) {
            die("Execution failed: " . $cons->error);
        }
        echo "Record updated successfully.";
    }

    public function comproUsu($noms, $nombre)
    {
        $existe = false;
        //recorremos el array de usuarios en busca del nombre actual
        for ($i = 0; $i < count($noms); $i++) {
            if ($noms[$i] == $nombre) {
                $existe = true;
                break;
            }
        }
        //devuelve un true False según
        return $existe;
    }
    //anadir usuarios a la BD
    public function usu_BD($nomUs)
    {
        $sent = 'INSERT INTO usu (nombre) values("' . $nomUs . '")';
        $cons = $this->bd->prepare($sent);
        //Inseta usuario a la BD
        $cons->execute();
    }

    public function __toString()
    {
        $str = "EL usuario $this->nom inicio el cuestionario a las $this->time y su record es $this->record";

        return $str;
    }
}

class Pregunt
{
    private $bd;
    private $id;
    private $enunc;
    private $corr;
    private $opciones;

    public function __construct($bd, $id = "", $enc = "", $corr = "", $opc = "")
    {
        $this->bd = $bd;
        $this->id = $id;
        $this->enunc = $enc;
        $this->corr = $corr;
        $this->opciones = $opc;
    }
    public function traer_conId($id)
    {
        $sent = "SELECT enun, resp, opcion FROM preguntas WHERE id = ?;";
        $cons = $this->bd->prepare($sent);

        $cons->bind_param("i", $id);
        $cons->bind_result($this->enunc, $this->corr, $this->opciones);

        $cons->execute();
        //devuelvo todos los datos en un array
        $datos = [];
        while ($cons->fetch()) {
            $datos = [$this->enunc,  $this->corr, $this->opciones];
        }
        return $datos;
    }

    public function preguntas()
    {
        $sent = "SELECT enun FROM preguntas;";

        $cons = $this->bd->prepare($sent);

        $cons->bind_result($this->enunc);

        $cons->execute();
        while ($cons->fetch()) {
            echo $this->enunc . "<br>";
        }
    }
    public function __get($variable)
    {
        return $this->$variable;
    }
    //creamos el orden de las preguntas segun su id
    public function preguntasnum()
    {
        $preguntas = [];

        while (count($preguntas) < 5) {
            $numero = rand(1, 10);
            if (!in_array($numero, $preguntas)) {
                array_push($preguntas, $numero);
            }
        }
        return $preguntas;
    }
    public function __set($variable, $valor)
    {
        $this->$variable = $valor;
    }

    public function __toString()
    {
        $str = "La respuesta a '$this->enunc' es $this->corr";

        return $str;
    }
}
