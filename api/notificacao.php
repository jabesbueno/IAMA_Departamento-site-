<?php
# 
ini_set('default_charset','UTF-8');
date_default_timezone_set('America/Sao_Paulo');
# obtendo nosso arquivo de configuracões
require_once 'webservice_init.php';
include_once "../classes/classeNotificacao.php";
include_once "../classes/classeHistoricoNotificacao.php";
include_once "../dao/daoNotificacao.php";
include_once "../dao/daoHistoricoNotificacao.php";
include_once "../dao/daoUsuario.php";  
#--------------------------------------------------------
$r = false;
$contador = 0;
$token = $_POST['Ds_Autorizacao'];
if($token == "")
{
	__output_header__( false, 'Não autorizado', null);
}

for($i = 0; $i < strlen($token); $i++)
{
	if($token[$i] == ".")
	{
		$contador .= 1;
	}
}

if($contador != 2 )
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
	# verificando se o método de envio é mesmo  POST.
	if( $_SERVER['REQUEST_METHOD'] !== "POST" )
		__output_header__( false, "Método de requisição não aceito.", null );
	
	# Se você usa uma Framework, ou esta fazendo código Puro, 
	# obtenha e processe aqui os dados através do $_POST
	//atribuição dos valores nas váriaveis via POST
	$_dados['Nm_Bairro'] = $_POST['Nm_Bairro'];
	$_dados['Nm_Rua'] = $_POST['Nm_Rua'];
	$_dados['Dt_Notificacao'] = date('Y-m-d');
	$_dados['Ds_PontoProximo'] = $_POST['Ds_PontoProximo'];
	$_dados['Ds_Notificacao'] = $_POST['Ds_Notificacao'];
	$_dados['ID_Notificacao'] = "";
	$_dados['St_Notificacao'] = "ATIVA";
	$_dados['ID_Usuario'] = "1";
	
	//Imagem
	$instancia = new DaoNotificacao();
	$ID_Notificacao = $instancia->retornaUltimoId();
	$ID_Notificacao += 1;
	
	$diretorio = "../resources/img/{$ID_Notificacao}/";
	if(!file_exists($diretorio)) mkdir($diretorio, 0777);
	$arquivos = glob($diretorio . 'notificacao.*');
	foreach ($arquivos as $arquivo) {
		unlink($arquivo);
	}
	$extensao = strtolower(substr($_FILES['Ft_Notificacao']['name'], -4));
	
	$novo_nome = $diretorio.'notificacao'.$extensao;
	
	
	move_uploaded_file($_FILES['Ft_Notificacao']['tmp_name'],$novo_nome);
	
	$_dados['Ft_Notificacao'] = $novo_nome;
	
	// Adicionando valores ao objeto
	$notificacao = new classeNotificacao($_dados['Nm_Bairro'], $_dados['Nm_Rua'], $_dados['Dt_Notificacao'], $_dados['Ds_PontoProximo'], $_dados['Ft_Notificacao'], $_dados['Ds_Notificacao'], $_dados['St_Notificacao'], $_dados['ID_Usuario'], $_dados['ID_Notificacao']);		
	
	# se você usa PHP Puro , use aqui um mysql_insert e escreva a consulta.
	//Instânciando 
	$instancia = new DaoNotificacao();
	$r = $instancia->inserirNotificacao($notificacao);
	//Salvando Histórico
	$instanciaHistorico = new DaoHistoricoNotificacao();
	$Dt_Historico = date('Y-m-d H:i:s');
	$Ds_Observacao = "";
	$ID_Notificacao = $instancia->retornaUltimoId();
	$ID_Historico = 1;
	
	$historico = new classeHistoricoNotificacao($Dt_Historico, $Ds_Observacao, $ID_Notificacao, $ID_Historico);
	$instanciaHistorico->inserirHistorico($historico);
	
	if( $r === false )
		__output_header__( false, 'Erro ao subir notificação', null);
	
	__output_header__( ($r > 0), "Notificação adicionada com sucesso", $_dados );
}
#
?>