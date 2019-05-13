<?php
        //session_start();
        include '../../../config/conexionBD.php';

        if (!empty($_POST)) {

            if (empty($_POST['idusuario'])) {
                header("location: index.php");
            }

            $idusuario = $_POST['idusuario'];
            $sql2 = "UPDATE usuario SET usu_eliminado = 1 WHERE usu_codigo = $idusuario";

            if ($conn->query($sql2) === TRUE) {             
                echo "Eliminado Correctamente";
                header("location: index.php");
                    
            } else {             
                echo "Error al eliminar";            
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
                    $correo = $row["usu_correo"];                
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
    <title>Eliminar Usuario</title> 
    <style type="text/css" rel="stylesheet"> 
        .error{             color: red; 
        } 
    </style> 
</head> 
<body> 
 
    <section>

        <div>
            <h2> Esta seguro de eliminar el siguiente usuario ? </h2>
            <p> Nombres: <span><?php echo $nombres; ?></span> </p>
            <p> Apellidos: <span><?php echo $apellidos; ?></span> </p>
            <p> Cedula: <span><?php echo $cedula; ?></span> </p>
            <p> Correo: <span><?php echo $correo; ?></span> </p>
        </div>

        <form method="post" action=""> 
            <input type="hidden" name="idusuario" value="<?php echo $id; ?>">
            <a href="index.php"> Cancelar </a>
            <input type="submit" value="Eliminar" >
        </form>

    </section>

 
</body> 
</html> 