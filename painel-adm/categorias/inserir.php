<?php
require_once("../../conexao.php"); //CHAMANDO O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS


//CRIANDO A VARIÁVEL E ASSOCIANDO AO POST DOS CAMPOS
$nome = $_POST['input-nome'];

$id = $_POST['id'];

$antigo = $_POST['antigo'];


//EVITANDO DUPLICIDADE NO REGISTRO NOME DA CATEGORIA
if($antigo != $nome){
	$query_con = $pdo->prepare("SELECT * FROM categorias WHERE nome = :nome");

	$query_con->bindValue(":nome", $nome);
	$query_con->execute(); 
	$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC); // ESSE COMANDO É PARA SER USADO SOMENTE NO SELECT

	//VERIFICANDO SE O NOME DA CATEGORIA JA EXISTE NO BD E PARANDO A INSERSÃO NO BD
	if(@count($res_con) > 0){
		echo "Categoria já cadastrada.";
		exit();
	}
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = preg_replace('/[ -]+/' , '-' , @$_FILES['imagem']['name']);
$caminho = '../../img/categorias/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}

//OBS: IMPORTÂNCIA DO AJAX NO CÓDIGO, É QUE MESMO DEPOIS DA MENSAGEM DO ERRO OS DADOS PERMANECEM NA PÁGINA MODAL PERMITE QUE O ERRO ESSA CORRIGIDO E O USUÁRIO CONTINUE COM A INSERINDO OS DADOS NO BD

if($id == ""){

	//INSERINDO DADOS NO BANCO DE DADOS
	$res = $pdo->prepare("INSERT INTO categorias SET nome = :nome, foto = :foto");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":foto", $imagem);
	$res->execute(); 	

}else{

	if($imagem != 'sem-foto.jpg'){
		//EDITANDO OS DADOS NO BANCO DE DADOS
		$res = $pdo->prepare("UPDATE categorias SET nome = :nome, foto = :foto WHERE id = :id");

		$res->bindValue(":foto", $imagem);
	}else{
		//EDITANDO OS DADOS NO BANCO DE DADOS
		$res = $pdo->prepare("UPDATE categorias SET nome = :nome WHERE id = :id");
	}

	
	$res->bindValue(":nome", $nome);
	$res->bindValue(":id", $id);
	$res->execute(); 

}



echo 'Salvo com Sucesso!';



?>