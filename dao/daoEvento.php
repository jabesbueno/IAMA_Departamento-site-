<?php
include_once "../classes/classeEvento.php";
include_once "../classes/classeConexao.php";
class DaoEvento{
	
	public function inserirEvento(classeEvento $evento) {
		try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$insert = $conec->prepare("INSERT INTO TB_Evento(Nm_Evento, Dt_Evento, Hr_Evento, Nm_Local, Ds_Evento, St_Evento, ID_Usuario)"
			." VALUES(:Nm_Evento, :Dt_Evento, :Hr_Evento, :Nm_Local, :Ds_Evento, :St_Evento, :ID_Usuario)");
			$insert->bindValue(":Nm_Evento", utf8_decode($evento->get_Nm_Evento()));
			$insert->bindValue(":Dt_Evento", $evento->get_Dt_Evento());
			$insert->bindValue(":Hr_Evento", $evento->get_Hr_Evento());
			$insert->bindValue(":Nm_Local", utf8_decode($evento->get_Nm_Local()));
			$insert->bindValue(":Ds_Evento", utf8_decode($evento->get_Ds_Evento()));
			$insert->bindValue(":St_Evento", $evento->get_St_Evento());
			$insert->bindValue(":ID_Usuario", $evento->get_ID_Usuario());
			$insert->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
	}
	
	public function buscaEvento() {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$select = $conec->prepare("SELECT ID_Evento, ID_Usuario, Nm_Evento, Dt_Evento, Hr_Evento, Nm_Local, Ds_Evento, St_Evento FROM TB_Evento");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function buscaEventoESP($nome_usuario) {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$select = $conec->prepare("SELECT ID_Evento, ID_Usuario, Nm_Evento, Dt_Evento, Hr_Evento, Nm_Local, Ds_Evento, St_Evento FROM TB_Evento WHERE Nm_Evento LIKE '%" . $nome_usuario . "%'");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
	
	public function atualizarEvento(classeEvento $evento) {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$update = $conec->prepare("UPDATE TB_Evento SET Nm_Evento = :Nm_Evento, Dt_Evento = :Dt_Evento, "
			."Hr_Evento = :Hr_Evento, Nm_Local = :Nm_Local, Ds_Evento = :Ds_Evento, St_Evento = :St_Evento, ID_Usuario = :ID_Usuario WHERE ID_Evento = :ID_Evento");
			$update->bindValue(":Nm_Evento", utf8_decode($evento->get_Nm_Evento()));
			$update->bindValue(":Dt_Evento", $evento->get_Dt_Evento());
			$update->bindValue(":Hr_Evento", $evento->get_Hr_Evento());
			$update->bindValue(":Nm_Local", utf8_decode($evento->get_Nm_Local()));
			$update->bindValue(":Ds_Evento", utf8_decode($evento->get_Ds_Evento()));
			$update->bindValue(":St_Evento", $evento->get_St_Evento());
			$update->bindValue(":ID_Usuario", $evento->get_ID_Usuario());
			$update->bindValue(":ID_Evento", $evento->get_ID_Evento());
			$update->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
    }
	
	public function excluirEvento($ID_Evento) {
	  try{
			$conec = conec::conecta_mysql("localhost","root","","db_ambiente");
			$delete = $conec->prepare("DELETE FROM TB_Evento WHERE ID_Evento = :ID_Evento");
			$delete->bindValue(":ID_Evento", $ID_Evento);
			$delete->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
    }
}
?>