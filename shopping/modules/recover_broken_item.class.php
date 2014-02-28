<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Recover_Broken_Item" ) == false ) {
	class LD_Recover_Broken_Item extends LD_Mssql {
		public $ResponseItems;
		public function __construct()
		{
			global $LD_Items;
			global $tpl;
			$LD_Items->GetVaultContent();
			$LD_Items->CutSlotsVault();
			$LD_Items->CutHexSlotsVault();
			
			$SQL_Q = $this->query("SELECT ConnectStat FROM MEMB_STAT WHERE memb___id='". $_SESSION['Login'] ."'");
			$SQL = mssql_fetch_object($SQL_Q);
			if($SQL->ConnectStat <> 0) 
			{
				$tpl->set("LIST_BOX_ITENS", "<ul><li>Voc&ecirc; deve estar offline do jogo para usar essa op&ccedil;&atilde;o!</li></ul>");
				return;
			}
			
			if(isset($_GET['WriteVault']) == false) 
				$this->Find_Items(); 
			else
				$this->Fix_Items(); 			
			
			$tpl->set("LIST_BOX_ITENS", $this->ResponseItems);
			
		}
		public function Find_Items()
		{
			global $LD_Items;
			//global $LD_XML;
			$this->ResponseItems .= "<em><strong>Lista de itens do seu bau:</strong></em> <br /> <form action=\"?cmd=RecoverBrokenItemSystem&amp;WriteVault=true\" method=\"POST\">";
			for($i = 0; $i < 120; $i++)
			{
				if($LD_Items->Vault_Slots[$i]['Free'] == false) {
					$DurabilityTmp = hexdec(substr($LD_Items->Vault_Slots[$i]['Hex'], 4, 2));
					$this->ResponseItems .= "<div class=\"quadros\">
												<em>Item:</em> <strong>". (empty($LD_Items->Vault_Slots[$i]['Name']) ? "Item não cadastrado no banco de dados" : $LD_Items->Vault_Slots[$i]['Name']) ."</strong><br />
												<em>Alterar a durabilidade desse item:</em> <input type=\"checkbox\" name=\"Alter_Slot:". $i ."\" id=\"Alter_Slot:". $i ."\" value=\"1\" onclick=\"javascript: Alter_Input('Slot:". $i ."')\" /><br />
												<em>Durabilidade atual:</em> <strong>". $DurabilityTmp ."</strong>, alterar para: <input name=\"Slot:". $i ."\" id=\"Slot:". $i ."\" type=\"text\" value=\"". (empty($LD_Items->Vault_Slots[$i]['Dur']) ? $DurabilityTmp : $LD_Items->Vault_Slots[$i]['Dur']) ."\" maxlength=\"3\" style=\"width:25px;\" readonly=\"readonly\" disabled=\"disabled\" /><br />
											 </div>";
				}
			}
			$this->ResponseItems .= "<input type=\"submit\" class=\"button\" value=\"Gravar alterações\" /></form>";
		}
		public function Fix_Items()
		{
			global $Protect;
			global $LD_Items;
			for($i = 0; $i < 120; $i++)
			{
				if(isset($_POST['Alter_Slot:'.$i]) == true)
				{
					$_POST['Slot:'.$i] = (int) ($LD_Items->Vault_Slots[$i]['Dur'] < 1 || $LD_Items->Vault_Slots[$i]['Dur'] > 255 ? 255 : $LD_Items->Vault_Slots[$i]['Dur']);
                    $LD_Items->Vault_Slots[$i]['Hex'] = substr($LD_Items->Vault_Slots[$i]['Hex'],0,4) . str_pad(strtoupper(dechex($_POST['Slot:'.$i])), 2, "0", STR_PAD_LEFT) . substr($LD_Items->Vault_Slots[$i]['Hex'],6);
				}
			}
			$LD_Items->WriteVault();
			$this->ResponseItems .= "<em>Seus itens foram alterados com sucesso!</em><br />Obrigado.<br />Tenha um bom jogo.";
		}
	}
}


?>