<?php

    function crearConexion($database){
        $host = "localhost";
        $user = "root";
        $password = "";

        $conexion = mysqli_connect($host, $user, $password, $database);

        if (!$conexion) {
            die("<br>Error de conexión con la base de datos") . mysqli_connect_error();
        }
        return $conexion;
    }

    function crearRtteDest($cifDni, $nombre, $nombreEmpresa, $email, $telefono, $direccion, $codigoPostal, $contrasenia){

        $DB = crearConexion("bdTruckup");
		$sql = "INSERT INTO remitente_destinatario (CifDni, Nombre, NombreEmpresa, Email, Telefono, Direccion, CodigoPostal, Contrasenia) 
		VALUES ('" . $cifDni . "' 
		, '" . $nombre . "' 
		, '" . $nombreEmpresa . "' 
		, '" . $email . "'
        , '" . $telefono . "'
        , '" . $direccion . "'
        , '" . $codigoPostal . "'
        , '" . $contrasenia . "'
        )";

		$resultado = mysqli_query($DB, $sql);
		if ($resultado) {
            echo "REMITENTE GUARDADO";
			return $resultado;
		}else{
			echo "Rellena el formulario";
		}
		mysqli_close($DB);
	}
    
    function crearTransportista($cif, $nombre, $nombreEmpresa, $email, $telefono, $contrasenia){

        $DB = crearConexion("bdTruckup");
		$sql = "INSERT INTO transportista (Cif, Nombre, NombreEmpresa, Email, Telefono, Contrasenia) 
		VALUES ('" . $cif . "' 
		, '" . $nombre . "' 
		, '" . $nombreEmpresa . "' 
		, '" . $email . "'
        , '" . $telefono . "'
        , '" . $contrasenia . "'
        )";

		$resultado = mysqli_query($DB, $sql);
		if ($resultado) {
            echo "<div align=center class='mt-4'>TRANSPORTISTA GUARDADO</div>";
			return $resultado;
		}else{
			echo "<div align=center class='mt-4'>Rellena el formulario</div>";
		}
		mysqli_close($DB);
	}

    function comprobarUsuario($email, $contrasenia) {
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM remitente_destinatario WHERE Email = '" . $email . "' AND Contrasenia = '" . $contrasenia . "'";
        $resultado = mysqli_query($DB, $sql);

        $sql1 = "SELECT * FROM transportista WHERE Email = '" . $email . "' AND Contrasenia = '" . $contrasenia . "'";
        $resultado1 = mysqli_query($DB, $sql1);

        if (mysqli_num_rows($resultado) > 0 || mysqli_num_rows($resultado1) > 0){
            
            return true;

        }else{
            
            return false ;
        }
        mysqli_close($DB);
    }
 
    function usuarioRtteDest($email){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM remitente_destinatario WHERE Email = '" . $email . "' ";
        
        $resultado = mysqli_query($DB, $sql);
        
         
        if (mysqli_num_rows($resultado) > 0){
            
            $_SESSION['email'] = $email;

            return true;
                   
        }else{            
            return false;
        }
        mysqli_close($DB);
    }

    function usuariotransportista($email){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM transportista WHERE Email = '" . $email . "' ";
        $resultado = mysqli_query($DB, $sql);
        if(mysqli_num_rows($resultado) > 0){
            $_SESSION['email'] = $email;
            
            return true;
                   
        }else{            
            return false;
        }
        mysqli_close($DB);
    }

    function getID($email){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT Remitente_destinatario_id FROM remitente_destinatario WHERE Email = '" . $email . "' ";        
        $resultado = mysqli_query($DB, $sql);
         
        if($resultado){ 
            $fila = mysqli_fetch_array($resultado);
            return (int)$fila["Remitente_destinatario_id"];
            
         } else{
            return "No se ha podido encontrar al usuario";
         }
    }

    function getIdT($email){

        $DB = crearConexion("bdTruckup");
        $sql = "SELECT Transportista_id FROM transportista WHERE Email = '" . $email . "' ";
        $resultado = mysqli_query($DB, $sql);
        if($resultado){
            $fila = mysqli_fetch_array($resultado);
            return (int)$fila["Transportista_id"];

        }else{
            return "No se ha podido encontrar al usuario";
            }
    }


    function crearEnvio($altura, $anchura, $profundidad, $peso, $fechaSalida, $fechaLlegada, $tipo, $direccionSalida, $cpSalida, $direccionLlegada, $cpLlegada, $nombreDest, $rtteDest){

        $DB = crearConexion("bdTruckup");
		$sql = "INSERT INTO envio_mercancia (Altura, Anchura, Profundidad, PesoKg, FechaSalida, FechaMaxLlegada, TipoID, DireccionSalida, CPSalida, DireccionLlegada, CPLlegada, NombreDest, remitente_destinatario_id) 
		VALUES ('" . $altura . "' 
		, '" . $anchura . "' 
		, '" . $profundidad . "' 
		, '" . $peso . "'
        , '" . $fechaSalida . "'
        , '" . $fechaLlegada . "'
        , '" . $tipo . "'
        , '" . $direccionSalida . "'
        , '" . $cpSalida . "'
        , '" . $direccionLlegada . "'
        , '" . $cpLlegada . "'
        , '" . $nombreDest . "'
        , '" . $rtteDest . "'
        )";

		$resultado = mysqli_query($DB, $sql);
		if ($resultado) {
            
			return $resultado;
		}else{
			echo "Rellena el formulario";
		}
		mysqli_close($DB);
    }


    function listaEnvios(){

        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM envio_mercancia";
        //$sql ="SELECT Envio_mercancia_id, e.Mercancia as Altura, Anchura, Profundidad, PesoKg, FechaSalida, FechaMaxLlegada, DireccionSalida, CPSalida, DireccionLlegada, CPLlegada, NombreDest, r.Nombre as NombreRtte, t.Tipo as Tipo
        //FROM envio_mercancia e INNER JOIN remitente_destinatario r ON e.remitente_destinatario_id = r.Remitente_destinatario_id AND tipo t ON t.TipoID = e.Tipo";
        $resultado = mysqli_query($DB, $sql);

        if (mysqli_num_rows($resultado) > 0){ // Si el resultado de la consulta tiene más de una línea devolvemos el resultado.
			return $resultado;
		} else {
			echo "No hay registros que mostrar."; // Si no, mostramos un mensaje de error.
		}
		mysqli_close($DB); //Cerramos la conexión con la BD.

    }

    function getEnvio($id){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT Envio_mercancia_id FROM envio_mercancia WHERE Envio_mercancia_id =" . $id;
        $resultado = mysqli_query($DB, $sql);
        if($resultado){ 
            $fila = mysqli_fetch_array($resultado);
            return (int)$fila["Envio_mercancia_id"];
        } else{
            return "No se ha podido encontrar el envío";
         }
    }

    function aceptarEnvio($id, $nombreTransportista ,$aceptado, $transportista, $matricula){
        $DB = crearConexion("bdTruckup");
        $sql = "UPDATE envio_mercancia SET NombreTransportista = '" . $nombreTransportista . "'" . 
        ", transportista_id = " . $transportista .
        ", Aceptado = " . $aceptado .
        ", Matricula = '" . $matricula . "'" .
        " WHERE Envio_mercancia_id = " .$id;
        $resultado = mysqli_query($DB, $sql);

        if ($resultado){ // Si el resultado de la consulta tiene al menos una línea devolvemos el resultado.
			
            return $resultado;
		} else {
			echo "Envío no aceptado."; // Si no, mostramos un mensaje de error.
		}
		mysqli_close($DB); //Cerramos la conexión con la BD.
    }

    function getTipo(){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM tipo";
        $resultado = mysqli_query($DB, $sql);
        
        if (mysqli_num_rows($resultado) > 0){ // Si el resultado de la consulta tiene más de una línea devolvemos el resultado.
			return $resultado;
		} else {
			echo "No hay tipos que mostrar."; // Si no, mostramos un mensaje de error.
		}
		mysqli_close($DB);
    }

    function nombreTipo($tipo){

        $datos = getTipo();

        if (is_string($datos)){
            echo $datos;
        } else {
            while ($fila = mysqli_fetch_assoc($datos)){
                if ($tipo == $fila["TipoID"])
                return $fila["Nombre"];
            }
        }
    }


    function getAceptados($id){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM envio_mercancia WHERE Aceptado = 1 AND transportista_id =" . $id;
        $resultado = mysqli_query($DB, $sql);

        if (mysqli_num_rows($resultado) > 0){
            return $resultado;
        }else{
            echo "No hay registros que mostrar";
        }
    }

    function misEnvios($id){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM envio_mercancia WHERE remitente_destinatario_id =" . $id;
        $resultado = mysqli_query($DB, $sql);

        if (mysqli_num_rows($resultado) > 0){
            return $resultado;
        }else{
            echo "No hay registros que mostrar";
        }
    }

    function getEnvioAceptado($aceptado){
        $datos = listaEnvios();

        if (is_string($datos)){
            echo $datos;
        } else {
            
            if ($aceptado == 1){
                return "Aceptado";
            }else{
                return "<p style=color:red;>Sin transporte</p>";
            }
        }
        }

    function idEnvio($id){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM envio_mercancia WHERE Envio_mercancia_id =" . $id;
        $resultado = mysqli_query($DB, $sql);
        if ($resultado){
			return $resultado;
		}else{
			echo "No hay campos que rellenar.";
		}
		mysqli_close($DB);
    }

    function modificarEnvio($id, $altura, $anchura, $profundidad, $peso, $fechaSalida, $fechaLlegada, $tipo, $direccionSalida, $cpSalida, $direccionLlegada, $cpLlegada, $nombreDest){
        $DB = crearConexion("bdTruckup");
        $sql = "UPDATE envio_mercancia SET Altura = '" . $altura . "'" . 
		", Anchura = '" . $anchura . "'" .
		", Profundidad = '" . $profundidad . "'" . 
		", PesoKg = '" . $peso . "'" .
        ", FechaSalida = '" . $fechaSalida . "'" .
        ", FechaMaxLlegada = '" . $fechaLlegada . "'" .
        ", TipoID = '" . $tipo . "'" .
        ", DireccionSalida = '" . $direccionSalida . "'" .
        ", CPSalida = '" . $cpSalida . "'" .
        ", DireccionLlegada = '" . $direccionLlegada . "'" .
        ", CPLlegada = '" . $cpLlegada . "'" .
        ", NombreDest = '" . $nombreDest . "'" .
		" WHERE Envio_mercancia_id = " . $id;
		
		$resultado = mysqli_query($DB, $sql);
		
		if ($resultado){
			return $resultado;
		}else{
			echo "Envío no modificado.";
		}
		mysqli_close($DB);
	
    }

    function borrar($id){
        $DB = crearConexion("bdTruckup");
        $sql = "DELETE FROM envio_mercancia WHERE Envio_mercancia_id =" . $id;
        $resultado = mysqli_query($DB, $sql);
		
		if ($resultado){
			return $resultado;
		}else{
			echo "Envio no eliminado.";
		}
		mysqli_close($DB);

    }

    function condicion($valor){

        if($valor == 1){
            return "En reparto";
        }else{
            return "<input class='form-check-input' type='checkbox' value=1 name='aceptado'>";
        }
    }

    function perfil($id){

        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM remitente_destinatario WHERE Remitente_destinatario_id =" . $id;
        $resultado = mysqli_query($DB, $sql);

		if (mysqli_num_rows($resultado) > 0){
			return $resultado;
		}else{
			echo "No hay perfiles para mostrar.";
		}
		mysqli_close($DB); 
    }


    function modificarPerfil($id, $cifDni, $nombre, $nombreEmpresa, $email, $telefono, $direccion, $codigoPostal, $contrasenia){
        $DB = crearConexion("bdTruckup");
        $sql = "UPDATE remitente_destinatario SET CifDni = " . $cifDni .  
		", Nombre = '" . $nombre . "'" .
		", NombreEmpresa = '" . $nombreEmpresa . "'" . 
		", Email = '" . $email . "'" .
        ", Telefono = " . $telefono .
        ", Direccion = '" . $direccion . "'" .
        ", CodigoPostal =" . $codigoPostal .
        ", Contrasenia = '" . $contrasenia . "'" .
		" WHERE Remitente_destinatario_id = " . $id;
        
		$resultado = mysqli_query($DB, $sql);

		if ($resultado){
			return $resultado;
		}else{
			echo "Perfil no modificado.";
		}
		mysqli_close($DB);
    }

    function eliminarPerfil($id){
        $DB = crearConexion("bdTruckup");
        $sql = "DELETE FROM remitente_destinatario WHERE Remitente_destinatario_id =" . $id;
        $resultado = mysqli_query($DB, $sql);
		
		if ($resultado){
			return $resultado;
		}else{
			echo "Envio no eliminado.";
		}
		mysqli_close($DB);

    }


    function perfilTransportista($id){
        $DB = crearConexion("bdTruckup");
        $sql = "SELECT * FROM transportista WHERE Transportista_id =" . $id;
        $resultado = mysqli_query($DB, $sql);
        if (mysqli_num_rows($resultado) > 0){
			return $resultado;
		}else{
			echo "No hay perfiles para mostrar.";
		}
		mysqli_close($DB); 
    }

    function modificarPerfilTransportista($id, $cif, $nombre, $nombreEmpresa, $email, $telefono, $contrasenia){
        $DB = crearConexion("bdTruckup");
        $sql = "UPDATE transportista SET Cif = '" . $cif . "'" .
		", Nombre = '" . $nombre . "'" .
		", NombreEmpresa = '" . $nombreEmpresa . "'" . 
		", Email = '" . $email . "'" .
        ", Telefono = " . $telefono .
        ", Contrasenia = '" . $contrasenia . "'" .
		" WHERE Transportista_id = " . $id;
        
		$resultado = mysqli_query($DB, $sql);

		if ($resultado){
			return $resultado;
		}else{
			echo "Perfil no modificado.";
		}
		mysqli_close($DB);
    }

    function eliminarPerfilTransportista($id){
        $DB = crearConexion("bdTruckup");
        $sql = "DELETE FROM transportista WHERE Transportista_id =" . $id;
        $resultado = mysqli_query($DB, $sql);
		echo $sql;
		if ($resultado){
			return $resultado;
		}else{
			echo "Usuario no eliminado.";
		}
		mysqli_close($DB);

    }
?>

