<?php
include_once "../classes/classeUsuario.php";
include_once "../classes/classeConexao.php";
class DaoUsuario{
	
	public function inserirUsuario(classeUsuario $usuario) {
		try{
			$conec = conec::conecta_mysql();
			$insert = $conec->prepare("INSERT INTO TB_Usuario(Nm_Usuario, Ds_Senha, Tp_Usuario, Ft_Usuario, Nr_Cpf, Dt_Nascimento, St_Usuario)"
			." VALUES(:Nm_Usuario, :Ds_Senha, :Tp_Usuario, :Ft_Usuario, :Nr_Cpf, :Dt_Nascimento, :St_Usuario)");
			$insert->bindValue(":Nm_Usuario", $usuario->get_Nm_Usuario());
			$insert->bindValue(":Ds_Senha", $usuario->get_Ds_Senha());
			$insert->bindValue(":Tp_Usuario", $usuario->get_Tp_Usuario());
			$insert->bindValue(":Ft_Usuario", $usuario->get_Ft_Usuario());
			$insert->bindValue(":Nr_Cpf", $usuario->get_Nr_Cpf());
			$insert->bindValue(":Dt_Nascimento", $usuario->get_Dt_Nascimento());
			$insert->bindValue(":St_Usuario", $usuario->get_St_Usuario());
			$result = $insert->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
		return $result;
	}
	
	public function retornaUltimoId()
	{
		try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT MAX(ID_Usuario) AS ID_Usuario FROM TB_Usuario");
			$select->execute();
		}catch(Exception $e){
			print "Não chegou";
		}
		while($select2 = $select->fetch())
		{
			$busca = $select2["ID_Usuario"];	
		}
		return $busca;
	}
	
	public function buscaUsuario() {
	  try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT ID_Usuario, Nm_Usuario, Ds_Senha, Tp_Usuario, Ft_Usuario, Nr_Cpf, Dt_Nascimento, St_Usuario FROM TB_Usuario WHERE ID_Usuario != :ID_Usuario");
			$select->bindValue(":ID_Usuario", '1');
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function buscaUsuarioESP($nome_usuario) {
	  try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT ID_Usuario, Nm_Usuario, Ds_Senha, Tp_Usuario, Ft_Usuario, Nr_Cpf, Dt_Nascimento, St_Usuario FROM TB_Usuario WHERE Nm_Usuario LIKE '%" . $nome_usuario . "%'");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function inativarUsuario($id_usuario)
	{
		try
		{
			$conec = conec::conecta_mysql();
			$update = $conec->prepare("UPDATE TB_Usuario SET St_Usuario = :St_Usuario WHERE ID_Usuario = :ID_Usuario");
			$update->bindValue(":St_Usuario", 'INATIVO');
			$update->bindValue(":ID_Usuario", $id_usuario);
			$update->execute();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 
	}

	public function validaUsuario($Nm_Usuario, $Ds_Senha)
	{
	      $count=0;
	    try{
	      $conec = conec::conecta_mysql();
          $result = $conec->prepare("SELECT * FROM TB_Usuario WHERE Nm_Usuario = :Nm_Usuario and Ds_Senha = sha1(:Ds_Senha)");
		  $result->bindValue(":Nm_Usuario",$Nm_Usuario);
		  $result->bindValue(":Ds_Senha",$Ds_Senha);
		  $result->execute();
		  $count =  $result->rowCount();
		}catch(Exception $e){
		  echo "Erro ".$e;
		}  
		return $count;
	}
	
	public function validaDepartamento($Nm_Usuario, $Ds_Senha)
	{
	      $count=0;
	    try{
	      $conec = conec::conecta_mysql();
          $result = $conec->prepare("SELECT * FROM TB_Usuario WHERE Nm_Usuario = :Nm_Usuario and Ds_Senha = sha1(:Ds_Senha) and Tp_Usuario = 'DEPARTAMENTO' ");
		  $result->bindValue(":Nm_Usuario",$Nm_Usuario);
		  $result->bindValue(":Ds_Senha",$Ds_Senha);
		  $result->execute();
		  $count =  $result->rowCount();
		}catch(Exception $e){
		  echo "Erro ".$e;
		}  
		while($select2 = $result->fetch())
		{
			$_SESSION['session_ID_Logado'] = $select2["ID_Usuario"];	
		}
		return $count;
	}

	public function buscaId($Nm_Usuario)
	{
		try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT ID_Usuario FROM TB_Usuario WHERE Nm_Usuario = :Nm_Usuario");
			$select->bindValue(":Nm_Usuario",$Nm_Usuario);
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		}
		while($select2 = $select->fetch())
		{
			$r = $select2["ID_Usuario"];	
		}
		return $r;
	}
	
	
}
?>