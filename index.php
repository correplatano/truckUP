<?php 
    session_destroy(); 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    
    <title>login</title>
</head>
<body>
    <main>
    <?php
        include "BaseDatos.php";
        
        if (isset($_POST["email"]) && isset($_POST["contrasenia"])){

            if (comprobarUsuario($_POST["email"], $_POST["contrasenia"])){
                unset($_SESSION['email']);
                session_destroy();
                session_start();
                $_SESSION['email'] = true;
                if (usuarioRtteDest($_POST["email"])){
                    header("Location: main-rttedest.php");
                } else if (usuariotransportista($_POST["email"])){
                    header("Location: main-transportista.php");               
                }else{
                    echo "<h3 style='color:red' align='center'>Error: usuario no encontrado.</h3>";
                }
                
                
            }else{
                echo "<h3 style='color:red' align='center'>Error: usuario o contraseña no válidas.</h3>";
                $_SESSION['email'] = false;  
            }                                  
        }
    ?>

        <div class="login">
            <h1>BIENVENIDO </h1>
            <div class="container col-md-2">
                <form action="index.php" method="POST" id="bienvenidoForm">

                    <fieldset>
                        <legend>Introduce tus datos</legend>

                        <div class="form-group">
                            <label for="email" class="form-label mt-2">Dirección email:</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email@email.com" name="email">
                        </div>
                        <div class="form-group">
                            <label for="contrasenia" class="form-label mt-2">Contraseña:</label>
                            <input type="password" class="form-control" placeholder="Contraseña" name="contrasenia" id="contrasenia">
                        </div>
                        <div class="form-group" id="acceder" align=center>
                            <input type="submit" onclick="return validarEntrada()" value="Acceder" class="btn btn-success mt-2" style="text-align:center; align-items:strecht" name="login" id="login">
                        </div>
                </form>
                <div class="form-group" style="text-align:center; align-items:center;">
                    <fieldset>
                        <legend>Regístrate:</legend>
                            <form action="registro.php" method="GET">
                                <input type="submit" id="crearRtteDest" name="crearRtteDest" value="Remitente o Destinatario" class="btn btn-outline-info mt-2">
                                <input type="submit" name="crearTransportista" value="Transportista" class="btn btn-outline-light mt-2">
                            </form>
                    </fieldset>    
                </div>
            </div>            
        </div>
    </main>
 
    <script src="./main.js"></script>
</body>
</html>
    
    

