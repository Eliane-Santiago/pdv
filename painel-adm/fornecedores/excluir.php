<?php 
require_once("../../conexao.php"); //CHAMANDO O ARQUIVO DE CONEXÃO COM O BANCO DE DADOS


//CRIANDO A VARIÁVEL E ASSOCIANDO AO POST DOS CAMPOS
$id = $_POST['id'];

$query_con = $pdo->query("DELETE FROM fornecedores WHERE id = '$id'");

echo 'Excluído com Sucesso!';

 ?>