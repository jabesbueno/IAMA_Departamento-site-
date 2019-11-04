<?php
#
require_once 'webservice_init.php';
include_once "../dao/daoNoticia.php";
 
# verificando se estamos recebendo um POST. Não aceitamos GET
if( $_SERVER['REQUEST_METHOD'] !== "GET" )
    __output_header__( false, "Método de requisição não aceito.", null );
 
# realizando consulta SQL
$busca = new DaoNoticia();
$r = $busca->buscaNoticia();
$r = $r->fetch();
 
# se erro
if( $r === false )
    __output_header__( false, 'Não há noticias', null);
 
# se sucesso
__output_header__( true, null, $r);
?>