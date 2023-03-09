<?php
require_once("../conexao.php"); //CHAMANDO O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS


//CRIANDO A VARIÁVEL E ASSOCIANDO AO POST DOS CAMPOS
$nome = $_POST['input-nome-perfil'];
$email = $_POST['input-email-perfil'];
$cpf = $_POST['input-cpf-perfil'];
$senha = $_POST['input-senha-perfil'];
$nivel = $_POST['nivel-perfil'];
$id = $_POST['id-perfil'];

$antigoCPF = $_POST['antigoCPF-perfil'];
$antigoEMAIL = $_POST['antigoEMAIL-perfil'];

//TRATANDO O NÃO PREENCHIMENTO DO CAMPO (USE O required="" nas tags dos input)
/*
if($nome == ""){
	echo "Preencha o Campo Nome!";
}
*/

//OBS: SEMPRE QUE OS DADOS VINHEREM DO FORMULARIO USE PREPARE


//EVITANDO DUPLICIDADE NO REGISTRO E-MAIL
if($antigoEMAIL != $email){
	$query_con = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");

	$query_con->bindValue(":email", $email);
	$query_con->execute(); 
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

	//VERIFICANDO SE O E-MAIL JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
	if(@count($res_con) > 0){
		echo "Esse e-mail já está em uso com outro usuário.";
		exit();
	}
}

//EVITANDO DUPLICIDADE NO REGISTRO CPF
if($antigoCPF != $cpf){
	$query_con = $pdo->prepare("SELECT * FROM usuarios WHERE cpf = :cpf");

	$query_con->bindValue(":cpf", $cpf);
	$query_con->execute(); 
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

	//VERIFICANDO SE O CPF JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
	if(@count($res_con) > 0){
		echo "Esse cpf já está em uso com outro usuário.";
		exit();
	}
}



	//EDITANDO OS DADOS NO BANCO DE DADOS
	$res = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha WHERE id = :id");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":email", $email);
	$res->bindValue(":cpf", $cpf);
	$res->bindValue(":senha", $senha);
	$res->bindValue(":id", $id);
	$res->execute(); 



echo 'Salvo com Sucesso!';



?>