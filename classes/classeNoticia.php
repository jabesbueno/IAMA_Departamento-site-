<?php
class classeNoticia{
   
    private $ID_Noticia;
	private $Nm_Noticia;
	private $Ds_Noticia;
	private $Dt_Noticia;
	private $Hr_Noticia;
	private $ID_Usuario;
	
	//Construtor da Classe
    public function __construct($Nm_Noticia, $Ds_Noticia, $Dt_Noticia, $Hr_Noticia, $ID_Usuario, $ID_Noticia)
    {
	  $this->Nm_Noticia = $Nm_Noticia;
	  $this->Ds_Noticia = $Ds_Noticia;
	  $this->Dt_Noticia = $Dt_Noticia;
	  $this->Hr_Noticia = $Hr_Noticia;
	  $this->ID_Usuario = $ID_Usuario;
	  $this->ID_Noticia = $ID_Noticia;
    }
	// GET
    public function get_ID_Noticia() {
        return $this->ID_Noticia;
    }
	public function get_Nm_Noticia() {
        return $this->Nm_Noticia;
    }
	public function get_Ds_Noticia() {
        return $this->Ds_Noticia;
    }
	public function get_Dt_Noticia() {
        return $this->Dt_Noticia;
    }
	public function get_Hr_Noticia() {
        return $this->Hr_Noticia;
    }
	public function get_ID_Usuario() {
        return $this->ID_Usuario;
    }
	// SET
	public function set_ID_Noticia($ID_Noticia) {
        $this->ID_Noticia = $ID_Noticia;
    }
	public function set_Nm_Noticia($Nm_Noticia) {
        $this->Nm_Noticia = $Nm_Noticia;
    }
	public function set_Ds_Noticia($Ds_Noticia) {
        $this->Ds_Noticia = $Ds_Noticia;
    }
	public function set_Dt_Noticia($Dt_Noticia) {
        $this->Dt_Noticia = $Dt_Noticia;
    }
	public function set_Hr_Noticia($Hr_Noticia) {
        $this->Hr_Noticia = $Hr_Noticia;
    }
	public function set_ID_Usuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }
}
?>