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
$res = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, nivel = :nivel");

$res->bindValue(":nome", $nome);
$res->bindValue(":email", $email);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":senha", $senha);
$res->bindValue(":nivel", $nivel);
$res->execute();

echo 'Salvo com Sucesso!';


?>