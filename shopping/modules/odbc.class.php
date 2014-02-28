<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_ODBC" ) == false ) {

	class LD_ODBC {
		var $connection;
		var $database;
		var $cmd;
		var $odbc_debug = true;
		public function __construct() 
		{
			$this->connect();
		}
		
		public function connect() 
		{
		   $this->connection = @odbc_connect( @DNS_ODBC, @USER_ODBC, @PWD_ODBC );
		   if( !$this->connection ) {
		     echo "<br>LdODBC Error: n&atilde;o foi possivel conectar do Banco de Dados.";
		   }
		} 
		
		public function query($cmd) 
		{                         
		 if($this->odbc_debug == true) { 
			$query = odbc_exec( $this->connection, $cmd );
			if($query == false) echo "<strong>LD_Error:</strong> N&atilde;o foi possivel executar: ".$cmd; 
		 } else {
			$query = @odbc_exec( $this->connection, $cmd );
			if($query == false) echo "<strong>LD_Error:</strong> N&atilde;o foi possivel executar: ".$cmd; 
		 }
		 return $query;
		} 
		
		public function disconnect() 
		{
		   @odbc_close( @$this->connection );
		} 

	}
	
}

?>