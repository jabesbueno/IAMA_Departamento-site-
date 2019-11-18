<?php
include_once "../classes/classeNotificacao.php";
include_once "../classes/classeConexao.php";
class DaoNotificacao{
	
	public function inserirNotificacao(classeNotificacao $notificacao) {
		try{
			$conec = conec::conecta_mysql();
			$insert = $conec->prepare("INSERT INTO TB_Notificacao(Nm_Bairro, Nm_Rua, Dt_Notificacao, Ds_PontoProximo, Ft_Notificacao, Ds_Notificacao, St_Notificacao, ID_Usuario)"
			." VALUES(:Nm_Bairro, :Nm_Rua, :Dt_Notificacao, :Ds_PontoProximo, :Ft_Notificacao, :Ds_Notificacao, :St_Notificacao, :ID_Usuario)");
			$insert->bindValue(":Nm_Bairro", utf8_decode($notificacao->get_Nm_Bairro()));
			$insert->bindValue(":Nm_Rua", utf8_decode($notificacao->get_Nm_Rua()));
			$insert->bindValue(":Dt_Notificacao", $notificacao->get_Dt_Notificacao());
			$insert->bindValue(":Ds_PontoProximo", utf8_decode($notificacao->get_Ds_PontoProximo()));
			$insert->bindValue(":Ft_Notificacao", utf8_decode($notificacao->get_Ft_Notificacao()));
			$insert->bindValue(":Ds_Notificacao", utf8_decode($notificacao->get_Ds_Notificacao()));
			$insert->bindValue(":St_Notificacao", utf8_decode($notificacao->get_St_Notificacao()));
			$insert->bindValue(":ID_Usuario", $notificacao->get_ID_Usuario());
			$r = $insert->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
		return $r;
	}
	
	public function buscaNotificacao() {
	  try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT n.ID_Notificacao, Nm_Bairro, Nm_Rua, Dt_Notificacao, Ds_PontoProximo, Ft_Notificacao, Ds_Notificacao, St_Notificacao, n.ID_Usuario, Nm_Usuario, Nr_Cpf, Dt_Nascimento FROM TB_Notificacao AS n INNER JOIN TB_Usuario AS u ON n.ID_Usuario = u.ID_Usuario");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function buscaNotificacaoById($ID_Usuario) {
	  try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT n.ID_Notificacao, Nm_Bairro, Nm_Rua, Dt_Notificacao, Ds_PontoProximo, Ft_Notificacao, Ds_Notificacao, St_Notificacao, n.ID_Usuario, Nm_Usuario, Nr_Cpf, Dt_Nascimento FROM TB_Notificacao AS n INNER JOIN TB_Usuario AS u ON n.ID_Usuario = u.ID_Usuario WHERE n.ID_Usuario = :ID_Usuario");
			$select->bindValue(":ID_Usuario", $ID_Usuario);
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function buscaNotificacaoESP($nome_notificacao) {
	  try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT ID_Notificacao, Nm_Bairro, Nm_Rua, Dt_Notificacao, Ds_PontoProximo, Ft_Notificacao, Ds_Notificacao, St_Notificacao, ID_Usuario FROM TB_Notificacao WHERE Nm_Bairro LIKE '%" . $nome_notificacao . "%'");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function retornaUltimoId()
	{
		try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT MAX(ID_Notificacao) AS ID_Notificacao FROM TB_Notificacao");
			$select->execute();
		}catch(Exception $e){
			print "Não chegou";
		}
		while($select2 = $select->fetch())
		{
			$busca = $select2["ID_Notificacao"];	
		}
		return $busca;
	}
	
	public function atualizarNotificacao(classeNotificacao $notificacao) {
		try{
			$conec = conec::conecta_mysql();
			$update = $conec->prepare("UPDATE TB_Noticia SET Nm_Bairro = :Nm_Bairro, Nm_Rua = :Nm_Rua, Dt_Notificacao = :Dt_Notificacao, Ds_PontoProximo = :Ds_PontoProximo, "
			."Ft_Notificacao = :Ft_Notificacao, Ds_Notificacao = :Ds_Notificacao, St_Notificacao = :St_Notificacao, ID_Usuario = :ID_Usuario WHERE ID_Notificacao = :ID_Notificacao");
			$update->bindValue(":Nm_Bairro", utf8_decode($notificacao->get_Nm_Bairro()));
			$update->bindValue(":Nm_Rua", utf8_decode($notificacao->get_Nm_Rua()));
			$update->bindValue(":Dt_Notificacao", $notificacao->get_Dt_Notificacao());
			$update->bindValue(":Ds_PontoProximo", utf8_decode($notificacao->get_Ds_PontoProximo()));
			$update->bindValue(":Ft_Notificacao", utf8_decode($notificacao->get_Ft_Notificacao()));
			$update->bindValue(":Ds_Notificacao", utf8_decode($notificacao->get_Ds_Notificacao()));
			$update->bindValue(":St_Notificacao", utf8_decode($notificacao->get_St_Notificacao()));
			$update->bindValue(":ID_Usuario", $notificacao->get_ID_Usuario());
			$update->bindValue(":ID_Notificacao", $notificacao->get_ID_Notificacao());
			$update->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
	}
}
?>