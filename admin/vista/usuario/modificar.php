<?php
        //session_start();
        include '../../../config/conexionBD.php';

        if (!empty($_POST)) {

            if (empty($_POST['idusuario'])) {
                header("location: index.php");
            }

            $nCedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null; 
            $nNombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null; 
            $nApellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null; 
            $nDireccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null; 
            $nTelefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]): null;         
            $nCorreo = isset($_POST["correo"]) ? trim($_POST["correo"]): null; 
            $nFechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]): null;

            $idusuario = $_POST['idusuario'];
            $sql2 = "UPDATE usuario SET usu_cedula = '$nCedula', 
                                        usu_nombres = '$nNombres',
                                        usu_apellidos = '$nApellidos',
                                        usu_direccion = '$nDireccion',
                                        usu_telefono = '$nTelefono',
                                        usu_correo = '$nCorreo',
                                        usu_fecha_nacimiento = '$nFechaNacimiento'
                                    WHERE usu_codigo = $idusuario";

            if ($conn->query($sql2) === TRUE) {             
                echo "Modificado Correctamente";
                header("location: index.php");                   
            } else {             
                echo "Error al modificar";
                echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";           
            }

        }

        if (empty($_REQUEST['id'])) {
            header("location: index.php");
            $conn->close(); 
        } else {
            $id = $_REQUEST['id'];

            
            $sql = "SELECT * FROM usuario WHERE usu_codigo = $id AND usu_eliminado = 0";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) { 
                 
                while($row = $result->fetch_assoc()) {    
                    $cedula = $row["usu_cedula"];
                    $nombres = $row["usu_nombres"];
                    $apellidos = $row["usu_apellidos"];
                    $direccion = $row["usu_direccion"];
                    $telefono = $row["usu_telefono"];
                    $correo = $row["usu_correo"];
                    $fecha_nacimiento = $row["usu_fecha_nacimiento"];            
                }
    
            } else { 
                header("location: index.php");
            }

        }

        //incluir conexión a la base de datos         
        

        //$id = isset($_GET['usu_codigo']) ? $_GET['usu_codigo']: null;
        //$sql = 'UPDATE usuario SET usu_eliminado = 1 WHERE usu_codigo = ?';
        
        
        
        //cerrar la base de datos
        $conn->close();    
        echo "<a href='index.php'>Regresar</a>";
?>

<!DOCTYPE html> 
<html> 
<head> 
<meta charset="UTF-8"> 
    <title>Modificar Usuario</title> 
    <style type="text/css" rel="stylesheet"> 
        .error{             color: red; 
        } 
    </style> 
</head> 
<body> 
 
    <section>

        <div>
        <form id="formulario01" method="POST" action=""> 

            <h2> Modificar Campos: </h2>
            <br>

            <label for="cedula">Cedula (*)</label> 
            <input type="text" id="cedula" name="cedula" value=<?php echo $cedula; ?> placeholder="Ingrese el número de cedula ..." required/> 
            <br> 
 
            <label for="nombres">Nombres (*)</label> 
            <input type="text" id="nombres" name="nombres" value="<?php echo $nombres; ?>" placeholder="Ingrese sus dos nombres ..." required/> 
            <br> 
 
            <label for="apellidos">Apelidos (*)</label> 
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" placeholder="Ingrese sus dos apellidos..." required/> 
            <br> 
 
            <label for="direccion">Dirección (*)</label> 
            <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>" placeholder="Ingrese su dirección ..." required/> 
            <br> 

            <label for="telefono">Teléfono (*)</label> 
            <input type="text" id="telefono" name="telefono" value=<?php echo $telefono; ?> placeholder="Ingrese su número telefónico ..." required/> 
            <br>                 
 
            <label for="fecha">Fecha Nacimiento (*)</label> 
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fecha_nacimiento; ?>" placeholder="Ingrese su fecha de nacimiento ..." required/> 
            <br> 
 
            <label for="correo">Correo electrónico (*)</label> 
            <input type="email" id="correo" name="correo" value=<?php echo $correo; ?> placeholder="Ingrese su correo electrónico ..." required/> 
            <br>
            <br> 
 
            <input type="hidden" name="idusuario" value="<?php echo $id; ?>">
            <a href="index.php"> Cancelar </a>
            <input type="submit" value="Modificar" >

        </form>     
        </div>


        <div>
            
            
        </div>

    </section>

 
</body> 
</html> 