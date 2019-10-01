<?php
if(!isset($_SESSION['session_usuarioLogado']) || $_SESSION['session_usuarioLogado'] == '')
{	
	echo 	'<script>
	alert("Acesso restrito!\nFaça o login se quiser acessar essa página.");
	window.location.href="/meioambiente/views/frmTelaLogin.php";
	</script>';
	
	//header("Location: ../frmTelaLogin.php#login");
	
	exit;
}
/*else
{
	if( isset($_SESSION['session_ultimaAtividade']) && (time() - $_SESSION['session_ultimaAtividade'] > 1800) )
	{
		session_unset(); 
		session_destroy(); 
		
		echo 	'<script>
		alert("Sessão finalizada por inatividade!\nPor favor, faça o login novamente.");
		window.location.href="/meioambiente/views/frmTelaLogin.php";
		</script>';
		
		//header("Location: ../frmTelaLogin.php#login")
		
		exit;
	}
	else
	{
		session_regenerate_id(true);
		$_SESSION['session_ultimaAtividade'] = time();
	}
}*/	
?>

