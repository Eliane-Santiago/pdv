<?php
require_once("../../conexao.php"); //CHAMANDO O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS


//CRIANDO A VARIÁVEL E ASSOCIANDO AO POST DOS CAMPOS
$nome = $_POST['input-nome'];
$tipoPessoa = $_POST['select-tipoPessoa'];
$doc = $_POST['input-doc'];
$email = $_POST['input-email'];
$telefone = $_POST['input-telefone'];
$endereco = $_POST['input-endereco'];
$id = $_POST['id'];

$antigoDOC = $_POST['antigoDOC'];
$antigoEMAIL = $_POST['antigoEMAIL'];

//TRATANDO O NÃO PREENCHIMENTO DO CAMPO (USE O required="" nas tags dos input)
/*
if($nome == ""){
	echo "Preencha o Campo Nome!";
}
*/

//OBS: SEMPRE QUE OS DADOS VINHEREM DO FORMULARIO USE PREPARE


//EVITANDO DUPLICIDADE NO REGISTRO E-MAIL
if($antigoEMAIL != $email){
	$query_con = $pdo->prepare("SELECT * FROM fornecedores WHERE email = :email");

	$query_con->bindValue(":email", $email);
	$query_con->execute(); 
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

	//VERIFICANDO SE O E-MAIL JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
	if(@count($res_con) > 0){
		echo "Esse e-mail já está em uso com outro fornecedor.";
		exit();
	}
}

//EVITANDO DUPLICIDADE NO REGISTRO DOC
if($antigoDOC != $doc){
	$query_con = $pdo->prepare("SELECT * FROM fornecedores WHERE doc = :doc");

	$query_con->bindValue(":doc", $doc);
	$query_con->execute(); 
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

	//VERIFICANDO SE O CPF/CNPJ JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
	if(@count($res_con) > 0){
		echo "Esse CPF/CNPJ já está em uso com outro fornecedor.";
		exit();
	}
}

//OBS: IMPORTÂNCIA DO AJAX NO CÓDIGO, É QUE MESMO DEPOIS DA MENSAGEM DO ERRO OS DADOS PERMANECEM NA PÁGINA MODAL PERMITE QUE O ERRO ESSA CORRIGIDO E O USUÁRIO CONTINUE COM A INSERINDO OS DADOS NO BD

if($id == ""){

	//INSERINDO DADOS NO BANCO DE DADOS
	$res = $pdo->prepare("INSERT INTO fornecedores SET nome = :nome, tipoPessoa = :tipoPessoa, doc = :doc, email = :email, telefone = :telefone, endereco = :endereco");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":tipoPessoa", $tipoPessoa);
	$res->bindValue(":doc", $doc);
	$res->bindValue(":email", $email);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":endereco", $endereco);
	$res->execute(); 	

}else{

	//EDITANDO OS DADOS NO BANCO DE DADOS
	$res = $pdo->prepare("UPDATE fornecedores SET nome = :nome, tipoPessoa = :tipoPessoa, doc = :doc, email = :email, telefone = :telefone, endereco = :endereco WHERE id = :id");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":tipoPessoa", $tipoPessoa);
	$res->bindValue(":doc", $doc);
	$res->bindValue(":email", $email);
	$res->bindValue(":telefone", $telefone);
	$res->bindValue(":endereco", $endereco);
	$res->bindValue(":id", $id);
	$res->execute(); 

}



echo 'Salvo com Sucesso!';



?>