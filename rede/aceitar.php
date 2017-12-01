<?php
	session_start();
	//Conexão com BDD
	$usuario = "root";
	$senha = "";
	$servidor = "localhost";
	$bddnome = "cadastros";
	$conexao = mysqli_connect($servidor,$usuario,$senha,$bddnome);
	if(!$conexao){
		echo "Sem conexao";
	}
	
	$id = $_SESSION['id'];
	$add = $_GET['user'];
	echo $add;
	$modificar = mysqli_query ($conexao,"UPDATE amizade
			SET status = 'amigo'
			WHERE convite = $add and convidado = $id");
	header("Location: home.php");

?>