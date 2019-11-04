<?php
# 
# obtendo nosso arquivo de configuracões
require_once 'webservice_init.php';
include_once "../classes/classeUsuario.php";
include_once "../dao/daoUsuario.php";  

	# verificando se o método de envio é mesmo  POST.
	if( $_SERVER['REQUEST_METHOD'] !== "POST" )
		__output_header__( false, "Método de requisição não aceito.", null );
	
	# Se você usa uma Framework, ou esta fazendo código Puro, 
	# obtenha e processe aqui os dados através do $_POST
	$Nm_Usuario = $_POST['Nm_Usuario'];
	$Ds_Senha = sha1($_POST['Ds_Senha']);
	$Tp_Usuario = "USUARIO";
	$Ft_Usuario = "";
	$Nr_Cpf = $_POST['Nr_Cpf'];
	$Dt_Nascimento = $_POST['Dt_Nascimento'];
	$St_Usuario = "ATIVO";
	$ID_Usuario = "";

	$usuario = new classeUsuario($Nm_Usuario, $Ds_Senha, $Tp_Usuario, $Ft_Usuario, $Nr_Cpf, $Dt_Nascimento, $St_Usuario, $ID_Usuario);
	
	# fazendo validacoes basicas. No caso apenas o E-mail
	#if( ! $vita->validate->email( $_dados['email'] ) )
	#    __output_header__( false, 'E-mail inválido.', null);		
	
	# se você usa PHP Puro , use aqui um mysql_insert e escreva a consulta.
	//Instânciando 
	$inserir = new DaoUsuario();
	// Chamando função para cadastrar usuário no banco de dados
	$r = $inserir->inserirUsuario($usuario);
	
	__output_header__( ($r > 0), "Usuário adicionado com sucesso", $_dados );

#
?>