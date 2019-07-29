<?php
include_once "../classes/classeUsuario.php";
include_once "../classes/classeConexao.php";
class DaoUsuario{
	
	public function inserirUsuario(classeUsuario $usuario) {
		try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$insert = $conec->prepare("INSERT INTO TB_Usuario(Nm_Usuario, Ds_Senha, Tp_Usuario, Ft_Usuario, Nr_Cpf, Dt_Nascimento, St_Usuario)"
			." VALUES(:Nm_Usuario, :Ds_Senha, :Tp_Usuario, :Ft_Usuario, :Nr_Cpf, :Dt_Nascimento, :St_Usuario)");
			$insert->bindValue(":Nm_Usuario", $usuario->get_Nm_Usuario());
			$insert->bindValue(":Ds_Senha", $usuario->get_Ds_Senha());
			$insert->bindValue(":Tp_Usuario", $usuario->get_Tp_Usuario());
			$insert->bindValue(":Ft_Usuario", $usuario->get_Ft_Usuario());
			$insert->bindValue(":Nr_Cpf", $usuario->get_Nr_Cpf());
			$insert->bindValue(":Dt_Nascimento", $usuario->get_Dt_Nascimento());
			$insert->bindValue(":St_Usuario", $usuario->get_St_Usuario());
			$insert->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
	}
	
	public function retornaUltimoId()
	{
		try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
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
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$select = $conec->prepare("SELECT ID_Usuario, Nm_Usuario, Ds_Senha, Tp_Usuario, Ft_Usuario, Nr_Cpf, Dt_Nascimento, St_Usuario FROM TB_Usuario");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function buscaUsuarioESP($nome_usuario) {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
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
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
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
	
	
}
?>