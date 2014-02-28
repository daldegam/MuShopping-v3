<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Mssql" ) == false ) {

	class LD_Mssql {
		var $connection;
		var $database;
		var $cmd;
		var $sql_log = false;
		var $sql_debug = true;
		public function __construct() 
		{
			$this->connect();
		}
		
		public function connect() 
		{
		  if(extension_loaded("mssql") == false) dl("php_mssql.dll");
		   $this->connection = @mssql_connect( @HOST_SQL , @USER_SQL , @PWD_SQL );
		   $this->database = @mssql_select_db( @DATABASE_SQL , @$this->connection );
		   if( !$this->connection || !$this->database ) {
		     echo "<br>LdMssql Error: n&atilde;o foi possivel conectar do Banco de Dados.";
		   }
		} 
		
		public function query($cmd) 
		{
		 if($this->sql_log == true) {
			 $Security_Logs = fopen("logs/sql_".date('d-m-Y').".txt", "a");
			 @fwrite($Security_Logs, date('d/m/Y G:i')." | ".$cmd."\r\n");
			 @fclose($Security_Logs);
		 }
		 if($this->sql_debug == true) { 
			$query = mssql_query($cmd);
			if($query == false) echo "<strong>LD_Error:</strong> N&atilde;o foi possivel executar: ".$cmd; 
		 } else {
			$query = @mssql_query($cmd);
			if($query == false) echo "<strong>LD_Error:</strong> N&atilde;o foi possivel executar: ".$cmd; 
		 }
		 return $query;
		} 
		
		public function disconnect() 
		{
		   @mssql_close( @$this->connection );
		} 

	}
	
}

?>