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

	# verificando se o método de envio é mesmo  POST.
	if( $_SERVER['REQUEST_METHOD'] !== "POST" )
		__output_header__( false, "Método de requisição não aceito.", null );
	
	# Se você usa uma Framework, ou esta fazendo código Puro, 
	# obtenha e processe aqui os dados através do $_POST
	//atribuição dos valores nas váriaveis via POST
		$Nm_Bairro = $_POST['Nm_Bairro'];
		$Nm_Rua = $_POST['Nm_Rua'];
		$Dt_Notificacao = date('Y-m-d');
		$Ds_PontoProximo = $_POST['Ds_PontoProximo'];
		$Ds_Notificacao = $_POST['Ds_Notificacao'];
		$ID_Notificacao = "";
		$St_Notificacao = "ATIVA";
		$ID_Usuario = "1";
		
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
		
		$Ft_Notificacao = $novo_nome;
		
		// Adicionando valores ao objeto
		$notificacao = new classeNotificacao($Nm_Bairro, $Nm_Rua, $Dt_Notificacao, $Ds_PontoProximo, $Ft_Notificacao, $Ds_Notificacao, $St_Notificacao, $ID_Usuario, $ID_Notificacao);
	
	# fazendo validacoes basicas. No caso apenas o E-mail
	#if( ! $vita->validate->email( $_dados['email'] ) )
	#    __output_header__( false, 'E-mail inválido.', null);		
	
	# se você usa PHP Puro , use aqui um mysql_insert e escreva a consulta.
	//Instânciando 
	$instancia = new DaoNotificacao();
	$instanciaHistorico = new DaoHistoricoNotificacao();
	// Chamando função para cadastrar usuário no banco de dados
	$Dt_Historico = date('Y-m-d H:i:s');
	$Ds_Observacao = "";
	$ID_Notificacao = $instancia->retornaUltimoId();
	$ID_Historico = 1;
					
	$historico = new classeHistoricoNotificacao($Dt_Historico, $Ds_Observacao, $ID_Notificacao, $ID_Historico);
	$instanciaHistorico->inserirHistorico($historico);
	
	__output_header__( ($r > 0), "Notificação adicionada com sucesso", $_dados );

#
?>