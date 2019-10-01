<?php
ini_set('default_charset','UTF-8'); 
include_once "../classes/classeNotificacao.php";
include_once "../dao/daoNotificacao.php";  
include '../libraries/Data_validator.php';
session_start();
$valor = $_POST['botao'];
	switch ($valor) 
	{		
		case 0:
		{
			$_SESSION['sessionNotificacao_ID_Notificacao'] = null;
			$_SESSION['sessionNotificacao_Nm_Bairro'] = null;
			$_SESSION['sessionNotificacao_Nm_Rua'] = null;
			$_SESSION['sessionNotificacao_Dt_Notificacao'] = null;
			$_SESSION['sessionNotificacao_Ds_PontoProximo'] = null;
			$_SESSION['sessionNotificacao_Ft_Notificacao'] = null;
			$_SESSION['sessionNotificacao_Ds_Notificacao'] = null;
			$_SESSION['session_modalNotificacao'] = null;
			$_SESSION['session_acaoNotificacao'] = null;
		}
		case 1: 
		{		
			$validate = new Data_validator();
				
			$validate->define_pattern('erro_', '');
	
			$validate->set('Nm_Bairro', $_POST['Nm_Bairro'])->is_required()
					 ->set('Nm_Rua', $_POST['Nm_Rua'])->is_required()
					 ->set('Dt_Notificacao', $_POST['Dt_Notificacao'])->is_required()
					 ->set('Ds_PontoProximo', $_POST['Ds_PontoProximo'])->is_required()
					 ->set('Ft_Notificacao', $_POST['Ft_Notificacao'])->is_required()
					 ->set('Ds_Notificacao', $_POST['Ds_Notificacao'])->is_required();
			
					
			// Todos os dados foram validados com sucesso;
			if($validate->validate())
			{
				$notificacao = pegaValores();
				//Instânciando
				$instancia = new DaoNotificacao();
				if($_POST['acao'] == 'adicionar')
				{	
					// Chamando função para cadastrar noticia no banco de dados
					$instancia->inserirNotificacao($notificacao);
				}
				else
				{				
					// Chamando função para cadastrar noticia no banco de dados
					$instancia->atualizarNotificacao($notificacao);
				}
				
				$_SESSION['sessionNotificacao_ID_Notificacao'] = null;
				$_SESSION['sessionNotificacao_Nm_Bairro'] = null;
				$_SESSION['sessionNotificacao_Nm_Rua'] = null;
				$_SESSION['sessionNotificacao_Dt_Notificacao'] = null;
				$_SESSION['sessionNotificacao_Ds_PontoProximo'] = null;
				$_SESSION['sessionNotificacao_Ft_Notificacao'] = null;
				$_SESSION['sessionNotificacao_Ds_Notificacao'] = null;
			}
			else
			{
				if($validate->get_errors() != null)
				{
					$erros = $validate->get_errors();
											
					if (isset($erros['erro_Nm_Bairro'][0]) != null) $_SESSION['sessionNotificacao_Nm_Bairro'] = "• " . $erros['erro_Nm_Bairro'][0];
					if (isset($erros['erro_Nm_Rua'][0]) != null) $_SESSION['sessionNotificacao_Nm_Rua'] = "• " . $erros['erro_Nm_Rua'][0];
					if (isset($erros['erro_Dt_Notificacao'][0]) != null) $_SESSION['sessionNotificacao_Dt_Notificacao'] = "• " . $erros['erro_Dt_Notificacao'][0];
					if (isset($erros['erro_Ds_PontoProximo'][0]) != null) $_SESSION['sessionNotificacao_Ds_PontoProximo'] = "• " . $erros['erro_Ds_PontoProximo'][0];
					if (isset($erros['erro_Ft_Notificacao'][0]) != null) $_SESSION['sessionNotificacao_Ft_Notificacao'] = "• " . $erros['erro_Ft_Notificacao'][0];
					if (isset($erros['erro_Ds_Notificacao'][0]) != null) $_SESSION['sessionNotificacao_Ds_Notificacao'] = "• " . $erros['erro_Ds_Notificacao'][0];
				}
				$_SESSION['session_modalNotificacao'] = 'abrir';
				$_SESSION['session_acaoNotificacao'] = 'adicionar';
			}
		
			header("Location: ../views/frmGerenciamento.php#notificacao");
			break;
		}
		case 2://Pesquisando notificacao
		{
			
			$_SESSION['session_pesquisaNotificacao'] = utf8_decode($_POST['Ds_PesquisaNotificacao']);	
			$_SESSION['session_listarNotificacao'] = 'pesquisa';
			
			header("Location: ../views/frmGerenciamento.php#notificacao");
			
			break;
		}
		case 3://Excluir notificacao
		{
			$ID_Notificacao = $_POST['ID_Notificacao'];
			$delete = new DaoNotificacao();
			$delete->excluirNotificacao($ID_Notificacao);
			header("Location: ../views/frmGerenciamento.php#notificacao");
			break;
		}
	}

	function pegaValores()
	{
		//atribuição dos valores nas váriaveis via POST
		$Nm_Bairro = $_POST['Nm_Bairro'];
		$Nm_Rua = $_POST['Nm_Rua'];
		$Dt_Notificacao = $_POST['Dt_Notificacao'];
		$Ds_PontoProximo = $_POST['Ds_PontoProximo'];
		$Ds_Notificacao = $_POST['Ds_Notificacao'];
		$ID_Notificacao = $_POST['ID_Notificacao'];
		$St_Notificacao = "ATIVA";
		$ID_Usuario = 1 /*$_SESSION['session_ID_Logado']*/;
		
		//Imagem
		$instancia = new DaoNotificacao();
		$ID_Notificacao = $instancia->retornaUltimoId();
		$ID_Notificacao += 1;
		
		$extensao = strtolower(substr($_FILES['Ft_Notificacao']['name'], -4));
		$novo_nome =  $ID_Usuario . 'notificacao' . $extensao;
		$diretorio = "../resources/img/notificacao";
		
		move_uploaded_file($_FILES['Ft_Notificacao']['tmp_name'], $diretorio . $novo_nome);
		
		$Ft_Notificacao = $diretorio.'/'.$novo_nome;
		
		// Adicionando valores ao objeto
		$notificacao = new classeNotificacao($Nm_Bairro, $Nm_Rua, $Dt_Notificacao, $Ds_PontoProximo, $Ft_Notificacao, $Ds_Notificacao, $St_Notificacao, $ID_Usuario, $ID_Notificacao);
		
		return $notificacao;
	}
?>