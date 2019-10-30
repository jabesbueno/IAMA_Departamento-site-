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
}
?>