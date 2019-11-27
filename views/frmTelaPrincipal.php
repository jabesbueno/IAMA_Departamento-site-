<?php
	ini_set('default_charset','UTF-8'); 
	session_start();
	require_once "../helpers/checarLogin.php";
?>
<HTML>
    <HEAD>
		<TITLE>Menu Principal</TITLE>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<style>
			img.displayed {
			display: block;
			margin-left: auto;
			margin-right: auto }
		</style>
	</HEAD>
    <BODY>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">IAMA</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="frmGerenciamento.php">Gerenciamento</a></li>
					<!--<li><a class="nav-link" href=""></a></li>-->
					<!--<li><a class="nav-link" href=""></a></li>-->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo utf8_encode($_SESSION['session_usuarioLogado'])?></a>
						<ul class="dropdown-menu" style="background-color:lightgray;">
							<li><a href="">Meus Dados</a></li>
                            <li><a href="frmTelaLogin.php">Sair</a></li>
                        </ul>
					</li>
				</ul>
			</div>
		</nav>
	<div class="container">
		<img src="../assets/img/cidade_limpa.jpg" class="displayed" width="70%" height="70%" alt="Cidade limpa">
	</div>
    </BODY>
</HTML>