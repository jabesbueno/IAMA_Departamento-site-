<?php
class classeNotificacao{
   
    private $ID_Notificacao;
	private $Nm_Bairro;
	private $Nm_Rua;
	private $Dt_Notificacao;
	private $Ds_PontoProximo;
	private $Ft_Notificacao;
	private $Ds_Notificacao;
	private $St_Notificacao;
	private $ID_Usuario;
	
	//Construtor da Classe
    public function __construct($Nm_Bairro, $Nm_Rua, $Dt_Notificacao, $Ds_PontoProximo, $Ft_Notificacao, $Ds_Notificacao, $St_Notificacao, $ID_Usuario, $ID_Notificacao)
    {
	  $this->Nm_Bairro = $Nm_Bairro;
	  $this->Nm_Rua = $Nm_Rua;
	  $this->Dt_Notificacao = $Dt_Notificacao;
	  $this->Ds_PontoProximo = $Ds_PontoProximo;
	  $this->Ft_Notificacao = $Ft_Notificacao;
	  $this->Ds_Notificacao = $Ds_Notificacao;
	  $this->St_Notificacao = $St_Notificacao;
	  $this->ID_Usuario = $ID_Usuario;
	  $this->ID_Notificacao = $ID_Notificacao;
    }
	// GET
    public function get_ID_Notificacao() {
        return $this->ID_Notificacao;
    }
	public function get_Nm_Bairro() {
        return $this->Nm_Bairro;
    }
	public function get_Nm_Rua() {
        return $this->Nm_Rua;
    }
	public function get_Dt_Notificacao() {
        return $this->Dt_Notificacao;
    }
	public function get_Ds_PontoProximo() {
        return $this->Ds_PontoProximo;
    }
	public function get_Ft_Notificacao() {
        return $this->Ft_Notificacao;
    }
	public function get_Ds_Notificacao() {
        return $this->Ds_Notificacao;
    }
	public function get_St_Notificacao() {
        return $this->St_Notificacao;
    }
	public function get_ID_Usuario() {
        return $this->ID_Usuario;
    }
	// SET
	public function set_ID_Notificacao($ID_Notificacao) {
        $this->ID_Notificacao = $ID_Notificacao;
    }
	public function set_Nm_Bairro($Nm_Bairro) {
        $this->Nm_Bairro = $Nm_Bairro;
    }
	public function set_Nm_Rua($Nm_Rua) {
        $this->Nm_Rua = $Nm_Rua;
    }
	public function set_Dt_Notificacao($Dt_Notificacao) {
        $this->Dt_Notificacao = $Dt_Notificacao;
    }
	public function set_Ds_PontoProximo($Ds_PontoProximo) {
        $this->Ds_PontoProximo = $Ds_PontoProximo;
    }
	public function set_Ft_Notificacao($Ft_Notificacao) {
        $this->Ft_Notificacao = $Ft_Notificacao;
    }
	public function set_Ds_Notificacao($Ds_Notificacao) {
        $this->Ds_Notificacao = $Ds_Notificacao;
    }
	public function set_St_Notificacao($St_Notificacao) {
        $this->St_Notificacao = $St_Notificacao;
    }
	public function set_ID_Usuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }
	
}
?>