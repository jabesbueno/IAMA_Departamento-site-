<?php
include_once "../classes/classeNoticia.php";
include_once "../classes/classeConexao.php";
class DaoNoticia{
	
	public function inserirNoticia(classeNoticia $noticia) {
		try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$insert = $conec->prepare("INSERT INTO TB_Noticia(ID_Usuario, Nm_Noticia, Ds_Noticia, Dt_Noticia, Hr_Noticia)"
			." VALUES(:ID_Usuario, :Nm_Noticia, :Ds_Noticia, :Dt_Noticia, :Hr_Noticia)");
			$insert->bindValue(":ID_Usuario", $noticia->get_ID_Usuario());
			$insert->bindValue(":Nm_Noticia", utf8_decode($noticia->get_Nm_Noticia()));
			$insert->bindValue(":Ds_Noticia", utf8_decode($noticia->get_Ds_Noticia()));
			$insert->bindValue(":Dt_Noticia", $noticia->get_Dt_Noticia());
			$insert->bindValue(":Hr_Noticia", utf8_decode($noticia->get_Hr_Noticia()));
			$insert->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
	}
	
	public function buscaNoticia() {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$select = $conec->prepare("SELECT ID_Noticia, ID_Usuario, Nm_Noticia, Ds_Noticia, Dt_Noticia, Hr_Noticia FROM TB_Noticia");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function buscaNoticiaESP($nome_noticia) {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$select = $conec->prepare("SELECT ID_Noticia, ID_Usuario, Nm_Noticia, Ds_Noticia, Dt_Noticia, Hr_Noticia FROM TB_Noticia WHERE Nm_Noticia LIKE '%" . $nome_noticia . "%'");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function atualizarNoticia(classeNoticia $noticia) {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$update = $conec->prepare("UPDATE TB_Noticia SET ID_Usuario = :ID_Usuario, Nm_Noticia = :Nm_Noticia, "
			."Ds_Noticia = :Ds_Noticia, Dt_Noticia = :Dt_Noticia, Hr_Noticia = :Hr_Noticia WHERE ID_Noticia = :ID_Noticia");
			$update->bindValue(":ID_Usuario", $noticia->get_ID_Usuario());
			$update->bindValue(":Nm_Noticia", utf8_decode($noticia->get_Nm_Noticia()));
			$update->bindValue(":Ds_Noticia", utf8_decode($noticia->get_Ds_Noticia()));
			$update->bindValue(":Dt_Noticia", $noticia->get_Dt_Noticia());
			$update->bindValue(":Hr_Noticia", utf8_decode($noticia->get_Hr_Noticia()));
			$update->bindValue(":ID_Noticia", $noticia->get_ID_Noticia());
			$update->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
    }
	
	public function excluirNoticia($ID_Noticia) {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$delete = $conec->prepare("DELETE FROM TB_Noticia WHERE ID_Noticia = :ID_Noticia");
			$delete->bindValue(":ID_Noticia", $ID_Noticia);
			$delete->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
    }
}
?>