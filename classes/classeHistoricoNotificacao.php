<?php
class classeHistoricoNotificacao{
   
    private $ID_Historico;
	private $Dt_Historico;
	private $Hr_Historico;
	private $Ds_Observacao;
	private $ID_Notificacao;
	
	//Construtor da Classe
    public function __construct($Dt_Historico, $Hr_Historico, $Ds_Observacao, $ID_Notificacao, $ID_Historico)
    {
	  $this->Dt_Historico = $Dt_Historico;
	  $this->Hr_Historico = $Hr_Historico;
	  $this->Ds_Observacao = $Ds_Observacao;
	  $this->ID_Notificacao = $ID_Notificacao;
	  $this->ID_Historico = $ID_Historico;
    }
	// GET
	public function get_ID_Historico() {
        return $this->ID_Historico;
    }
	public function get_Dt_Historico() {
        return $this->Dt_Historico;
    }
	public function get_Hr_Historico() {
        return $this->Hr_Historico;
    }
	public function get_Ds_Observacao() {
        return $this->Ds_Observacao;
    }
	public function get_ID_Notificacao() {
        return $this->ID_Notificacao;
    }
	// SET
	public function set_ID_Historico($ID_Historico) {
        $this->ID_Historico = $ID_Historico;
    }
	public function set_Dt_Historico($Dt_Historico) {
        $this->Dt_Historico = $Dt_Historico;
    }
	public function set_Hr_Historico($Hr_Historico) {
        $this->Hr_Historico = $Hr_Historico;
    }
	public function set_Ds_Observacao($Ds_Observacao) {
        $this->Ds_Observacao = $Ds_Observacao;
    }
	public function set_ID_Notificacao($ID_Notificacao) {
        $this->ID_Notificacao = $ID_Notificacao;
    }
}
?>