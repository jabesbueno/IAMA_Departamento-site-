<?php
ini_set('default_charset','UTF-8'); 
include_once "../classes/classeEvento.php";
include_once "../dao/daoEvento.php";  
include '../libraries/Data_validator.php';
session_start();
$valor = $_POST['botao'];
	switch ($valor) 
	{		
		case 0:
		{
			$_SESSION['sessionEvento_ID_Evento'] =	null;
			$_SESSION['sessionEvento_Nm_Evento'] =	null;
			$_SESSION['sessionEvento_Dt_Evento'] =	null;
			$_SESSION['sessionEvento_Hr_Evento'] = null;
			$_SESSION['sessionEvento_Nm_Local'] = null;
			$_SESSION['sessionEvento_Ds_Evento'] = null;
			$_SESSION['session_modalEvento'] = null;
			$_SESSION['session_acaoEvento'] = null;
		}
		case 1: 
		{		
			$validate = new Data_validator();
				
			$validate->define_pattern('erro_', '');
	
			$validate->set('Nm_Evento', $_POST['Nm_Evento'])->is_required()
					 ->set('Dt_Evento', $_POST['Dt_Evento'])->is_required()
					 ->set('Hr_Evento', $_POST['Hr_Evento'])->is_required()
					 ->set('Nm_Local', $_POST['Nm_Local'])->is_required()
					 ->set('Ds_Evento', $_POST['Ds_Evento'])->is_required();
			
					
			// Todos os dados foram validados com sucesso;
			if($validate->validate())
			{
				if($_POST['acao'] == 'adicionar')
				{	
					$evento = pegaValores();					
					//Instânciando 
					$insert = new DaoEvento();
					// Chamando função para cadastrar evento no banco de dados
					$insert->inserirEvento($evento);
				}
				else
				{
					$evento = pegaValores();					
					//Instânciando 
					$update = new DaoEvento();
					// Chamando função para cadastrar evento no banco de dados
					$update->atualizarEvento($evento);
				}
				
				$_SESSION['sessionEvento_Nm_Evento'] =	null;
				$_SESSION['sessionEvento_Dt_Evento'] =	null;
				$_SESSION['sessionEvento_Hr_Evento'] = null;
				$_SESSION['sessionEvento_Nm_Local'] = null;
				$_SESSION['sessionEvento_Ds_Evento'] = null;
			}
			else
			{
				if($validate->get_errors() != null)
				{
					$erros = $validate->get_errors();
											
					if (isset($erros['erro_Nm_Evento'][0]) != null) $_SESSION['sessionEvento_Nm_Evento'] = "• " . $erros['erro_Nm_Evento'][0] ."\n• " . $erros['erro_Nm_Evento'][1];
					if (isset($erros['erro_Dt_Evento'][0]) != null) $_SESSION['sessionEvento_Dt_Evento'] = "• " . $erros['erro_Dt_Evento'][0];
					if (isset($erros['erro_Hr_Evento'][0]) != null) $_SESSION['sessionEvento_Hr_Evento'] = "• " . $erros['erro_Hr_Evento'][0];
					if (isset($erros['erro_Nm_Local'][0]) != null) $_SESSION['sessionEvento_Nm_Local'] = "• " . $erros['erro_Nm_Local'][0] . "\n• " . $erros['erro_Nm_Local'][1];
					if (isset($erros['erro_Ds_Evento'][0]) != null) $_SESSION['sessionEvento_Ds_Evento'] = "• " . $erros['erro_Ds_Evento'][0] . "\n• " . $erros['erro_Ds_Evento'][1];
				}
				$_SESSION['session_modalEvento'] = 'abrir';
				$_SESSION['session_acaoEvento'] = 'adicionar';
			}
		
			header("Location: ../views/frmGerenciamento.php#eventos");
			break;
		}
		case 2://Pesquisando evento
		{
			
			$_SESSION['session_pesquisaEvento'] = utf8_decode($_POST['Ds_PesquisaEvento']);	
			$_SESSION['session_listarEventos'] = 'pesquisa';
			
			header("Location: ../views/frmGerenciamento.php#eventos");
			
			break;
		}
	}

	function pegaValores()
	{
		//atribuição dos valores nas váriaveis via POST
		$Nm_Evento = $_POST['Nm_Evento'];
		$Dt_Evento = $_POST['Dt_Evento'];
		$Hr_Evento = $_POST['Hr_Evento'];
		$Nm_Local = $_POST['Nm_Local'];
		$Ds_Evento = $_POST['Ds_Evento'];
		$St_Evento = 'ATIVO';
		$ID_Evento = $_POST['ID_Evento'];
		$ID_Usuario = $_POST['ID_Usuario'];
		
		// Adicionando valores ao objeto
		$evento = new classeEvento($Nm_Evento, $Dt_Evento, $Hr_Evento, $Nm_Local, $Ds_Evento,$St_Evento, $ID_Usuario, $ID_Evento);
		
		return $evento;
	}