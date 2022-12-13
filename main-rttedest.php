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
    
    <title>Main RtteDest</title>
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


    <main class="container p-4 mb-4">

        <div align=right class='mt-2' style="margin-right:1em;">
            <a class='btn btn-outline-warning' href='javascript:history.back()'>Volver</a>
        </div>
        <div class=class="display-4 text-center mt-4">
            <h2>Menú Remitente/Destinatario </h2>     
        </div>


    <?php
    include "BaseDatos.php";
    
    if (isset($_POST["cargar"])){
    
        $id = $_POST["id"];
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
        $rtteDest = getID($_SESSION['email']);
        
        if (crearEnvio($altura, $anchura, $profundidad, $peso, $fechaSalida, $fechaLlegada, $tipo, $direccionSalida, $cpSalida, $direccionLlegada, $cpLlegada, $nombreDest, $rtteDest)){
            
            echo "<div align=center class='mt-4'>
            <h4>Se ha creado el envío con éxito</h4>
            </div>";
        } else {
            echo "<h4>No se ha podido crear el envío.</h4>";
        }
        
    }else{
    
?>
    

            <div class="col-md-4 offset-md-4 my-auto">
                <h3  align=center>Crear envío</h3>
                <div>
                    <form action="main-rttedest.php" method="POST" id="envioForm">

                        <fieldset>
                            <div align=center>
                            <legend>Introduce datos de la carga</legend>
                            </div>
                            <div class="form-group">
                                <label for="altura" class="form-label mt-2">Altura(cm):</label>
                                <input type="number" class="form-control" id="altura" name="altura" required>
                                <label for="anchura" class="form-label mt-2">Anchura(cm):</label>
                                <input type="number" class="form-control" id="anchura" name="anchura" required>
                                <label for="profundidad" class="form-label mt-2">Profundidad(cm):</label>
                                <input type="number" class="form-control" id="profundidad" name="profundidad" required>
                            </div>
                            <div class="form-group">
                                <label for="peso" class="form-label mt-2">Peso(Kg):</label>
                                <input type="number" class="form-control" id="peso" name="peso" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo" class="form-label mt-2">Tipo Mercancía:</label>
                                <div align=center>
                                    <input type="radio" class="form-check-input" id="tipo" name="tipo" value=1 checked>Seco
                                    <input type="radio" class="form-check-input" id="tipo" name="tipo" value=2>&nbsp;Refrigerado&nbsp;
                                    <input type="radio" class="form-check-input" id="tipo" name="tipo" value=3>&nbsp;Congelado&nbsp;
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fechaSalida" class="form-label mt-2">Fecha de salida:</label>
                                <input type="date" class="form-control" id="fechaSalida" name="fechaSalida" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Fecha Máxima llegada:</label>
                                <input type="date" class="form-control" id="fechaLlegada" name="fechaLlegada" required>
                            </div>
                        </fieldset><br>

                        <fieldset>
                        <div align=center>
                            <legend>Introduce datos del Remitente</legend>
                        </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Dirección salida:</label>
                                <input type="text" class="form-control" id="direccionSalida" name="direccionSalida" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">C.P. salida:</label>
                                <input type="number" class="form-control" id="cpSalida" name="cpSalida" required>
                            </div>
                        </fieldset><br>
                        <fieldset>
                        <div align=center>
                            <legend>Introduce datos de Destino</legend>
                        </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Dirección destino:</label>
                                <input type="text" class="form-control" id="direccionLlegada" name="direccionLlegada" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">C.P. destino:</label>
                                <input type="number" class="form-control" id="cpLlegada" name="cpLlegada" required>
                            </div>
                            <div class="form-group">
                                <label for="fechaLlegada" class="form-label mt-2">Nombre destino:</label>
                                <input type="text" class="form-control" id="nombreDest" name="nombreDest" required>
                            </div>
                                
                            <div class="form-group d-grid gap-2" id="acceder">
                                <input type="submit" value="Cargar" class="btn btn-lg btn-success mt-2" style="text-align:center; align-items:strecht" name="cargar">
                            </div>
                        </fieldset>
                    </form>

                </div>            
            </div>

    </main>
    <?php
    }
    ?>
</body>
</html>
