<?php
session_start();
include("conexion.php");
$conexion = conecDb();
$q = "SELECT id_usuario, username FROM usuario WHERE username ='".$_GET['txtUsuario']."' and
    pass = MD5('".$_GET['txtClave']."')";
$rs = mysql_query($q,$conexion) or die ($q);

if(mysql_num_rows($rs)==1){    
    $row  = mysql_fetch_row($rs);
    //    session_register('user');
    $_SESSION['userId'] = $row[0];
    $_SESSION['user'] = $row[1];
    $_SESSION['wpass'] = null;
    header ('Location: index.php');
}else{
    $_SESSION['wpass'] ='1';
    header ('Location: index.php');
}
?>