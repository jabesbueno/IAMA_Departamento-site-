<?php
include_once "../classes/classeHistoricoNotificacao.php";
include_once "../classes/classeConexao.php";
class DaoHistoricoNotificacao{
	
	public function inserirHistorico(classeHistorico $historico) {
		try{
			$conec = conec::conecta_mysql();
			$insert = $conec->prepare("INSERT INTO TB_Noticia(Dt_Historico, Hr_Historico, Ds_Observacao, ID_Notificacao)"
			." VALUES(:Dt_Historico, :Hr_Historico, :Ds_Observacao, :ID_Notificacao)");
			$insert->bindValue(":Dt_Historico", $historico->get_Dt_Historico());
			$insert->bindValue(":Hr_Historico", $historico->get_Hr_Historico());
			$insert->bindValue(":Ds_Observacao", $historico->get_Ds_Observacao());
			$insert->bindValue(":ID_Notificacao", $historico->get_ID_Notificacao());
			$insert->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 
	}
	
	public function buscaHistorico() {
	  try{
			$conec = conec::conecta_mysql();
			$select = $conec->prepare("SELECT ID_Historico, Dt_Historico, Hr_Historico, Ds_Observacao, ID_Notificacao FROM TB_Historico");
			$select->execute();
		}catch(Exception $e){
			print "Erro:..".$e;
		} 	
		return $select;
    }
}
?>