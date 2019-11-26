<?php
#
ini_set('default_charset','UTF-8');
date_default_timezone_set('America/Sao_Paulo');
require_once 'webservice_init.php';
include_once "../dao/daoEvento.php";
include_once "../dao/daoUsuario.php";  
#--------------------------------------------------------
# verificando se estamos recebendo um GET. Não aceitamos POST
	if( $_SERVER['REQUEST_METHOD'] !== "GET" )
		__output_header__( false, "Método de requisição não aceito.", null );
	
$r = false;
$contador = 0;
$token = $_GET['Ds_Autorizacao'];
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
	# realizando consulta SQL
	$busca = new DaoEvento();
	$result = $busca->buscaEvento();
	
	$r = array();
	$i = 0;
	while($res = $result->fetch())
	{
		$r[$i]['ID_Evento'] = $res['ID_Evento'];
		$r[$i]['ID_Usuario'] = $res['ID_Usuario'];
		$r[$i]['Nm_Evento'] = utf8_encode($res['Nm_Evento']);
		$r[$i]['Dt_Evento'] = $res['Dt_Evento'];
		$r[$i]['Hr_Evento'] = utf8_encode($res['Hr_Evento']);
		$r[$i]['Nm_Local'] = utf8_encode($res['Nm_Local']);
		$r[$i]['Ds_Evento'] = utf8_encode($res['Ds_Evento']);
		$r[$i]['St_Evento'] = utf8_encode($res['St_Evento']);
		$i++;
	}     
		  
	# se erro
	if( $r === false )
		__output_header__( false, 'Não há eventos!', null);
	
	# se sucesso
	__output_header__( true, null, $r);
}
?>