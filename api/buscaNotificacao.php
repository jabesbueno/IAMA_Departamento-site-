<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoNotificacao.php";
include_once "../dao/daoUsuario.php";  
#--------------------------------------------------------
# verificando se estamos recebendo um GET. Não aceitamos POST
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
	$ID_Usuario = $select->buscaId($Nm_Usuario);
	# realizando consulta SQL
	$busca = new DaoNotificacao();
	$result = $busca->buscaNotificacaoById($ID_Usuario);
	
	$r = array();
	$i = 0;
	while($res = $result->fetch())
	{
		
		$r[$i]['ID_Notificacao'] = $res['ID_Notificacao'];
		$r[$i]['Nm_Bairro'] = utf8_encode($res['Nm_Bairro']);
		$r[$i]['Nm_Rua'] = utf8_encode($res['Nm_Rua']);
		$r[$i]['Dt_Notificacao'] = $res['Dt_Notificacao'];
		$r[$i]['Ds_PontoProximo'] = utf8_encode($res['Ds_PontoProximo']);
		$r[$i]['Ft_Notificacao'] = utf8_encode($res['Ft_Notificacao']);
		$r[$i]['Ds_Notificacao'] = utf8_encode($res['Ds_Notificacao']);
		$r[$i]['St_Notificacao'] = utf8_encode($res['St_Notificacao']);
		$r[$i]['ID_Usuario'] = utf8_encode($res['ID_Usuario']);
		$i++;
	}
	# se erro
	if( $r === false )
		__output_header__( false, 'Não há notificações!', null);
	
	# se sucesso
	__output_header__( true, null, $r);
}
?>