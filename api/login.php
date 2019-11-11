<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoUsuario.php";  
 
# verificando se estamos recebendo um POST. Não aceitamos GET
if( $_SERVER['REQUEST_METHOD'] !== "POST" )
    __output_header__( false, "Método de requisição não aceito.", null );
 
 
# setando o que sera pesquisado no banco de dados
$Nm_Usuario = $_POST['Nm_Usuario'];
$Ds_Senha = $_POST['Ds_Senha'];
 
# realizando consulta SQL
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
# se erro
if( $r === false )
    __output_header__( false, 'Usuário não encontrado.', null);
//Aplicação
$key = 'iama123456';
//Header - Token
$header = [
			'typ' => 'JWT',
			'alg' => 'HS256'
		];
//Payload - Content
$payload = [
			'exp' => (new DateTime("now"))->getTimestamp(),
			'Nm_Usuario' => $Nm_Usuario,
			'Ds_Senha' => $Ds_Senha,
		];
//JSON		
$header = json_encode($header);
$payload = json_encode($payload);
//Base 64
$header = base64_encode($header);
$payload = base64_encode($payload);
//Sign
$sign = hash_hmac('sha256', $header . "." . $payload, $key, true);
$sign = base64_encode($sign);

$r = $header . '.' . $payload . '.' . $sign;		
# se sucesso
__output_header__( true, 'logado', $r );
?>