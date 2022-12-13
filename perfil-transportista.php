<?php

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">

    <title>Perfil usuario transportista</title>
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

        $id = getIdT($_SESSION['email']);
        $datos = perfilTransportista($id);

        if (is_string($datos)){
            return $datos;
        }else{
            echo "<table  class='table table-hover'>\n
            <tr>\n
                <th scope='col'>ID</th>\n
                <th scope='col'>CIF</th>\n
                <th scope='col'>Nombre</th>\n
                <th scope='col'>Empresa</th>\n
                <th scope='col'>Email</th>\n
                <th scope='col'>Teléfono</th>\n
            </tr>\n";

            while ($fila = mysqli_fetch_assoc($datos)){
                
                echo "
                    <tr class='table-primary'>\n
                        <th scope='row'>" . $fila["Transportista_id"] . "</th>\n
                        <td>" . $fila["Cif"] . "</td>\n
                        <td>" . $fila["Nombre"] . "</td>\n
                        <td>" . $fila["NombreEmpresa"] . "</td>\n
                        <td>" . $fila["Email"] . "</td>\n
                        <td>" . $fila["Telefono"] . "</td>\n
                    </tr>
                </table>
            
            <div align=center class='mt-4'>
                <form action='modificar-perfil-transportista.php' method='GET' id='modificarPerfilTransportista'>
                    <a type='submit' class='btn btn-secondary' name='modificarPerfilTransportista' href='modificar-perfil-transportista.php?modificarPerfilTransportista=" . $fila["Transportista_id"] . "''>Modificar</a>&nbsp;
                    <a type='submit' class='btn btn-outline-dark' name='eliminarPerfilTransportista' href='modificar-perfil-transportista.php?eliminarPerfilTransportista=" . $fila["Transportista_id"] . "''>Eliminar</a>
                </form>
            </div>";
            }
        } ?> 
      

    </main>

</body>
</html>