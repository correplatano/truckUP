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
    
    <title>Envios aceptados</title>
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
            <h2>Portes Aceptados </h2>            
        </div>

        <?php

        include "BaseDatos.php";

        function pintarEnvios(){
            $id = getIdT($_SESSION['email']);
            $datos = getAceptados($id);
        
            if (is_string($datos)){
                return $datos;
            }else{
                echo "<table  class='table table-hover'>\n
                <tr>\n
                        <th scope='col'>ID</th>\n
                        <th scope='col'>Altura</th>\n
                        <th scope='col'>Anchura</th>\n
                        <th scope='col'>Profundidad</th>\n
                        <th scope='col'>Peso</th>\n
                        <th scope='col'>Fecha Salida</th>\n
                        <th scope='col'>Fecha Llegada</th>\n
                        <th scope='col'>Tipo</th>\n
                        <th scope='col'>Dirección Salida</th>\n
                        <th scope='col'>C.P. Salida</th>\n
                        <th scope='col'>Dirección Destino</th>\n
                        <th scope='col'>C.P. Destino</th>\n
                        <th scope='col'>Nombre Destino</th>\n
                        <th scope='col'>Nombre Transportista</th>\n
                        <th scope='col'>Matricula</th>\n
                    </tr>\n";

                while ($fila = mysqli_fetch_assoc($datos)){
                    $tipo = nombreTipo($fila["TipoID"]);
                    echo "
                        <tr class='table-primary'>\n
                            <th scope='row'>" . $fila["Envio_mercancia_id"] . "</th>\n
                            <td>" . $fila["Altura"] . "</td>\n
                            <td>" . $fila["Anchura"] . "</td>\n
                            <td>" . $fila["Profundidad"] . "</td>\n
                            <td>" . $fila["PesoKg"] . "</td>\n
                            <td>" . $fila["FechaSalida"] . "</td>\n
                            <td>" . $fila["FechaMaxLlegada"] . "</td>\n
                            <td>" . $tipo .  "</td>\n
                            <td>" . $fila["DireccionSalida"] . "</td>\n
                            <td>" . $fila["CPSalida"] . "</td>\n
                            <td>" . $fila["DireccionLlegada"] . "</td>\n
                            <td>" . $fila["CPLlegada"] . "</td>\n
                            <td>" . $fila["NombreDest"] . "</td>\n
                            <td>" . $fila["NombreTransportista"] . "</td>\n
                            <td>" . $fila["Matricula"] . "</td>\n
                        </tr>";     
                }
                
            } echo "</table>
                    <div align=center class='mt-4'>
                        <a class='btn btn-outline-warning' href='javascript:history.back()'>Volver</a>
                    </div>";
        }      
        ?>
        
            <div align=center class='mt-4'>
                <?php 
                pintarEnvios();
                ?>
            </div>
        

    </main>
    <footer>
        
    </footer>
</body>
</html>