<?php
include_once "../classes/classeHistoricoNotificacao.php";
include_once "../classes/classeConexao.php";
class DaoHistoricoNotificacao{
	
	public function inserirHistorico(classeHistoricoNotificacao $historico) {
		try{
			$conec = conec::conecta_mysql();
			$insert = $conec->prepare("INSERT INTO TB_Historico(Dt_Historico, Ds_Observacao, ID_Notificacao)"
			." VALUES(:Dt_Historico, :Ds_Observacao, :ID_Notificacao)");
			$insert->bindValue(":Dt_Historico", $historico->get_Dt_Historico());
			$insert->bindValue(":Ds_Observacao", $historico->get_Ds_Observacao());
			$insert->bindValue(":ID_Notificacao", $historico->get_ID_Notificacao());
			$insert->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
	}
	
	public function atualizarHistorico(classeHistoricoNotificacao $historico) {
		try{
			$conec = conec::conecta_mysql();
			$update = $conec->prepare("UPDATE TB_Historico SET Dt_Historico = :Dt_Historico, Ds_Observacao = :Ds_Observacao WHERE ID_Historico = :ID_Historico");
			$update->bindValue(":Dt_Historico", $historico->get_Dt_Historico());
			$update->bindValue(":Ds_Observacao", $historico->get_Ds_Observacao());
			$update->bindValue(":ID_Historico", $historico->get_ID_Historico());
			$update->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
	}
	
	public function buscaHistorico($ID_Notificacao){
		try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT ID_Historico, ID_Notificacao, Dt_Historico, Ds_Observacao FROM TB_Historico WHERE ID_Notificacao = :ID_Notificacao");
			$select->bindValue(":ID_Notificacao", $ID_Notificacao);
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		}
		$arr = array();
		while($select2 = $select->fetch())
		{
			$arr['ID_Historico'] = $select2["ID_Historico"];
			$arr['ID_Notificacao'] = $select2["ID_Notificacao"];
			$arr['Dt_Historico'] = $select2["Dt_Historico"];
			$arr['Ds_Observacao'] = $select2["Ds_Observacao"];			
		}
		return $arr;
	}
}
?>