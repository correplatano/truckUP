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
    
    <title>Modificar Perfil Transportista</title>
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
                <a class="nav-link" href="perfil-transportista.php">Mi perfil</a>
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
            <a class='btn btn-outline-warning' href='javascript:history.back()'>Volver</a>
        </div>
        <div class="title">
            <h2>Modificar Perfil </h2>            
        </div>

        <?php

        include "BaseDatos.php";

        if (isset($_POST["modificarPerfilTransportista"])){

            $id = $_POST["Transportista_id"];
            $cif = $_POST["cif"];
            $nombre = $_POST["nombre"];
            $nombreEmpresa = $_POST["nombreEmpresa"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $contrasenia = $_POST["contrasenia"];

            if(modificarPerfilTransportista($id, $cif, $nombre, $nombreEmpresa, $email, $telefono, $contrasenia)){
                
                echo "<div align=center class='mt-4'>
                <h3>Perfil modificado con éxito</h3>
                <a class='btn btn-outline-warning' href='perfil-transportista.php'>Volver</a>
                </div>";
            }
        }else if(isset($_POST["eliminarPerfilTransportista"])){
            $id = $_POST["Transportista_id"];
            if (eliminarPerfilTransportista($id)){
                echo "<div align=center class='mt-4'>
                    <h3>Perfil eliminado con éxito</h3>
                    <a class='btn btn-outline-danger' href='logout.php'>Salir</a>
                    </div>";
                session_destroy();
            }
        }else{
            if (isset($_GET["modificarPerfilTransportista"])){ 
                $id = $_GET["modificarPerfilTransportista"]; 
                $datos = mysqli_fetch_assoc(perfilTransportista($id));
            }else{
                if (isset($_GET["eliminarPerfilTransportista"])){ 
                    $id = $_GET["eliminarPerfilTransportista"]; 
                    $datos = mysqli_fetch_assoc(perfilTransportista($id));
                }
            }
        
    ?>

    <div class="col-md-4 offset-md-4 my-auto">
        
        <div>
            <form action="modificar-perfil-transportista.php" method="POST" id="modificarPerfilTransportistaForm">

                <input type="hidden" class="form-control" value="<?php echo $datos["Transportista_id"]; ?>" id="Transportista_id" name="Transportista_id">
                
                <fieldset>
                    <div align=center>
                    <legend>Datos del Perfil</legend>
                    <div class="form-group">
                            <label for="cifDni" class="form-label mt-4">CIF:</label>
                            <input type="text" class="form-control" id="cif" value="<?php echo $datos["Cif"]; ?>" name="cif" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="form-label mt-4">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" value="<?php echo $datos["Nombre"]; ?>" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="NombreEmpresa" class="form-label mt-4">Empresa:</label>
                            <input type="text" class="form-control" id="nombreEmpresa" value="<?php echo $datos["NombreEmpresa"]; ?>" name="nombreEmpresa" required>
                        </div>                    
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label mt-4">Dirección email:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $datos["Email"]; ?>" aria-describedby="emailHelp" placeholder="email@email.com" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label mt-4">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono" value="<?php echo $datos["Telefono"]; ?>" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-4">Contraseña:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" value="<?php echo $datos["Contrasenia"]; ?>" name="contrasenia" required>
                        </div><br>
                        <div class="form-group" id="guardar" align=center>
                            <input type="submit" value="Guardar Cambios" class="btn btn-success mt-2" name="modificarPerfilTransportista" form="modificarPerfilTransportistaForm">
                            <input type="submit" value="Eliminar Usuario" class="btn btn-dark mt-2" name="eliminarPerfilTransportista" form="modificarPerfilTransportistaForm">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    <?php
        }
    ?>
        </main>
    <script src="./main.js"></script>
</body>

</html>
    