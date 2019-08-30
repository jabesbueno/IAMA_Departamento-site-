<?php
ini_set('default_charset','UTF-8'); 
include_once "../classes/classeNoticia.php";
include_once "../dao/daoNoticia.php";  
include '../libraries/Data_validator.php';
session_start();
$valor = $_POST['botao'];
	switch ($valor) 
	{		
		case 0:
		{
			$_SESSION['sessionNoticia_ID_Noticia'] = null;
			$_SESSION['sessionNoticia_Nm_Noticia'] = null;
			$_SESSION['sessionNoticia_Dt_Noticia'] = null;
			$_SESSION['sessionNoticia_Hr_Noticia'] = null;
			$_SESSION['sessionNoticia_Ds_Noticia'] = null;
			$_SESSION['session_modalNoticia'] = null;
			$_SESSION['session_acaoNoticia'] = null;
		}
		case 1: 
		{		
			$validate = new Data_validator();
				
			$validate->define_pattern('erro_', '');
	
			$validate->set('Nm_Noticia', $_POST['Nm_Noticia'])->is_required()
					 ->set('Dt_Noticia', $_POST['Dt_Noticia'])->is_required()
					 ->set('Hr_Noticia', $_POST['Hr_Noticia'])->is_required()
					 ->set('Ds_Noticia', $_POST['Ds_Noticia'])->is_required();
			
					
			// Todos os dados foram validados com sucesso;
			if($validate->validate())
			{
				if($_POST['acao'] == 'adicionar')
				{	
					$noticia = pegaValores();					
					//Instânciando 
					$insert = new DaoNoticia();
					// Chamando função para cadastrar noticia no banco de dados
					$insert->inserirNoticia($noticia);
				}
				else
				{
					$noticia = pegaValores();					
					//Instânciando 
					$update = new DaoNoticia();
					// Chamando função para cadastrar noticia no banco de dados
					$update->atualizarNoticia($noticia);
				}
				
				$_SESSION['sessionNoticia_Nm_Noticia'] = null;
				$_SESSION['sessionNoticia_Dt_Noticia'] = null;
				$_SESSION['sessionNoticia_Hr_Noticia'] = null;
				$_SESSION['sessionNoticia_Ds_Noticia'] = null;
			}
			else
			{
				if($validate->get_errors() != null)
				{
					$erros = $validate->get_errors();
											
					if (isset($erros['erro_Nm_Noticia'][0]) != null) $_SESSION['sessionNoticia_Nm_Noticia'] = "• " . $erros['erro_Nm_Noticia'][0];
					if (isset($erros['erro_Dt_Noticia'][0]) != null) $_SESSION['sessionNoticia_Dt_Noticia'] = "• " . $erros['erro_Dt_Noticia'][0];
					if (isset($erros['erro_Hr_Noticia'][0]) != null) $_SESSION['sessionNoticia_Hr_Noticia'] = "• " . $erros['erro_Hr_Noticia'][0];
					if (isset($erros['erro_Ds_Noticia'][0]) != null) $_SESSION['sessionNoticia_Ds_Noticia'] = "• " . $erros['erro_Ds_Noticia'][0];
				}
				$_SESSION['session_modalNoticia'] = 'abrir';
				$_SESSION['session_acaoNoticia'] = 'adicionar';
			}
		
			header("Location: ../views/frmGerenciamento.php#noticias");
			break;
		}
		case 2://Pesquisando noticia
		{
			
			$_SESSION['session_pesquisaNoticia'] = utf8_decode($_POST['Ds_PesquisaNoticia']);	
			$_SESSION['session_listarNoticias'] = 'pesquisa';
			
			header("Location: ../views/frmGerenciamento.php#noticias");
			
			break;
		}
		case 3://Excluir noticia
		{
			$ID_Noticia = $_POST['ID_Noticia'];
			$delete = new DaoNoticia();
			$delete->excluirNoticia($ID_Noticia);
			header("Location: ../views/frmGerenciamento.php#noticias");
			break;
		}
	}

	function pegaValores()
	{
		//atribuição dos valores nas váriaveis via POST
		$Nm_Noticia = $_POST['Nm_Noticia'];
		$Dt_Noticia = $_POST['Dt_Noticia'];
		$Hr_Noticia = $_POST['Hr_Noticia'];
		$Ds_Noticia = $_POST['Ds_Noticia'];
		$ID_Noticia = $_POST['ID_Noticia'];
		$ID_Usuario = $_POST['ID_Usuario'];
		
		// Adicionando valores ao objeto
		$noticia = new classeNoticia($Nm_Noticia, $Ds_Noticia, $Dt_Noticia, $Hr_Noticia, $ID_Usuario, $ID_Noticia);
		
		return $noticia;
	}
?>