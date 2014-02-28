<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_General" ) == false ) {
	class LD_General extends LD_Mssql {
		public $Temp;
		public $Golds;
		public function __construct() 
		{
			if(defined("GOLDNAME") == false) exit(Print_error("GOLDNAME",1));
			if(defined("GOLDCOLUMN") == false) exit(Print_error("GOLDCOLUMN",1));
			if(defined("GOLDTABLE") == false) exit(Print_error("GOLDTABLE",1));
			if(defined("GOLDMEMBIDENT") == false) exit(Print_error("GOLDMEMBIDENT",1));
		}
		public function GetGolds()
		{
			global $tpl;
			$SQL_Q = $this->query("SELECT ".GOLDCOLUMN." FROM ".GOLDTABLE." WHERE ".GOLDMEMBIDENT." = '". $_SESSION['Login'] ."'");
			$SQL = mssql_fetch_row($SQL_Q); 
			$tpl->set("Golds_Amount", (int)$SQL[0]);
		}
		public function GetMembname()
		{
			global $tpl;
			$SQL_Q = $this->query("SELECT memb_name FROM MEMB_INFO WHERE memb___id = '". $_SESSION['Login'] ."'");
			$SQL = mssql_fetch_row($SQL_Q); 
			$tpl->set("memb_name", (string)$SQL[0]);
		}
		public function GetNameClass($Number)
		{
			$this->Temp = NULL;
			switch($Number) 
			{		
				case 0: $this->Temp = "Dark Wizard"; break;
				case 1: $this->Temp = "Soul Master"; break;
				case 2: $this->Temp = "Grand Master"; break;
				case 16: $this->Temp = "Dark Knight"; break;
				case 17: $this->Temp = "Blade Knight"; break;
				case 18: $this->Temp = "Blade Master"; break;
				case 32: $this->Temp = "Fary Elf"; break;
				case 33: $this->Temp = "Muse Elf"; break;
				case 34: $this->Temp = "Hight Elf"; break;
				case 48: $this->Temp = "Magic Gladiator"; break;
				case 49: $this->Temp = "Duel Master"; break;
				case 64: $this->Temp = "Dark Lord"; break;
				case 65: $this->Temp = "Lord Emporer"; break;
				case 80: $this->Temp = "Summoner"; break;
				case 81: $this->Temp = "Blood Summoner"; break;
                case 82: $this->Temp = "Dimension Master"; break;
                case 96: $this->Temp = "Rage Fighter"; break;
				case 98: $this->Temp = "Fist Master"; break;
			} 
			return $this->Temp;
		}
	}
}


?>