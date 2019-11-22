<?php
if(!isset($_SESSION['session_usuarioLogado']) || $_SESSION['session_usuarioLogado'] == '')
{	
	echo 	'<script>
	alert("Acesso restrito!\nFaça o login se quiser acessar essa página.");
	window.location.href="/meioambiente/views/frmTelaLogin.php";
	</script>';
	session_destroy();	
	exit;
}	
?>

