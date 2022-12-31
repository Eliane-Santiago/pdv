<?php
require_once("../../conexao.php"); //CHAMANDO O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS


//CRIANDO A VARIÁVEL E ASSOCIANDO AO POST DOS CAMPOS
$nome = $_POST['input-nome'];
$email = $_POST['input-email'];
$cpf = $_POST['input-cpf'];
$senha = $_POST['input-senha'];
$nivel = $_POST['nivel'];
//$id = $_POST['id'];

//TRATANDO O NÃO PREENCHIMENTO DO CAMPO (USE O required="" nas tags dos input)
/*
if($nome == ""){
	echo "Preencha o Campo Nome!";
}
*/

//OBS: SEMPRE QUE OS DADOS VINHEREM DO FORMULARIO USE PREPARE


//EVITANDO DUPLICIDADE NO REGISTRO E-MAIL
$query_con = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");

$query_con->bindValue(":email", $email);
$query_con->execute(); 
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

//VERIFICANDO SE O E-MAIL JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
if(@count($res_con) > 0){
	echo "Esse e-mail já está em uso com outro usuário.";
	exit();
}

//EVITANDO DUPLICIDADE NO REGISTRO CPF
$query_con = $pdo->prepare("SELECT * FROM usuarios WHERE cpf = :cpf");

$query_con->bindValue(":cpf", $cpf);
$query_con->execute(); 
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

//VERIFICANDO SE O CPF JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
if(@count($res_con) > 0){
	echo "Esse cpf já está em uso com outro usuário.";
	exit();
}

//OBS: IMPORTÂNCIA DO AJAX NO CÓDIGO, É QUE MESMO DEPOIS DA MENSAGEM DO ERRO OS DADOS PERMANECEM NA PÁGINA MODAL PERMITE QUE O ERRO ESSA CORRIGIDO E O USUÁRIO CONTINUE COM A INSERINDO OS DADOS NO BD

//INSERINDO DADOS NO BANCO DE DADOS
$res = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, nivel = :nivel");

$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":senha", $senha);
$res->bindValue(":nivel", $nivel);
$res->execute(); 

echo 'Salvo com Sucesso!';



?>