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
$r = $select->validaUsuario($Nm_Usuario, $Ds_Senha);
 
# se erro
if( $r === false )
    __output_header__( false, 'Usuário não encontrado.', null);
 
# se sucesso
__output_header__( true, null, $r );
?>