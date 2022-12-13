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
        <div class="mb-4">
            <div align=right class='mt-2' style="margin-right:1em;">
                <a class='btn btn-outline-warning' href='javascript:history.back()'>Volver</a>
            </div>
            <h1>Registro </h1>
            <div class="container col-md-2">

        <?php

            include "BaseDatos.php";


            if (isset($_POST["crearRtteDest"])){
            
                $id = $_POST["id"];
                $cifDni = $_POST["cifDni"];
                $nombre = $_POST["nombre"];
                $nombreEmpresa = $_POST["nombreEmpresa"];
                $email = $_POST["email"];
                $telefono = $_POST["telefono"];
                $direccion = $_POST["direccion"];
                $codigoPostal = $_POST["codigoPostal"];
                $contrasenia = $_POST["contrasenia"];

                if (crearRtteDest($cifDni, $nombre, $nombreEmpresa, $email, $telefono, $direccion, $codigoPostal, $contrasenia)){
                    echo "<h4><div align=center class='mt-4'>Se ha añadido el usuario: " . $nombre . " con éxito</h4></div>";
                } else {
                    echo "<h4><div align=center class='mt-4'>No se ha podido añadir el usuario.</h4></div>";
                }
            }

            elseif (isset($_POST["crearTransportista"])){
                $id = $_POST["id"];
                $cif = $_POST["cif"];
                $nombre = $_POST["nombre"];
                $nombreEmpresa = $_POST["nombreEmpresa"];
                $email = $_POST["email"];
                $telefono = $_POST["telefono"];
                $contrasenia = $_POST["contrasenia"];

                if (crearTransportista($cif, $nombre, $nombreEmpresa, $email, $telefono, $contrasenia)){
                    echo "<h4><div align=center class='mt-4'>Se ha añadido el usuario con éxito</h4></div>";
                } else {
                    echo "<h4><div align=center class='mt-4'>No se ha podido añadir el usuario.</h4></div>";
                }
            }

            elseif (isset($_GET["crearRtteDest"])){ 

                $id = "";
                $datos = [
                    "cifDni" => "",
                    "nombre" => "",
                    "nombreEmpresa" => "",
                    "email" => "",
                    "telefono" => "",
                    "direccion" => "",
                    "codigoPostal" => "",
                    "contrasenia" => ""
                ]; echo "NUEVO REMITENTE/DESTINATARIO";

        ?>
                <form action="registro.php" method="POST" id="rtteDestForm" name="rtteDestForm">

                    <fieldset>
                        <legend>Introduce tus datos</legend>

                        <div class="form-group">
                            <label for="cifDni" class="form-label mt-4">CIF/DNI:</label>
                            <input type="text" class="form-control" onblur="return valorCifDni()" id="cifDni" name="cifDni" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="form-label mt-4">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="NombreEmpresa" class="form-label mt-4">Empresa:</label>
                            <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa">
                        </div>                    
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label mt-4">Dirección email:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@email.com" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label mt-4">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono" placeholder="34000000000" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion" class="form-label mt-4">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div> 
                        <div class="form-group">
                            <label for="codigoPostal" class="form-label mt-4">C.P.:</label>
                            <input type="number" class="form-control" id="codigoPostal" placeholder="12345" name="codigoPostal" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-4">Contraseña:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="contrasenia" required>
                        </div><br>
                        <div class="form-group" id="guardar" align=center>
                            <input type="submit" id="guardarRtteDest" value="Guardar" class="btn btn-success mt-2" name="crearRtteDest" form="rtteDestForm">
                            <input type="reset" value="Borrar" class="btn btn-danger mt-2">
                        </div>
                    </fieldset>
                </form>


        <?php    

            } else {
                $id = "";
                $datos = [
                    "cif" => "",
                    "nombre" => "",
                    "nombreEmpresa" => "",
                    "email" => "",
                    "telefono" => "",
                    "contrasenia" => ""
                ]; 
                echo "NUEVO TRANSPORTISTA";
        

    ?>
                <form action="registro.php" method="POST" id="transportistaForm" name="transportistaForm">

                    <fieldset>
                        <legend>Introduce tus datos</legend>
                        <div class="form-group">
                            <label for="cifDni" class="form-label mt-4">CIF:</label>
                            <input type="text" class="form-control" id="cif" placeholder="00000000A" name="cif">
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="form-label mt-4">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="NombreEmpresa" class="form-label mt-4">Empresa:</label>
                            <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa">
                        </div>                    
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="form-label mt-4">Dirección email:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@email.com" name="email">
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label mt-4">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono" placeholder="34000000000" name="telefono">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-4">Contraseña:</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="contrasenia">
                        </div><br>
                        <div class="form-group" id="guardar" align=center>
                            <input type="submit" value="Guardar" class="btn btn-success mt-2" name="crearTransportista" form="transportistaForm">&nbsp;
                            <input type="reset" value="Borrar" class="btn btn-danger mt-2" form="transportistaForm">
                        </div>
                    </fieldset>
                </form>
                
        <?php
        }
        ?>
                <div align=center class='mt-4'>
                    <a class='btn btn-outline-warning' href="index.php">Ir a Login</a> 
                </div>
                   
            </div> 
        </div>

    </main>
    <script src="./main.js"></script>
</body>
</html>