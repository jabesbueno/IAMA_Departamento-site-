<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoHistoricoNotificacao.php";  
 
# verificando se estamos recebendo um POST. Não aceitamos GET
if( $_SERVER['REQUEST_METHOD'] !== "POST" )
    __output_header__( false, "Método de requisição não aceito.", null );
 
 
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
?>