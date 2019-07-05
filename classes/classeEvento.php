<?php
class classeEvento{
   
    private $ID_Evento;
	private $Nm_Evento;
	private $Dt_Evento;
	private $Hr_Evento;
	private $Nm_Local;
	private $Ds_Evento;
	private $St_Evento;
	private $ID_Usuario;
	
	//Construtor da Classe
    public function __construct($Nm_Evento, $Dt_Evento, $Hr_Evento, $Nm_Local, $Ds_Evento,$St_Evento, $ID_Usuario, $ID_Evento)
    {
	  $this->Nm_Evento = $Nm_Evento;
	  $this->Dt_Evento = $Dt_Evento;
	  $this->Hr_Evento = $Hr_Evento;
	  $this->Nm_Local = $Nm_Local;
	  $this->Ds_Evento = $Ds_Evento;
	  $this->St_Evento = $St_Evento;
	  $this->ID_Usuario = $ID_Usuario;
	  $this->ID_Evento = $ID_Evento;
    }
	// GET
    public function get_ID_Evento() {
        return $this->ID_Evento;
    }
	public function get_Nm_Evento() {
        return $this->Nm_Evento;
    }
	public function get_Dt_Evento() {
        return $this->Dt_Evento;
    }
	public function get_Hr_Evento() {
        return $this->Hr_Evento;
    }
	public function get_Nm_Local() {
        return $this->Nm_Local;
    }
	public function get_Ds_Evento() {
        return $this->Ds_Evento;
    }
	public function get_St_Evento() {
        return $this->St_Evento;
    }
	public function get_ID_Usuario() {
        return $this->ID_Usuario;
    }
	// SET
	public function set_ID_Evento($ID_Evento) {
        $this->ID_Evento = $ID_Evento;
    }
	public function set_Nm_Evento($Nm_Evento) {
        $this->Nm_Evento = $Nm_Evento;
    }
	public function set_Dt_Evento($Dt_Evento) {
        $this->Dt_Evento = $Dt_Evento;
    }
	public function set_Hr_Evento($Hr_Evento) {
        $this->Hr_Evento = $Hr_Evento;
    }
	public function set_Nm_Local($Nm_Local) {
        $this->Nm_Local = $Nm_Local;
    }
	public function set_Ds_Evento($Ds_Evento) {
        $this->Ds_Evento = $Ds_Evento;
    }
	public function set_St_Evento($St_Evento) {
        $this->St_Evento = $St_Evento;
    }
	public function set_ID_Usuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }
}
?>