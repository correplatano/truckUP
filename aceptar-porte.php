<?php

    session_start();

    if (!isset($_SESSION['email']) || !$_SESSION['email']){
        echo "<h1>NO ESTÁS LOGGUEADO</h1>";
        header("Location: index.php");
    }
    
    ?>
    
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    
    <title>Aceptar Porte</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="main-transportista.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
            <a class="nav-link active" href="envios-aceptados.php">Mis Portes
                <span class="visually-hidden">(current)</span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Mi perfil</a>
            </li>
        </ul>
            <div>
            <?php                  
            echo "<h4>Usuario conectado: " . $_SESSION['email'] . "</h4>";            
            ?> 
            </div>&nbsp;
                  
            <a class="btn btn-outline-danger" href="logout.php">Cerrar Sesión</a>
        </div>
    </div>
    </nav>

    <main>

        <div align=right class='mt-2' style="margin-right:1em;">
            <a class='btn btn-outline-warning' href='main-transportista.php'>Volver</a>
        </div>
        <div class="menu">
            
            <h2>Aceptar Porte </h2>
                          
        </div>

        <?php

            include "BaseDatos.php";

            if (isset($_POST["aceptarPorte"])){

                $id = $_POST['id'];
                $nombreTransportista = ($_POST['nombreTransportista']);
                $matricula = ($_POST['matricula']);
                $aceptado = (int)$_POST['aceptado'];
                $transportista = getIdT($_SESSION['email']);

                if (aceptarEnvio($id, $nombreTransportista, $aceptado, $transportista, $matricula)){
                    
                    echo "<div align=center class='mt-4'>
                    <h4>Se ha aceptado el envío con éxito</h4>
                    </div>";
                    
                    
                } else {
                    echo "<div align=center class='mt-4'>
                    <h4>No se ha podido aceptar el envío.</h4>
                    </div>";
                    }
            }else{

            if (isset($_GET["aceptarPorte"])){ 
                $id = $_GET["aceptarPorte"]; 
                $datos = mysqli_fetch_assoc(idEnvio($id));
            }
        ?>

        <div class="col-md-4 offset-md-4 my-auto">
            
            <form action='aceptar-porte.php' method='POST' id='aceptarPorteForm'>
                <input type="hidden" class="form-control" value="<?php echo $datos["Envio_mercancia_id"]; ?>" id="Envio_mercancia_id" name="id">
                <input class='form-control' type='hidden' value=1 name='aceptado'>
                <fieldset>
                    <div align=center>
                    <legend>Transportista</legend>
                    </div>
                    <div class="form-group">
                        <label for="nombreTransportista" class="form-label mt-2">Nombre:</label>
                        <input class='form-control' type='text' value="<?php echo $datos["NombreTransportista"]; ?>" name='nombreTransportista' required>
                    </div>
                    <div class="form-group">
                        <label for="matricula" class="form-label mt-2">Matricula:</label>
                        <input class='form-control' type='text' value="<?php echo $datos["Matricula"]; ?>" name='matricula' required>
                    </div>
                    <div class="form-group" id="modificar" align=center>
                    <input type='submit' name='aceptarPorte' value='Aceptar Porte' form='aceptarPorteForm' class='btn btn-success mt-2'>
                    </div>
                </fieldset>
            </form>
        </div>

        <?php
            }
        ?>



