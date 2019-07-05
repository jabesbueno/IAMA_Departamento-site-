<?php
class classeUsuario{
   
    private $ID_Usuario;
	private $Nm_Usuario;
	private $Ds_Senha;
	private $Tp_Usuario;
	private $Ft_Usuario;
	private $Nr_Cpf;
	private $Dt_Nascimento;
	private $St_Usuario;
	
	//Construtor da Classe
    public function __construct($Nm_Usuario, $Ds_Senha, $Tp_Usuario, $Ft_Usuario, $Nr_Cpf,$Dt_Nascimento, $St_Usuario, $ID_Usuario)
    {
	  $this->Nm_Usuario = $Nm_Usuario;
	  $this->Ds_Senha = $Ds_Senha;
	  $this->Tp_Usuario = $Tp_Usuario;
	  $this->Ft_Usuario = $Ft_Usuario;
	  $this->Nr_Cpf = $Nr_Cpf;
	  $this->Dt_Nascimento = $Dt_Nascimento;
	  $this->St_Usuario = $St_Usuario;
	  $this->ID_Usuario = $ID_Usuario;
    }
	// GET
    public function get_ID_Usuario() {
        return $this->ID_Usuario;
    }
	
	public function get_Nm_Usuario() {
        return $this->Nm_Usuario;
    }
	public function get_Ds_Senha() {
        return $this->Ds_Senha;
    }
	public function get_Tp_Usuario() {
        return $this->Tp_Usuario;
    }
	public function get_Ft_Usuario() {
        return $this->Ft_Usuario;
    }
	public function get_Nr_Cpf() {
        return $this->Nr_Cpf;
    }
	public function get_Dt_Nascimento() {
        return $this->Dt_Nascimento;
    }
	public function get_St_Usuario() {
        return $this->St_Usuario;
    }
	// SET
	public function set_ID_Usuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }
	public function set_Nm_Usuario($Nm_Usuario) {
        $this->Nm_Usuario = $Nm_Usuario;
    }
	public function set_Ds_Senha($Ds_Senha) {
        $this->Ds_Senha = $Ds_Senha;
    }
	public function set_Tp_Usuario($Tp_Usuario) {
        $this->Tp_Usuario = $Tp_Usuario;
    }
	public function set_Ft_Usuario($Ft_Usuario) {
        $this->Ft_Usuario = $Ft_Usuario;
    }
	public function set_Nr_Cpf($Nr_Cpf) {
        $this->Nr_Cpf = $Nr_Cpf;
    }
	public function set_Dt_Nascimento($Dt_Nascimento) {
        $this->Dt_Nascimento = $Dt_Nascimento;
    }
	public function set_St_Usuario($St_Usuario) {
        $this->St_Usuario = $St_Usuario;
    }
	
}
?>