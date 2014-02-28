<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Logins" ) == false ) {
	class Logins {
		public $Temp_list_directory;
		public $New_list_directory;
		public $Response_List_Remove_Sessions;
		public $Response_OpenAndReadSessions;
		public function __construct() 
		{
			global $tpl;
			if(isset($_GET['RemoveSession']))
			{
				$Tmp_Address = "../tmp/sess_".$_GET['RemoveSession'];
				if(@unlink($Tmp_Address) == true)
					echo "<script type=\"text/javascript\"> alert(\"Session deletada com sucesso!\"); location=\"?cmd=Logins::[Manager]\"; </script>";
				else
					echo "<script type=\"text/javascript\"> alert(\"Erro ao deletar session! Obs: Você não pode deletar sua propria session.\"); location=\"?cmd=Logins::[Manager]\"; </script>";
			}
			$this->FindSessions();
			$tpl->Set("List_Remove_Sessions", $this->Response_List_Remove_Sessions);
			if($this->NextStep == true) $this->OpenAndReadSessions();
			$tpl->Set("OpenAndReadSessions", $this->Response_OpenAndReadSessions);
		}
		private function FindSessions()
		{
			$this->Temp_list_directory = glob("../tmp/sess_*");
			$this->Response_List_Remove_Sessions .= "<div class=\"post-footer\">";
			foreach($this->Temp_list_directory as $Files)
			{
				$Tmp_FileModify = filemtime($Files);
				$YYYY = date("Y" , $Tmp_FileModify );
				$MM = date("m" , $Tmp_FileModify );
				$DD = date("d" , $Tmp_FileModify );
				$H = date("g" , $Tmp_FileModify );
				$M = date("i" , $Tmp_FileModify );
				$S = date("s" , $Tmp_FileModify );
				
				if(mktime($H, $M, $S, $MM, $DD, $YYYY) < strtotime("-1 day"))
				{
					$this->Response_List_Remove_Sessions .= "Session <em>". $Files ."</em> excluida.<br />"; 
					unlink($Files); // Habilitar dnovo pra deletar as sessions antigas ;)
				}
				else 
				{
					$this->New_list_directory[] = $Files;
					$this->NextStep = true;
				}
			}
			$this->Response_List_Remove_Sessions .= "</div>";			
		}
		private function OpenAndReadSessions()
		{
			$this->Response_OpenAndReadSessions .= "<div class=\"post-footer\">";
			foreach($this->New_list_directory as $Files)
			{ 
				$TempFile = file($Files); 
				$Content = explode(";", $TempFile[0] ); 
				foreach($Content as $ContentAs)
				{ 
					$ContentAs = explode("|",$ContentAs);
					switch ($ContentAs[0]){
						case "Login":
							$Tmp = explode("\"",$ContentAs[1]); 
							$LoginSession = $Tmp[1]; 
						break;
						case "SecurityCode":
							$Tmp = explode("\"",$ContentAs[1]);
							$SecurityCodeSession = $Tmp[1];
						break;
						case "Browser":
							$Tmp = explode("\"",$ContentAs[1]);
							$BrowserSession = $Tmp[1];
						break;
						case "Address":
							$Tmp = explode("\"",$ContentAs[1]);
							$AddressSession = $Tmp[1];
						break;
						case "AddressShop":
							$Tmp = explode("\"",$ContentAs[1]);
							$AddressShopSession = base64_decode($Tmp[1]);
						break;
					}					
				}
				$this->Response_OpenAndReadSessions .= "Login: <em>". $LoginSession ."</em>, SecurityCode: <em>". $SecurityCodeSession ."</em> <a href=\"javascript: void(0);\" onclick='javascript: var text = \"Informações: \\nLogin: ". $LoginSession ." \\nSecurityCode: ". $SecurityCodeSession ." \\nBrowser: ". $BrowserSession ." \\nIP: ". $AddressSession ." \\nPágina: ". $AddressShopSession ."     \"; alert(text); '>[Mais Info.]</a><a href=\"?cmd=Logins::[Manager]&amp;RemoveSession=". substr($Files,12) ."\">[Excluir]</a><br />";				
			unset($LoginSession);
			unset($SecurityCodeSession);
			unset($BrowserSession);
			unset($AddressSession);
			unset($AddressShopSession);
			}
			$this->Response_OpenAndReadSessions .= "</div>";	
		}
	}
}
?>