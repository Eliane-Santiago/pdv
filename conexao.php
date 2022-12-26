<?php 

//INCLUINDO O ARQUIVO DE CONFIGURAÇÃO
require_once('config.php');

//CONFIGURANDO O FUSO HORÁRIO DO FUSO
date_default_timezone_set('America/Fortaleza');


//FAZENDO O TRAMENTO DE POSSÍVEIS ERROS DE ACESSO AO BD
try {
	//CRIANDO O OBJETO DA CONEXÃO COM O BD
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo "Erro ao conectar com o Banco de Dados! <br>".$e;
}

 ?>