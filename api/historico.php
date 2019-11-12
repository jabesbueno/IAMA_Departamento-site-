<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoHistoricoNotificacao.php";
include_once "../dao/daoUsuario.php";  
#--------------------------------------------------------
# verificando se o método de envio é mesmo  POST.
	if( $_SERVER['REQUEST_METHOD'] !== "POST" )
		__output_header__( false, "Método de requisição não aceito.", null );

$r = false;
$contador = 0;
$token = $_POST['Ds_Autorizacao'];
if($token === "")
{
	__output_header__( false, 'Não autorizado', null);
}

for($i = 0; $i < strlen($token); $i++)
{
	if($token[$i] == ".")
	{
		$contador = $contador + 1;
	}
}

if($contador !== 2 )
{
	__output_header__( false, 'Não autorizado', null);
}
else
{
	$autorizacao = explode('.',$token);
	$teste = $autorizacao[1];
	$teste = base64_decode($teste);
	$array = array();
	$teste = json_decode($teste);
	foreach($teste as $teste2)
	{
		$array[] = $teste2;
	}
	$Nm_Usuario = $array[1];
	$Ds_Senha = $array[2];
}
$select = new DaoUsuario();
$valida = $select->validaUsuario($Nm_Usuario, $Ds_Senha);
if($valida == 0)
{
	$r = false;
}
else
{
	$r = true;
}

if($r == false)
{
	__output_header__( false, 'Não autorizado', null);
}
else{  
	# setando o que sera pesquisado no banco de dados
	$ID_Notificacao = $_POST['ID_Notificacao'];
	
	# realizando consulta SQL
	$select = new DaoHistoricoNotificacao();
	$r = $select->buscaHistorico($ID_Notificacao);
	
	# se erro
	if( $r === false )
		__output_header__( false, 'Notificação não encontrada.', null);
	
	# se sucesso
	__output_header__( true, 'Descrição da notificação', $r );
}
?>