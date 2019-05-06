<?php
    session_start();
    if(isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("location: /SistemaDeGestion/public/vista/login.html");
    }
?>