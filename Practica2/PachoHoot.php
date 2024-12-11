<?php
require_once "Clases.php";
//conexion base de Datos
$db = new mysqli('localhost', 'root', '', 'pachohoot');
$db->set_charset("utf8");

if (isset($_POST["usuE"])) {
    $usuario = new Usu($db);
    //toca comprobar si existe ese usuario
    $usu = $usuario->sacarTodos();
    if ($usuario->comproUsu($usu, $_POST["nm"])) {
        //si el usuario ya existe vuelve a la pagina anterior
        header("Location: ./PachoHoot.php");
        exit;
    }
    //cuando es nuevo el usuario se le añade a la BD
    $usuario->usu_BD($_POST["nm"]);
    header("Location: ./preguntas.php");
    exit;
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
    <h1 class="rubik-glitch-regular" id="titulo">Pacho Hoot</h1>
    <div class=".container">
        <div class="row">
            <img src="https://th.bing.com/th/id/OIG2.poxi.IH_eLRG0Y1SH5Wy?pid=ImgGn" alt="Buho logo" class="img-fluid">
            <section id=".container">
        </div>
    </div>
    <div class="row zonaform">
        <form action="#" method="post" id="formIni">
            <label for="nm">Nombre</label>
            <input type="text" name="nm" class="form-control" pattern="^[a-zA-Z]+$" required>
            <input type="submit" name="usuE" value="Entrar" class="btn btn-primary">
        </form>
    </div>
    </section>
</body>

</html>