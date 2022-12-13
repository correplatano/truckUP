<?php

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">

    <title>Perfil usuario</title>
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
            <h2>Mi Perfil </h2>             
        </div>


    <?php
        if (!isset($_SESSION['email']) || !$_SESSION['email']){
            echo "<h1>NO ESTÁS LOGGUEADO</h1>";
            header("Location: index.php");
        }

        include "BaseDatos.php";

        $id = getID($_SESSION['email']);
        $datos = perfil($id);

        if (is_string($datos)){
            return $datos;
        }else{
            echo "<table  class='table table-hover'>\n
            <tr>\n
                <th scope='col'>ID</th>\n
                <th scope='col'>CIF/DNI</th>\n
                <th scope='col'>Nombre</th>\n
                <th scope='col'>Empresa</th>\n
                <th scope='col'>Email</th>\n
                <th scope='col'>Teléfono</th>\n
                <th scope='col'>Dirección</th>\n
                <th scope='col'>C.P.</th>\n
            </tr>\n";

            while ($fila = mysqli_fetch_assoc($datos)){
                
                echo "
                    <tr class='table-primary'>\n
                        <th scope='row'>" . $fila["Remitente_destinatario_id"] . "</th>\n
                        <td>" . $fila["CifDni"] . "</td>\n
                        <td>" . $fila["Nombre"] . "</td>\n
                        <td>" . $fila["NombreEmpresa"] . "</td>\n
                        <td>" . $fila["Email"] . "</td>\n
                        <td>" . $fila["Telefono"] . "</td>\n
                        <td>" . $fila["Direccion"] . "</td>\n
                        <td>" . $fila["CodigoPostal"] . "</td>\n
                        <td><form action='modificar-perfil.php' method='GET' id='modificarPerfil'>
                            <a type='submit' class='btn btn-secondary' name='modificarPerfil' href='modificar-perfil.php?modificarPerfil=" . $fila["Remitente_destinatario_id"] . "''>Modificar</a>&nbsp;
                            <a class='btn btn-outline-dark' name='eliminarPerfil' href='modificar-perfil.php?eliminarPerfil=" . $fila["Remitente_destinatario_id"] . "''>Eliminar</a>
                            </form>
                        </td>
                    </tr>
                </table>";
            }
        }  
    ?>      

    </main>

</body>
</html>