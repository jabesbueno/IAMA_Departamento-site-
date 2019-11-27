<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoNoticia.php";
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
	# realizando consulta SQL
	$busca = new DaoNoticia();
	$result = $busca->buscaNoticia();
	
	$r = array();
	$i = 0;
	while($res = $result->fetch())
	{
		
		$r[$i]['ID_Noticia'] = $res['ID_Noticia'];
		$r[$i]['ID_Usuario'] = $res['ID_Usuario'];
		$r[$i]['Nm_Noticia'] = utf8_encode($res['Nm_Noticia']);
		$r[$i]['Ds_Noticia'] = utf8_encode($res['Ds_Noticia']);
		$r[$i]['Dt_Noticia'] = $res['Dt_Noticia'];
		$r[$i]['Hr_Noticia'] = utf8_encode($res['Hr_Noticia']);
		$i++;
	}
	# se erro
	if( $r === false )
		__output_header__( false, 'Não há noticias!', null);
	
	# se sucesso
	__output_header__( true, null, $r);
}
?>