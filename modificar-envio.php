<?php

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">

    <title>Modificar Envío</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="main-rttedest.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="nav-link active" href="mis-envios.php">Mis Envíos
                    <span class="visually-hidden">(current)</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="perfil.php">Mi perfil</a>
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

    <main class="mb-4">
        <div align=right class='mt-2' style="margin-right:1em;">
            <a class='btn btn-outline-warning' href='javascript:history.back()'>Volver</a>
        </div>
        <div class="title">
            <h2>Modificar Envío </h2>             
        </div>


<?php
    if (!isset($_SESSION['email']) || !$_SESSION['email']){
        echo "<h1>NO ESTÁS LOGGUEADO</h1>";
        header("Location: index.php");
    }

    include "BaseDatos.php";

    if (isset($_GET["modificar"])){ 
        $id = $_GET["modificar"]; 
        $datos = mysqli_fetch_assoc(idEnvio($id));
    }

    if (isset($_POST["modificar"])){

        $id = $_POST["Envio_mercancia_id"];
        $altura = $_POST["altura"];
        $anchura = $_POST["anchura"];
        $profundidad = $_POST["profundidad"];
        $peso = $_POST["peso"];
        $fechaSalida = $_POST["fechaSalida"];
        $fechaLlegada = $_POST["fechaLlegada"];
        $tipo = $_POST["tipo"];
        $direccionSalida = $_POST["direccionSalida"];
        $cpSalida = $_POST["cpSalida"];
        $direccionLlegada = $_POST["direccionLlegada"];
        $cpLlegada = $_POST["cpLlegada"];
        $nombreDest = $_POST["nombreDest"];


        if (modificarEnvio($id, $altura, $anchura, $profundidad, $peso, $fechaSalida, $fechaLlegada, $tipo, $direccionSalida, $cpSalida, $direccionLlegada, $cpLlegada, $nombreDest)){
            echo "<h3>Envío modificado con éxito</h3>
            <div align=center class='mt-4'>
            <a class='btn btn-outline-warning' href='mis-envios.php'>Volver</a>
            </div>";
        }
    }?>

        <div class="col-md-4 offset-md-4 my-auto">
                <h3  align=center>Modificar envío</h3>
                <div>
                    <form action="modificar-envio.php" method="POST" id="modificarForm">

                        <input type="hidden" class="form-control" value="<?php echo $datos["Envio_mercancia_id"]; ?>" id="Envio_mercancia_id" name="Envio_mercancia_id">
                        
                        <fieldset>
                            <div align=center>
                            <legend>Introduce datos de la carga</legend>
                            </div>
                            <div class="form-group">
                                <label for="altura" class="form-label mt-2">Altura(cm):</label>
                                <input type="number" class="form-control" value="<?php echo $datos["Altura"]; ?>" id="altura" name="altura" required>
                                <label for="anchura" class="form-label mt-2">Anchura(cm):</label>
                                <input type="number" class="form-control" value="<?php echo $datos["Anchura"]; ?>" id="anchura" name="anchura" required>
                                <label for="profundidad" class="form-label mt-2">Profundidad(cm):</label>
                                <input type="number" class="form-control" value="<?php echo $datos["Profundidad"]; ?>" id="profundidad" name="profundidad" required>
                            </div>
                            <div class="form-group">
                                <label for="peso" class="form-label mt-2">Peso(Kg):</label>
                                <input type="number" class="form-control" value="<?php echo $datos["PesoKg"]; ?>" id="peso" name="peso" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo" class="form-label mt-2">Tipo Mercancía:</label>
                                <div>
                                    <?php if($datos["TipoID"] == 1){
                                        echo '<div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" id="tipo" name="tipo" value=1 checked>Seco</label></div>'; 
                                    }else{
                                        echo '<div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" id="tipo" name="tipo" value=1>Seco</label></div>';
                                    }
                                    if($datos["TipoID"] == 2){
                                        echo '<div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" id="tipo" name="tipo" value=2 checked>Refrigerado</label></div>'; 
                                    }else{
                                        echo '<div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" id="tipo" name="tipo" value=2>Refrigerado</label></div>';
                                    }
                                    if($datos["TipoID"] == 3){
                                        echo '<div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" id="tipo" name="tipo" value=3 checked>Congelado</label></div>'; 
                                    }else{
                                        echo '<div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" id="tipo" name="tipo" value=3>Congelado</label></div>';
                                    }
                                    ; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fechaSalida" class="form-label mt-2">Fecha de salida:</label>
                                <input type="date" class="form-control" value="<?php echo $datos["FechaSalida"]; ?>" id="fechaSalida" name="fechaSalida" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Fecha Máxima llegada:</label>
                                <input type="date" class="form-control" value="<?php echo $datos["FechaMaxLlegada"]; ?>" id="fechaLlegada" name="fechaLlegada" required>
                            </div>
                        </fieldset><br>

                        <fieldset>
                        <div align=center>
                            <legend>Introduce datos del Remitente</legend>
                        </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Dirección salida:</label>
                                <input type="text" class="form-control" value="<?php echo $datos["DireccionSalida"]; ?>" id="direccionSalida" name="direccionSalida" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">C.P. salida:</label>
                                <input type="number" class="form-control" value="<?php echo $datos["CPSalida"]; ?>" id="cpSalida" name="cpSalida" required>
                            </div>
                        </fieldset><br>
                        <fieldset>
                        <div align=center>
                            <legend>Introduce datos de Destino</legend>
                        </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Dirección destino:</label>
                                <input type="text" class="form-control" value="<?php echo $datos["DireccionLlegada"]; ?>" id="direccionLlegada" name="direccionLlegada" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">C.P. destino:</label>
                                <input type="number" class="form-control" value="<?php echo $datos["CPLlegada"]; ?>" id="cpLlegada" name="cpLlegada" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Nombre destino:</label>
                                <input type="text" class="form-control" value="<?php echo $datos["NombreDest"]; ?>" id="nombreDest" name="nombreDest" required>
                            </div>
                                
                            <div class="form-group" id="modificar" align=center>
                                <input type="submit" value="Aceptar cambios" class="btn btn-lg btn-success mt-2" style="text-align:center; align-items:strecht" name="modificar" form="modificarForm">
                            </div>
                        </fieldset>
                    </form>

                </div>            
            </div>

    </main>

</body>
</html>
