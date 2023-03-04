<?php 


//VERIFICAR PERMISSÃO DO USUÁRIO
IF(@$_SESSION['nivel_usuario'] != 'Administrador'){
  echo "<script language='javascript'> window.location='../index.php'; </script>";
}

 ?>