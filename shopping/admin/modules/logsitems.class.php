<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LogsItems" ) == false ) {
	class LogsItems {
		public function __construct() 
		{
			global $tpl;
			$this->GetNumberBuys();
            if($_GET['DeleteLog'] == true) $this->Delete_Log();
			if($_GET['Write'] == true) $this->Search_Buys();
			$tpl->set("BOX_RESULT", $this->tmp_box_list);
		}	
		private function GetNumberBuys()
		{
			global $tpl, $ODBC;
			$findTotalBuysQuery = $ODBC->query("SELECT count(1) as countSolds FROM LogSolds");
			$findTotalBuys = odbc_fetch_object($findTotalBuysQuery);
			$tpl->set("TOTAL_BUYS_SYSTEM",(int)$findTotalBuys->countSolds);
		}
        private function Delete_Log()
        {
            global $ODBC;
            $ODBC->query("DELETE FROM LogSolds WHERE type='common' AND number = ". (int) $_GET['id'] );
            print("<script>alert('Log deletado com sucesso!');</script>");
        }
        private function Search_Buys()
        {
            global $ODBC, $LD_History;
            $lasts = ($_POST['lasts'] < 1 ? 1 : $_POST['lasts']);
            $login = $_POST['login'];
            if(empty($login) == false) $query_p = "and login='". $login ."'";
            $FindSoldsQuery = $ODBC->query("SELECT TOP ". $lasts ." * FROM LogSolds WHERE type='common' {$query_p} ORDER BY number DESC");
            while($FindSolds = odbc_fetch_object($FindSoldsQuery))
            {    
                $IDI++;
                $FindItemDetailsQuery = $ODBC->query("SELECT NAME,EXE,photoItem,photoItemAnc,JH,RF FROM Items WHERE Number = '". $FindSolds->itemNumber ."'");
                $FindItemDetails = odbc_fetch_object($FindItemDetailsQuery); 
                $LD_History->GetNameOptions($FindItemDetails->EXE);                 
                $LD_History->GetNameOptionJH($FindSolds->jh, $FindItemDetails->JH);
                $LD_History->GetNameOptionRefine($FindSolds->refine, $FindItemDetails->RF);
                $LD_History->GetNameOptionsSocketItem(array($FindSolds->socket1_int,$FindSolds->socket2_int,$FindSolds->socket3_int,$FindSolds->socket4_int,$FindSolds->socket5_int));
                
                $this->tmp_box_list .= "<div class=\"quadros\">
                                <div style=\"position:relative; float: right; text-align:center;\">
                                    <img src=\"../". ($FindSoldsQuery->ancient == 0 ? $FindItemDetails->photoItem : $FindItemDetails->photoItemAnc ) ."\" style=\"border: none;\" />\n
                                </div>
                                <em>ID. Interno</em>: <strong>". $FindSolds->number ."</strong> - <a href=\"?cmd=Logs::[ItemsBuys]&DeleteLog=true&id={$FindSolds->number}\">Deletar log</a><br />\n
                                <em>Login</em>: <strong>". $FindSolds->login ."</strong><br />\n
                                <em>Nome do item</em>: <strong>". $FindItemDetails->NAME ."</strong><br />\n
                                <em>Data da compra</em>: <strong>". date("d/m/Y G:i:s",$FindSolds->data) ."</strong><br />\n
                                <em>Serial</em>: <strong>". $FindSolds->serial ."</strong><br />\n
                                <em>Level</em>: <strong>+". $FindSolds->level ."</strong> | \n
                                <em>Option (adcional)</em>: <strong>+". ($FindSolds->option*4) ."</strong><br />\n
                                <em>Luck</em>: <strong>". ($FindSolds->luck == "true" ? "Sim" : "Não") ."</strong> | \n
                                <em>Skill</em>: <strong>". ($FindSolds->skill == "true" ? "Sim" : "Não") ."</strong><br />\n
                                <em>Ancient</em>: <strong>". ($FindSolds->ancient == 0 ? "Não" : "").($FindSolds->ancient == 1 ? "+5 Stamina" : "").($FindSolds->ancient == 2 ? "+10 Stamina" : "") ."</strong><br />\n
                                <em>Option Harmony</em>: <strong>". $LD_History->textHarmonyOption ."</strong><br />\n
                                <em>Option Level 380</em>: <strong>". $LD_History->textRefineOption ."</strong><br /><br />\n
                                <em><strong>Opções Excelentes</strong></em>: <br />\n
                                <em>". $LD_History->NomeOpExc1 ."</em>: <strong>". ($FindSolds->excop1 == "true" ? "Sim" : "Não") ."</strong><br />\n
                                <em>". $LD_History->NomeOpExc2 ."</em>: <strong>". ($FindSolds->excop2 == "true" ? "Sim" : "Não") ."</strong><br />\n
                                <em>". $LD_History->NomeOpExc3 ."</em>: <strong>". ($FindSolds->excop3 == "true" ? "Sim" : "Não") ."</strong><br />\n
                                <em>". $LD_History->NomeOpExc4 ."</em>: <strong>". ($FindSolds->excop4 == "true" ? "Sim" : "Não") ."</strong><br />\n
                                <em>". $LD_History->NomeOpExc5 ."</em>: <strong>". ($FindSolds->excop5 == "true" ? "Sim" : "Não") ."</strong><br />\n
                                <em>". $LD_History->NomeOpExc6 ."</em>: <strong>". ($FindSolds->excop6 == "true" ? "Sim" : "Não") ."</strong><br /><br />\n
                                <em><strong>Opções Sockets</strong></em>: <br />\n
                                <em>Slot Socket 1</em>: <strong>". ($FindSolds->socket1 == "true" ? "Sim - {$LD_History->socketItemOptionName[0]}" : "Não") ."</strong><br />\n
                                <em>Slot Socket 2</em>: <strong>". ($FindSolds->socket2 == "true" ? "Sim - {$LD_History->socketItemOptionName[1]}" : "Não") ."</strong><br />\n
                                <em>Slot Socket 3</em>: <strong>". ($FindSolds->socket3 == "true" ? "Sim - {$LD_History->socketItemOptionName[2]}" : "Não") ."</strong><br />\n
                                <em>Slot Socket 4</em>: <strong>". ($FindSolds->socket4 == "true" ? "Sim - {$LD_History->socketItemOptionName[3]}" : "Não") ."</strong><br />\n
                                <em>Slot Socket 5</em>: <strong>". ($FindSolds->socket5 == "true" ? "Sim - {$LD_History->socketItemOptionName[4]}" : "Não") ."</strong><br /><br />\n
                                <em>Preço pago</em>: <strong>". $FindSolds->price ."</strong>&nbsp;".GOLDNAME."<br />\n
                                <em>Recuperado</em>: <strong>". $FindSolds->recovery ."</strong> vezes<br />\n</div>";
            }
        }
	}
}
?>