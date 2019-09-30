<?php
ini_set('default_charset','UTF-8'); 
include_once "../classes/classeUsuario.php";
include_once "../dao/daoUsuario.php";  
include '../libraries/Data_validator.php';
session_start();
$valor = $_POST['botao'];
switch ($valor) 
{		
	case 0:
	{
		$_SESSION['sessionUsuario_Nome'] =	null;
		$_SESSION['sessionUsuario_Tipo'] =	null;
		$_SESSION['sessionUsuario_Senha'] = null;
		$_SESSION['sessionUsuario_Confirmar'] = null;
		$_SESSION['sessionUsuario_Cpf'] = null;
		$_SESSION['sessionUsuario_Nascimento'] = null;
		$_SESSION['sessionUsuario_Validacao'] = null;
		$_SESSION['session_modalUsuario'] = null;
		$_SESSION['session_acaoUsuario'] = null;
	}
    case 1: 
    {		
		$validate = new Data_validator();
			
		$validate->define_pattern('erro_', '');
 
		$validate->set('Nome', $_POST['Nm_Usuario'])->is_required()
				 ->set('Tipo', $_POST['Tp_Usuario'])->is_required()
				 ->set('Senha', $_POST['Ds_Senha'])->is_required()
				 ->set('Confirmar', $_POST['Ds_Confirmar'])->is_required()
				 ->set('Cpf', $_POST['Nr_Cpf'])->is_required()
				 ->set('Nascimento', $_POST['Dt_Nascimento'])->is_required();
		
				
		// Todos os dados foram validados com sucesso;
		if($validate->validate())
		{
			if($_POST['Ds_Senha'] == $_POST['Ds_Confirmar'])
			{	
				$usuario = pegaValores();					
				//Instânciando 
				$inserir = new DaoUsuario();
				// Chamando função para cadastrar usuário no banco de dados
				$inserir->inserirUsuario($usuario);
				$_SESSION['sessionUsuario_Validacao'] = null;
			}
			else
			{
				$_SESSION['sessionUsuario_Validacao'] = '• ' . 'Senhas divergentes';
				$_SESSION['session_modalUsuario'] = 'abrir';
				$_SESSION['session_acaoUsuario'] = 'adicionar';
			}
			$_SESSION['sessionUsuario_Nome'] =	null;
			$_SESSION['sessionUsuario_Tipo'] =	null;
			$_SESSION['sessionUsuario_Senha'] = null;
			$_SESSION['sessionUsuario_Confirmar'] = null;
			$_SESSION['sessionUsuario_Cpf'] = null;
			$_SESSION['sessionUsuario_Nascimento'] = null;
		}
		else
		{
			if($validate->get_errors() != null)
			{
				$erros = $validate->get_errors();
										
				if (isset($erros['erro_Nome'][0]) != null) $_SESSION['sessionUsuario_Nome'] = "• " . $erros['erro_Nome'][0];
				if (isset($erros['erro_Tipo'][0]) != null) $_SESSION['sessionUsuario_Tipo'] = "• " . $erros['erro_Tipo'][0];
				if (isset($erros['erro_Senha'][0]) != null) $_SESSION['sessionUsuario_Senha'] = "• " . $erros['erro_Senha'][0];
				if (isset($erros['erro_Confirmar'][0]) != null) $_SESSION['sessionUsuario_Confirmar'] = "• " . $erros['erro_Confirmar'][0];
				if (isset($erros['erro_Cpf'][0]) != null) $_SESSION['sessionUsuario_Cpf'] = "• " . $erros['erro_Cpf'][0];
				if (isset($erros['erro_Nascimento'][0]) != null) $_SESSION['sessionUsuario_Nascimento'] = "• " . $erros['erro_Nascimento'][0];
			}
			$_SESSION['session_modalUsuario'] = 'abrir';
			$_SESSION['session_acaoUsuario'] = 'adicionar';
		}
	
		header("Location: ../views/frmGerenciamento.php#usuario");
		break;
	}
	case 2://Pesquisando usuário
	{
		
		$_SESSION['session_pesquisaUsuario'] = utf8_decode($_POST['Ds_Pesquisa']);	
    	$_SESSION['session_listarUsuarios'] = 'pesquisa';
		
		header("Location: ../views/frmGerenciamento.php#usuario");
		
		break;
	}
	case 3: //Inativando usuário
    {		
		$inativar = new DaoUsuario();
		$inativar->inativarUsuario($_POST['ID_Usuario']);
		header("Location: ../views/frmGerenciamento.php#usuario");
		break;
	}
	case 4: //Validando Login
	{
		$validate = new Data_validator();
			
		$validate->define_pattern('erro_', '');
 
		$validate->set('validarUsuario', $_POST['Nm_Usuario'])->is_required()
				 ->set('validarSenha', $_POST['Ds_Senha'])->is_required();
		
		if($validate->validate())
		{
			
				// Pegando os dados inseridos pelo usuario
				$Nm_Usuario = $_POST['Nm_Usuario'];
				$Ds_Senha = $_POST['Ds_Senha'];
				// Instancia do DaoUsuario
				$select = new DaoUsuario();
				// Chamando função para inserir no banco de dados

				$valida = $select->validaUsuario($Nm_Usuario, $Ds_Senha);
				
				
				$_SESSION['session_validarUsuario'] = null;
				$_SESSION['session_validarSenha'] = null;
				$_SESSION['session_validaLogin'] = null;
				if($valida == 0)
				{
					$_SESSION['session_validarUsuario'] = null;
					$_SESSION['session_validarSenha'] = null;
					$_SESSION['session_validaLogin'] = 'Usuario ou Senha incorreto(s)';
					header("Location: ../views/frmTelaLogin.php");
				}
				else
				{
					$_SESSION['session_validaLogin'] = null;
					$_SESSION['session_validarUsuario'] = null;
					$_SESSION['session_validarSenha'] = null;
					$_SESSION['session_Logado'] = $Nm_Usuario;
					$_SESSION['session_ultimaAtividade'] = time();
					header("Location: ../views/frmTelaPrincipal.php");
				}
			}
		break;
	}
}
	function pegaValores()
	{
		//atribuição dos valores nas váriaveis via POST
		$encoding = mb_internal_encoding();
		$Nm_Usuario = mb_strtoupper($_POST['Nm_Usuario'],$encoding);
		$Ds_Senha = sha1($_POST['Ds_Senha']);
		$Tp_Usuario = mb_strtoupper($_POST['Tp_Usuario'],$encoding);
		$Nr_Cpf = $_POST['Nr_Cpf'];
		$Dt_Nascimento = $_POST['Dt_Nascimento'];
		$St_Usuario = mb_strtoupper('ATIVO',$encoding);
		
		//Imagem
		$instancia = new DaoUsuario();
		$ID_Usuario = $instancia->retornaUltimoId()+1;
		
		$extensao = strtolower(substr($_FILES['Ft_Usuario']['name'], -4));
		$novo_nome =  $ID_Usuario . 'foto' . $extensao;
		$diretorio = "../resources/img/";
		
		move_uploaded_file($_FILES['Ft_Usuario']['tmp_name'], $diretorio . $novo_nome);
		
		$Ft_Usuario = $diretorio.'/'.$novo_nome;
		
		// Adicionando valores ao objeto
		$usuario = new classeUsuario($Nm_Usuario, $Ds_Senha, $Tp_Usuario, $Ft_Usuario, $Nr_Cpf, $Dt_Nascimento, $St_Usuario, $ID_Usuario);
		
		return $usuario;
	}
?>