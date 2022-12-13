<?php

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">

    <title>Modificar Perfil</title>
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
            <h2>Modificar Perfil </h2>             
        </div>


    <?php
        if (!isset($_SESSION['email']) || !$_SESSION['email']){
            echo "<h1>NO ESTÁS LOGGUEADO</h1>";
            header("Location: index.php");
        }

        include "BaseDatos.php";

        if (isset($_POST["modificarPerfil"])){

            $id = $_POST["Remitente_destinatario_id"];
            $cifDni = $_POST["cifDni"];
            $nombre = $_POST["nombre"];
            $nombreEmpresa = $_POST["nombreEmpresa"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $direccion = $_POST["direccion"];
            $codigoPostal = $_POST["codigoPostal"];
            $contrasenia = $_POST["contrasenia"];

            if(modificarPerfil($id, $cifDni, $nombre, $nombreEmpresa, $email, $telefono, $direccion, $codigoPostal, $contrasenia)){
                echo "<div align=center class='mt-4'>
                <h3>Perfil modificado con éxito</h3>
                <a class='btn btn-outline-warning' href='perfil.php'>Volver</a>
                </div>";
            }
        }else if(isset($_POST["eliminarPerfil"])){
            echo "<h3>Perfil eliminado con éxito</h3>";
            echo '<a class="btn btn-outline-danger" href="logout.php">Salir</a>';
            session_destroy();

        }else{
            if (isset($_GET["modificarPerfil"])){ 
                $id = $_GET["modificarPerfil"]; 
                $datos = mysqli_fetch_assoc(perfil($id));
            }else{
                if (isset($_GET["eliminarPerfil"])){ 
                    $id = $_GET["eliminarPerfil"]; 
                    $datos = mysqli_fetch_assoc(perfil($id));
                }
            }
        

    ?>
    
    <div class="col-md-4 offset-md-4 my-auto">
        
        <div>
            <form action="modificar-perfil.php" method="POST" id="modificarPerfilForm">

                <input type="hidden" class="form-control" value="<?php echo $datos["Remitente_destinatario_id"]; ?>" id="Remitente_destinatario_id" name="Remitente_destinatario_id">
                
                <fieldset>
                    <div align=center>
                    <legend>Datos del Perfil</legend>
                    <div class="form-group">
                            <label for="cifDni" class="form-label mt-4">CIF/DNI:</label>
                            <input type="text" class="form-control" id="cifDni" value="<?php echo $datos["CifDni"]; ?>" name="cifDni">
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="form-label mt-4">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" value="<?php echo $datos["Nombre"]; ?>" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="NombreEmpresa" class="form-label mt-4">Empresa:</label>
                            <input type="text" class="form-control" id="nombreEmpresa" value="<?php echo $datos["NombreEmpresa"]; ?>" name="nombreEmpresa">
                        </div>                    
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label mt-4">Dirección email:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $datos["Email"]; ?>" aria-describedby="emailHelp" placeholder="email@email.com" name="email">
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label mt-4">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono" value="<?php echo $datos["Telefono"]; ?>" name="telefono">
                        </div>
                        <div class="form-group">
                            <label for="direccion" class="form-label mt-4">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" value="<?php echo $datos["Direccion"]; ?>" name="direccion">
                        </div> 
                        <div class="form-group">
                            <label for="codigoPostal" class="form-label mt-4">C.P.:</label>
                            <input type="number" class="form-control" id="codigoPostal" value="<?php echo $datos["CodigoPostal"]; ?>" name="codigoPostal">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-4">Contraseña:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" value="<?php echo $datos["Contrasenia"]; ?>" name="contrasenia">
                        </div><br>
                        <div class="form-group" id="guardar" align=center>
                            <input type="submit" value="Guardar Cambios" class="btn btn-success mt-2" name="modificarPerfil" form="modificarPerfilForm">
                            <input type="submit" value="Eliminar Usuario" class="btn btn-dark mt-2" name="eliminarPerfil">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    <?php
        }
    ?>
