<?php 

//INICIANDO A VARIÁVEL DE SESSÃO
@session_start();

//FINALIZANDO A VARIÁVEL DE SESSÃO
@session_destroy();


//REDIRECIONANDO O ACESSO PARA A PAGINA PRINCIPAL
echo "<script language='javascript'> window.location='index.php'; </script>";


 ?>