<?php

use function PHPSTORM_META\type;

require_once "Clases.php";
$db = new mysqli('localhost', 'root', '', 'pachohoot');
$db->set_charset("utf8");
$pregunta = new Pregunt($db);

$parte_preg;
$arPregunt;

//si la pregunta es acertada se retira un numero dle array si no se mantiene
if (isset($_POST["Enviar"])) {
    //hacemos un array del string del input invisible
    $arPregunt = explode(",", $_POST["strArr"]);

    if (count($arPregunt) <= 1) {
        //si ya no hay mas preguntas se va a la clasificacion

        //primero llenamos el tiempo que tardó en hacer el formulario

        $usuar = new Usu($db);
        $usuar->getRecord();

        header("Location: ./casificacion.php");
        exit;
    }
    //obtenemos la preguta segun la ultimo numero del array
    $parte_preg = $pregunta->traer_conId(end($arPregunt));

    //compruebo si la respuesta anterior fue correcta

    $resp = "";
    if (isset($_POST["1"])) {
        //obtenemos las preguntas de seleccion multiple y las pasamos a array
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_POST[strval($i)])) {
                $resp .= $_POST[strval($i)] . ",";
            }
        }
        $resp = substr($resp, 0, -1);
    }
    if (!isset($_POST["resp"])) $_POST["resp"]  = null;
    if ($_POST["resp"] == $parte_preg[1] || $resp == $parte_preg[1]) {
        //si se responde bien, se resta uno al array numerio de las preguntas y se muestra la siguiente pregunta
        array_pop($arPregunt);
        //se pasa el array a string 
        $stringdepreg = implode(",", $arPregunt);

        //pasamos a la siguiente pregunta
        $parte_preg = $pregunta->traer_conId(end($arPregunt));
    } else {
        echo "<h2>incorrecto<h2>";
        // si no es correcta se mantinene todo igual
        $stringdepreg = $_POST["strArr"];
    }
} else {
    //array de las preguntas
    $preguntas = new Pregunt($db);
    $arPregunt = $preguntas->preguntasnum();

    //pasamos el array a string  para pasarlo por input hidden
    $stringdepreg = implode(",", $arPregunt);

    //traemos la pregunta segun el array

    $parte_preg = $pregunta->traer_conId(end($arPregunt));
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Glitch&display=swap" rel="stylesheet">
    <title>Pacho-Hoot</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.css">
    <link rel="stylesheet" href="./PachoHoot.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <?php
            echo "<h1>" . $parte_preg[0] . "</h1>";
            ?>
            <form action="" method="post" class="form-check col-6 ">
                <?php
                //opciones correcta
                $corr = explode(",", $parte_preg[1]);
                //opciones
                $resp = explode(",", $parte_preg[2]);
                if (count($corr) == 3) {
                    //seleccion con varias respuestas correctas
                    $cont = 0;
                    foreach ($resp as $key => $value) {
                        $cont++;
                        echo "<input type='radio' name='$cont' value='$value' class='form-check-input' id='flexCheckDefault'> $value <br> ";
                    }
                } else {
                    //creamos las opciones y las mostramos en un formulario radiobutton
                    if (count($resp) == 1) {
                        //respuesta de escribir 
                        echo "<input type='text' name='resp' required class='form-control my-2' >";
                    } else {
                        //respuesta de seleccion unica
                        foreach ($resp as $key => $value) {
                            echo "<input type='radio' name='resp' value='$value' required class='form-check-input' id='flexCheckDefault'> $value <br>";
                        }
                    }
                }
                //envio el array pasado a string para la siguiente vuelta
                echo "<input type='hidden' name='strArr' value='$stringdepreg.'>";

                echo "<input type='submit' name='Enviar' class='btn btn-primary mx-auto' value='Enviar'>";
                ?>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>