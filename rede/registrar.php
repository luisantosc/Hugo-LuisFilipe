<?php
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$c = false;
			$nome = $_POST['nome'];
			$snome = $_POST['snome'];
			$email = $_POST['email'];
			$cemail = $_POST['cemail'];
			$unome = $_POST['unome'];
			$passw = $_POST['senha'];
			$cpassw = $_POST['csenha'];
			$sexo = $_POST['sexo'];
			$data = $_POST['data'];
			
			$usuario = "root";
			$senha = "";
			$servidor = "localhost";
			$bddnome = "cadastros";
			header('Content-Type: text/html, charset-utf-8');
			$conexao = mysqli_connect($servidor,$usuario,$senha,$bddnome);
			
			if(!$conexao){
				echo "Sem conexao";
			}
			// Validação
			$erro = false;
			
			if(filter_var($email,FILTER_VALIDATE_EMAIL)=== false){
				$erro = true;
			}
			if($passw != $cpassw || $email != $cemail){
				$erro = true;
			}
			$arrayData = explode("-",$data);
				$a = $arrayData[0];
				$m = $arrayData[1];
				$d = $arrayData[2];
			 
				// verifica se a data é válida!
				// 1 = true (válida)
				// 0 = false (inválida)
				$res = checkdate($m,$d,$a);
				if ($res != 1){
				   $erro = true;
				} 
			
			
			
			if($erro == false){
				$select = mysqli_query ($conexao,'SELECT * FROM cadastro');
				while($linha = mysqli_fetch_array($select)){
					if($linha["username"] == $unome || $linha["username"] ==  strtoupper($unome) || trim($linha["username"])== $unome){
						$c = true;
						break;
					}
				}
				if($c==false){
					$select = mysqli_query ($conexao,'SELECT max(id) FROM cadastro');
					$linha = mysqli_fetch_array($select);
					$novoId = $linha["max(id)"]+1;
					$passw = hash("sha512",$passw);
					$snome = trim($snome);
					$unome = trim($unome);
					mysqli_query($conexao, "INSERT INTO cadastro(id,nome,sobrenome,username,senha,email,sexo) VALUES
					($novoId,'$nome','$snome','$unome','$passw','$email','$sexo')") or die ("Erro ao cadastrar");
					header ("Location: login.php");
				}
				else{
					echo "Usuario '". $unome ."' ja existe";
				}
			}
			else{
				echo "Erro ao cadastrar";
			}
			mysqli_close($conexao);
		}
	?>