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
	$_dados['Nm_Usuario'] = $_POST['Nm_Usuario'];
	$_dados['Ds_Senha'] = sha1($_POST['Ds_Senha']);
	$_dados['Tp_Usuario'] = "USUARIO";
	$_dados['Nr_Cpf'] = $_POST['Nr_Cpf'];
	$_dados['Dt_Nascimento'] = $_POST['Dt_Nascimento'];
	$_dados['St_Usuario'] = "ATIVO";
	$_dados['ID_Usuario'] = "1";
	//Imagem
	$instancia = new DaoUsuario();
	$ID_Usuario = $instancia->retornaUltimoId()+1;
	
	$diretorio = "../resources/img/{$ID_Usuario}/";
	if(!file_exists($diretorio)) mkdir($diretorio, 0777);
	$arquivos = glob($diretorio . 'foto.*');
		foreach ($arquivos as $arquivo) {
			unlink($arquivo);
		}
	
	$extensao = strtolower(substr($_FILES['Ft_Usuario']['name'], -4));
	$novo_nome = $diretorio.'foto'.$extensao;
	
	
	move_uploaded_file($_FILES['Ft_Usuario']['tmp_name'], $novo_nome);
	
	$_dados['Ft_Usuario'] = $novo_nome;

	$usuario = new classeUsuario($_dados['Nm_Usuario'], $_dados['Ds_Senha'], $_dados['Tp_Usuario'], $_dados['Ft_Usuario'], $_dados['Nr_Cpf'], $_dados['Dt_Nascimento'], $_dados['St_Usuario'], $_dados['ID_Usuario']);		
	
	# se você usa PHP Puro , use aqui um mysql_insert e escreva a consulta.
	//Instânciando 
	$inserir = new DaoUsuario();
	// Chamando função para cadastrar usuário no banco de dados
	$r = $inserir->inserirUsuario($usuario);
	# se erro
	if( $r === false )
    __output_header__( false, 'Erro ao casdatrar usuário', null);
	
	__output_header__( ($r > 0), "Usuário adicionado com sucesso", null );

#
?>