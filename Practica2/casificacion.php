<?php
            require_once "Clases.php";
            //conexion base de Datos
            $db = new mysqli('localhost', 'root', '', 'pachohoot');
            $db->set_charset("utf8");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Glitch&display=swap" rel="stylesheet">
    <title>Clasificacion</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.css">
    <link rel="stylesheet" href="./PachoHoot.css">
</head>
<body>
<section id="clas">
    <h1>Final del cuestionario</h1>
    <h2>Ranking</h2>
    <table class="table table-hover">
        <tr class="table-success">
            <th>Posición</th>
            <th>Pregunta</th>
            <th>Timepo</th>
        </tr>
        <?php
            $usus = new Usu($db);
            $posicion = $usus->tablaF();
            $cont =0;
            foreach ($posicion as $key => $value) {
                $cont++;
                echo "<tr class=\"table-secondary\">
                        <td>$cont</td>
                        <td>$key</td>
                        <td>$value</td>
                      </tr>";
            }
        ?>
    </table>
    <form action="./PachoHoot.php">
        <input type="submit" class="btn btn-primary" value="Volver">
    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>