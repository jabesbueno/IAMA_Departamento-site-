<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoEvento.php";  
 
# verificando se estamos recebendo um POST. Não aceitamos GET
if( $_SERVER['REQUEST_METHOD'] !== "GET" )
    __output_header__( false, "Método de requisição não aceito.", null );
 
# realizando consulta SQL
$busca = new DaoEvento();
$r = $busca->buscaEvento();
$r = $r->fetch();
 
# se erro
if( $r === false )
    __output_header__( false, 'Não há eventos', null);
 
# se sucesso
__output_header__( true, null, $r);
?>