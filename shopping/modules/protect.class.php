<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Protect" ) == false ) {
	class LD_Protect {
		public function __construct()
		{
			foreach($_POST as $Vars) $this->Check($Vars);
			foreach($_GET as $Vars) $this->Check($Vars);
		}
		
		public function inject($value) {
			$data = date('d/m/Y G:i');
			$navegador = $_SERVER['HTTP_USER_AGENT'];
			$solicitada = $_SERVER['REQUEST_URI'];
			$metodo = $_SERVER['REQUEST_METHOD'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$log = "IP: $ip \r\n";
			$log .= "IP Reverso: $host \r\n";
			$log .= "Data: $data \r\n";
			$log .= "Navegador: $navegador \r\n";
			$log .= "Pagina: $solicitada \r\n";
			$log .= "Metodo: $metodo \r\n\r\n";
			$log .= "Value: $value \r\n\r\n";
			$log .= "--------------------\r\n\r\n";
			$fp=@fopen("logs/injects.txt", "a");
			@fwrite($fp, $log);
			@fclose($fp);
			die("<script>window.alert('Erro: Caracteres especiais detectados. Por favor volte e corrija.'); history.go(-1);</script>");
		}
	
		public function Check($string) {
            if ( substr_count( $string, "'" ) > 0 )
            {
			  $this->inject($string);
            }
            if ( substr_count( $string, ";" ) > 0 )
            {
			  $this->inject($string);
            }
            if ( substr_count( $string, "\"" ) > 0 )
            {
			  $this->inject($string);
            }
            if ( substr_count( $string, "--" ) > 0 )
            {
              $this->inject($string);
            }
            if ( substr_count( $string, "<?" ) > 0 )
            {
			  $this->inject($string);
            }
		  return $string;
		}
	}
}


?>