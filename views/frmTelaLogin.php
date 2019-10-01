<?php
ini_set('default_charset','UTF-8');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); 
session_start();
$_SESSION['session_usuarioLogado'] = null;

if(!isset($_SESSION['session_validaLogin'])) $_SESSION['session_validaLogin'] = '';
if(!isset($_SESSION['session_validarUsuario'])) $_SESSION['session_validarUsuario'] = '';
if(!isset($_SESSION['session_validarSenha'])) $_SESSION['session_validarSenha'] = '';
?>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Departamento de Meio Ambiente</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/javascripts-abas.php"></script>
</head>

<body style="background-color:'gray'">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">MEIO AMBIENTE</a>
			</div>
		</div>
	</nav>
	<br>
	<br>
	<br>
	<br>
	<form class="formLogin" id="formLogin" method="post" action="../controllers/controllerUsuario.php">
		<br>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-offset">
				<div class="col-md-4 ">
					<?php echo '<div style="Color:red">' . nl2br($_SESSION['session_validaLogin']) . '</div>'?>                            
					<label for="Nm_Usuario">Nome do Usuario</label>
					<input type="user" id="Nm_Usuario" name="Nm_Usuario" class="form-control" placeholder="Usuário" required="Digite seu nome de usuário">
					<?php echo '<div style="Color:red">' . nl2br($_SESSION['session_validarUsuario']) . '</div>'?>
				</div>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-offset">
				<div class="col-md-4">
					<label for="Ds_Senha">Senha</label>
					<input type="password" id="Ds_Senha" name="Ds_Senha" class="form-control" placeholder="******" required="Digite sua senha">
					<?php echo '<div style="Color:red">' . nl2br($_SESSION['session_validarSenha']) . '</div>'?>
				</div>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-3">
						<button  type="submit" class="btn btn-lg btn-primary btn-block" name="botao" value="4">Entrar</button>
					</div>
				</div>
				<div class="col-md-4">
				</div>
			</div>
			
		</form>
		
	</body>
	</html>