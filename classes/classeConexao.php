<?php
	define("conec_host","localhost");
	define("conec_user","root"); 
	define("conec_pass",""); 
	define("conec_database","DB_Ambiente");

	class conec
	{
		public static function conecta_mysql($host = conec_host, $usu = conec_user, $senha = conec_pass, $banco = conec_database)
		{
		
			try
			{
				$conec=new PDO('mysql:host='.$host.';dbname='.$banco,$usu, $senha, array(PDO::ATTR_PERSISTENT=>true));
				return $conec;
			}
			catch (Exception $e)
			{
				print $e->getMessage();
				exit;
			}
		}
	}
// para criar: conec::conecta_mysql($host,$usu,$senha,$banco);
?>
