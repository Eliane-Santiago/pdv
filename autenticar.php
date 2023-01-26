<?php

require_once("conexao.php");

//INICIANDO A VARIÁVEL DE SESSÃO
@session_start();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$query_con = $pdo->prepare("SELECT * FROM usuarios WHERE (email = :usuario or cpf = :usuario) and senha = :senha");

$query_con->bindValue(":usuario", $usuario);
$query_con->bindValue(":senha", $senha);
$query_con->execute(); 
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

//VERIFICANDO SE O E-MAIL JA EXISTE NO BD E PARANDO A INSERSÃO NO BD

if(@count($res_con) > 0){
	$nivel = $res_con[0]['nivel'];

	//CRIANDO AS VARIÁVEIS DE SESSÃO
	$_SESSION['nome_usuario'] = $res_con[0]['nome'];
	$_SESSION['nivel_usuario'] = $res_con[0]['nivel'];
	$_SESSION['cpf_usuario'] = $res_con[0]['cpf'];

	//REDIRECIONAMENTO E MENSAGEM VIA SCRIPT
	if($nivel == 'Administrador'){
		echo "<script language='javascript'> window.location='painel-adm'; </script>";
	}

	if($nivel == 'Operador'){
		echo "<script language='javascript'> window.location='painel-operador'; </script>";
	}

	if($nivel == 'Tesoureiro'){
		echo "<script language='javascript'> window.location='painel-tesoreiro'; </script>";
	}
}else{

	echo "<script language='javascript'> window.alert('Dados Incorretos'); </script>";

	echo "<script language='javascript'> window.location='index.php'; </script>";
}


?>