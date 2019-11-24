<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoHistoricoNotificacao.php";
include_once "../dao/daoUsuario.php";  
#--------------------------------------------------------
# verificando se estamos recebendo um POST. Não aceitamos GET
	if( $_SERVER['REQUEST_METHOD'] !== "POST" )
		__output_header__( false, "Método de requisição não aceito.", null );
	
$r = false;
$contador = 0;
$token = $_POST['Ds_Autorizacao'];
$ID_Notificacao = $_POST['ID_Notificacao'];

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
	$select = new DaoHistoricoNotificacao();
	$result = $select->buscaHistoricoESP($ID_Notificacao);
	
	$r = array();
	$i = 0;
	while($res = $result->fetch())
	{
		$r[$i]['ID_Historico'] = $res['ID_Historico'];
		$r[$i]['ID_Notificacao'] = $res['ID_Notificacao'];
		$r[$i]['Dt_Historico'] = $res['Dt_Historico'];
		$r[$i]['Ds_Observacao'] = utf8_encode($res['Ds_Observacao']);
		$i++;
	}
	# se erro
	if( $r === false )
		__output_header__( false, 'Não há notificações!', null);
	
	# se sucesso
	__output_header__( true, null, $r);
}
?>