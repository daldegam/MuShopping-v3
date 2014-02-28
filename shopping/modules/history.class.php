<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_History" ) == false ) {
	class LD_History extends LD_Mssql {
		public function __construct($Recover_Lost_Item = false, $callByCatallog = false)
		{
			global $tpl;
            if($callByCatallog == true) return;
			$this->GetTotalBuys();
			                                                                                                                  
            if($_GET['Type'] == 'buys' || $_GET['cmd'] == "RecoverLostItemSystem") $this->GetListBoxBuys($Recover_Lost_Item);
            if($_GET['Type'] == 'buysKits' || $_GET['cmd'] == "RecoverLostItemSystem") $this->GetListBoxBuysKits(true);
			elseif($_GET['Type'] == 'confirms') $this->GetListConfirms();
			
			$tpl->set("LIST_BOX_ITENS", $this->tmp_box_list);
			$tpl->set("LIST_CONFIRMS", $this->tmp_confirms);      
		}
		public function GetTotalBuys()
		{
			global $tpl, $ODBC;                            
            $ODBC_Q = $ODBC->query("SELECT count(1) as total FROM LogSolds WHERE login = '". $_SESSION['Login'] ."' AND type='common'");
            $ODBC_R = odbc_fetch_object($ODBC_Q);
            $tpl->set("TOTAL_BUYS",(int)$ODBC_R->total);
            
            $ODBC_Q = $ODBC->query("SELECT count(1) as total FROM LogSoldsKits WHERE login = '". $_SESSION['Login'] ."'");
            $ODBC_R = odbc_fetch_object($ODBC_Q);
            $tpl->set("TOTAL_BUYSKITS",(int)$ODBC_R->total);
			
			$ODBC_Q = $ODBC->query("SELECT count(1) as total FROM LogsPayments WHERE login = '". $_SESSION['Login'] ."'");
			$ODBC_R = odbc_fetch_object($ODBC_Q);
			$tpl->set("TOTAL_CONFIRMS",(int)$ODBC_R->total);
		}
		public function GetNameOptions($type)
		{
			switch($type) 
			{
				case 1:
                    $this->NomeOpExc1 = "Aumenta mana ap&oacute;s matar monstros +mana/8 "; 
                    $this->NomeOpExc2 = "Aumenta vida ap&oacute;s matar monstros +vida/8"; 
                    $this->NomeOpExc3 = "Aumenta velocidade de ataque +7"; 
                    $this->NomeOpExc4 = "Adiciona dano +2%"; 
                    $this->NomeOpExc5 = "Aumenta danos +leve1/20"; 
                    $this->NomeOpExc6 = "Excelente dano ratio +10%"; 
                    break;
                case 2:
                    $this->NomeOpExc1 = "Aumenta os zens que caem em +40%"; 
                    $this->NomeOpExc2 = "&Ecirc;xito rank defensivo +10%"; 
                    $this->NomeOpExc3 = "Devolve o golpe recebido +5%"; 
                    $this->NomeOpExc4 = "Golpe recebido reduzido +4%"; 
                    $this->NomeOpExc5 = "Aumenta mana em +4%"; 
                    $this->NomeOpExc6 = "Aumenta vida em +4%";
                    break;
                case 3:
                    $this->NomeOpExc1 = "Aumenta hp"; 
                    $this->NomeOpExc2 = "Aumenta mana"; 
                    $this->NomeOpExc3 = "Poder defensivo contra oponentes de 3%"; 
                    $this->NomeOpExc4 = "Aumenta stamina"; 
                    $this->NomeOpExc5 = "Aumenta velocidade de ataque +7"; 
                    $this->NomeOpExc6 = "Sem Efeito";
                    break;
                case 4:
                    $this->NomeOpExc1 = "+ Ataque"; 
                    $this->NomeOpExc2 = "+ Defesa"; 
                    $this->NomeOpExc3 = "+ Illusion"; 
                    $this->NomeOpExc4 = "Sem efeito"; 
                    $this->NomeOpExc5 = "Sem efeito"; 
                    $this->NomeOpExc6 = "Sem efeito";
                    break;
                case 5:
                    $this->NomeOpExc1 = "Aumenta os zens que caem em +40%"; 
                    $this->NomeOpExc2 = "&Ecirc;xito rank defensivo +10%"; 
                    $this->NomeOpExc3 = "Devolve o golpe recebido +5%"; 
                    $this->NomeOpExc4 = "Golpe recebido reduzido +4%"; 
                    $this->NomeOpExc5 = "Aumenta mana em +4%"; 
                    $this->NomeOpExc6 = "Aumenta vida em +4%";
                    break; 
                case 6:
                    $this->NomeOpExc1 = "Aumenta mana ap&oacute;s matar monstros +mana/8"; 
                    $this->NomeOpExc2 = "Aumenta vida ap&oacute;s matar monstros +vida/8"; 
                    $this->NomeOpExc3 = "Aumenta velocidade de ataque +7"; 
                    $this->NomeOpExc4 = "Adiciona dano +2%"; 
                    $this->NomeOpExc5 = "Aumenta danos +leve1/20"; 
                    $this->NomeOpExc6 = "&Ecirc;xito rank defensivo +10%";
                    break;
                case 7:
                    $this->NomeOpExc1 = "Ignora o Poder Defensivo do Oponente 5%"; 
                    $this->NomeOpExc2 = "5% Chance de retornar o dano"; 
                    $this->NomeOpExc3 = "5% Chance de recuperar toda a vida"; 
                    $this->NomeOpExc4 = "5% Chance de recuperar toda a mana"; 
                    $this->NomeOpExc5 = "Sem efeito"; 
                    $this->NomeOpExc6 = "Sem efeito";
                    break;
                default:
                    $this->NomeOpExc1 = "Sem efeito"; 
                    $this->NomeOpExc2 = "Sem efeito"; 
                    $this->NomeOpExc3 = "Sem efeito"; 
                    $this->NomeOpExc4 = "Sem efeito"; 
                    $this->NomeOpExc5 = "Sem efeito"; 
                    $this->NomeOpExc6 = "Sem efeito";
                    break;
			}
		}
        public function GetNameOptionJH($hexVal, $typeItemJH)
        {
            global $ODBC;
            if($hexVal == "00") $this->textHarmonyOption = "N&atilde;o";
            else
            {
                $findHarmonyOptionNameQ = $ODBC->query("SELECT NM,prefx".substr($hexVal,1)." as lvl FROM ItemsJewelOfHarmony WHERE TP='{$typeItemJH}'");
                $findHarmonyOptionName = odbc_fetch_object($findHarmonyOptionNameQ);
                $this->textHarmonyOption = $findHarmonyOptionName->NM.$findHarmonyOptionName->lvl;         
            }      
        }
        public function GetNameOptionRefine($refine, $typeItemRF)
        {
            global $ODBC;
            if($refine == "false") $this->textRefineOption = "N&atilde;o";
            else
            {
                $findRefineOptionNameQ = $ODBC->query("SELECT prefx1,prefx2 FROM ItemsRefinery WHERE ID={$typeItemRF}");
                $findRefineOptionName = odbc_fetch_object($findRefineOptionNameQ);
                $this->textRefineOption = $findRefineOptionName->prefx1.", ".$findRefineOptionName->prefx2;         
            }    
        }
        public function GetNameOptionsSocketItem($socketsNumbers)
        {
            require("sockets.lib.php");
            for($i = 0; $i < 5; $i++)
            {                                                                                 
                if($socketsNumbers[$i] == $socketLib['emptySocket']) { $this->socketItemOptionName[$i] = "Socket Limpo"; continue; }
                else
                {
                    foreach($socketLib['socketTypeNumber'] as $socketTypeNumber)
                    {
                        foreach($socketTypeNumber as $key => $socketArgs)
                        {
                            if((int)($key + ($i*50)) == $socketsNumbers[$i]) 
                            {   
                                $this->socketItemOptionName[$i] = $socketArgs['socketTypeName']." (".$socketArgs['socketName'] ." + ". $socketArgs['socketsArgs'][(int)($i+1)].")";
                                continue 2;    
                            } 
                        }  
                    }
                }
            } 
            /*global $ODBC;
            //SocketItem 01 Parse  
            if($socket1_int == '254' || $socket1_int == '0') $this->socketItemOptionName[0] = "Socket Limpo";
            else
            {                                 
                $socketNum = $socket1_int;
                $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, S1 FROM ItemsSocket WHERE ID = {$socketNum}");
                $SelectOptionsSocket = odbc_fetch_object($SelectOptionsSocketQ);                           
                $this->socketItemOptionName[0] = $SelectOptionsSocket->ST." (".$SelectOptionsSocket->NM ." + ". $SelectOptionsSocket->S1.")"; ;            
            }
            //SocketItem 02 Parse  
            if($socket2_int == '254' || $socket2_int == '0') $this->socketItemOptionName[1] = "Socket Limpo";
            else
            {
                $socketNum = $socket2_int - 50;
                $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, S2 FROM ItemsSocket WHERE ID = {$socketNum}");
                $SelectOptionsSocket = odbc_fetch_object($SelectOptionsSocketQ);
                $this->socketItemOptionName[1] = $SelectOptionsSocket->ST." (".$SelectOptionsSocket->NM ." + ". $SelectOptionsSocket->S2.")"; ;          
            } 
            //SocketItem 03 Parse  
            if($socket3_int == '254' || $socket3_int == '0') $this->socketItemOptionName[2] = "Socket Limpo";
            else
            {
                $socketNum = $socket3_int - 100;
                $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, S3 FROM ItemsSocket WHERE ID = {$socketNum}");
                $SelectOptionsSocket = odbc_fetch_object($SelectOptionsSocketQ);
                $this->socketItemOptionName[2] = $SelectOptionsSocket->ST." (".$SelectOptionsSocket->NM ." + ". $SelectOptionsSocket->S3.")"; ;          
            }
            //SocketItem 04 Parse  
            if($socket4_int == '254' || $socket4_int == '0') $this->socketItemOptionName[3] = "Socket Limpo";
            else
            {
                $socketNum = $socket4_int - 150;
                $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, S4 FROM ItemsSocket WHERE ID = {$socketNum}");
                $SelectOptionsSocket = odbc_fetch_object($SelectOptionsSocketQ);
                $this->socketItemOptionName[3] = $SelectOptionsSocket->ST." (".$SelectOptionsSocket->NM ." + ". $SelectOptionsSocket->S4.")"; ;          
            }
            //SocketItem 05 Parse  
            if($socket5_int == '254' || $socket5_int == '0') $this->socketItemOptionName[4] = "Socket Limpo";
            else
            {
                $socketNum = $socket5_int - 200;
                $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, S5 FROM ItemsSocket WHERE ID = {$socketNum}");
                $SelectOptionsSocket = odbc_fetch_object($SelectOptionsSocketQ);
                $this->socketItemOptionName[4] = $SelectOptionsSocket->ST." (".$SelectOptionsSocket->NM ." + ". $SelectOptionsSocket->S5.")"; ;          
            }*/  
        }           
        public function GetListBoxBuys($Recover_Lost_Item)
        {
            global $ODBC;
            $FindSoldsQuery = $ODBC->query("SELECT * FROM LogSolds WHERE login = '". $_SESSION['Login'] ."' AND type='common' ORDER BY number DESC");
            while($FindSolds = odbc_fetch_object($FindSoldsQuery))
            {    
                $IDI++;
                $FindItemDetailsQuery = $ODBC->query("SELECT NAME,EXE,photoItem,photoItemAnc,JH,RF,SetItem1,SetItem2 FROM Items WHERE Number = '". $FindSolds->itemNumber ."'");
                $FindItemDetails = odbc_fetch_object($FindItemDetailsQuery); 
                $this->GetNameOptions($FindItemDetails->EXE);                 
                $this->GetNameOptionJH($FindSolds->jh, $FindItemDetails->JH);
                $this->GetNameOptionRefine($FindSolds->refine, $FindItemDetails->RF);
                $this->GetNameOptionsSocketItem(array($FindSolds->socket1_int,$FindSolds->socket2_int,$FindSolds->socket3_int,$FindSolds->socket4_int,$FindSolds->socket5_int));
                
                $this->tmp_box_list .= "<div class=\"quadros\">
                                <div style=\"position:relative; float: right; text-align:center;\">
                                    <img src=\"". ($FindSoldsQuery->ancient == 0 ? $FindItemDetails->photoItem : $FindItemDetails->photoItemAnc ) ."\" style=\"border: none;\" />\n
                                    ". ($Recover_Lost_Item == true ? 
                                            "<br /><input type=\"button\" class=\"button\" value=\"Recuperar item\" id=\"ButtonID:". $IDI ."\" onclick=\"javascript: document.getElementById('ButtonID:". $IDI ."').disabled = 'disabled'; document.getElementById('Result_Rec_Item_IDI:". $IDI ."').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=RecoverLostItemSystem&amp;BuyID=". $FindSolds->number ."', 'Result_Rec_Item_IDI:". $IDI ."', 'get');\" />" : 
                                            "<br /><input type=\"button\" class=\"button\" value=\"Localizar item\" id=\"ButtonID:". $IDI ."\" onclick=\"javascript: document.getElementById('ButtonID:". $IDI ."').disabled = 'disabled'; document.getElementById('Result_Rec_Item_IDI:". $IDI ."').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=SearchItemSystem&amp;BuyID=". $FindSolds->number ."', 'Result_Rec_Item_IDI:". $IDI ."', 'get');\" />") ."
                                </div>
                                <em>ID. Interno</em>: <strong>". $FindSolds->number ."</strong><br />\n
                                <em>Nome do item</em>: <strong>". $FindItemDetails->NAME ."</strong><br />\n
                                <em>Data da compra</em>: <strong>". date("d/m/Y G:i:s",$FindSolds->data) ."</strong><br />\n
                                <em>Serial</em>: <strong>". $FindSolds->serial ."</strong><br />\n
                                <em>Level</em>: <strong>+". $FindSolds->level ."</strong> | \n
                                <em>Option (adcional)</em>: <strong>+". ($FindSolds->option*4) ."</strong><br />\n
                                <em>Luck</em>: <strong>". ($FindSolds->luck == "true" ? "Sim" : "N&atilde;o") ."</strong> | \n
                                <em>Skill</em>: <strong>". ($FindSolds->skill == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                <em>Ancient</em>: <strong>". ($FindSolds->ancient == 0 ? "N&atilde;o" : "").($FindSolds->ancient == 1 ? $FindItemDetails->SetItem1 : "").($FindSolds->ancient == 2 ? $FindItemDetails->SetItem2 : "") ."</strong><br />\n
                                <em>Option Harmony</em>: <strong>". $this->textHarmonyOption ."</strong><br />\n
                                <em>Option Level 380</em>: <strong>". $this->textRefineOption ."</strong><br /><br />\n
                                <em><strong>Op&ccedil;&otilde;es Excelentes</strong></em>: <br />\n
                                <em>". $this->NomeOpExc1 ."</em>: <strong>". ($FindSolds->excop1 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                <em>". $this->NomeOpExc2 ."</em>: <strong>". ($FindSolds->excop2 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                <em>". $this->NomeOpExc3 ."</em>: <strong>". ($FindSolds->excop3 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                <em>". $this->NomeOpExc4 ."</em>: <strong>". ($FindSolds->excop4 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                <em>". $this->NomeOpExc5 ."</em>: <strong>". ($FindSolds->excop5 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                <em>". $this->NomeOpExc6 ."</em>: <strong>". ($FindSolds->excop6 == "true" ? "Sim" : "N&atilde;o") ."</strong><br /><br />\n
                                <em><strong>Op&ccedil;&otilde;es Sockets</strong></em>: <br />\n
                                <em>Slot Socket 1</em>: <strong>". ($FindSolds->socket1 == "true" ? "Sim - {$this->socketItemOptionName[0]}" : "N&atilde;o") ."</strong><br />\n
                                <em>Slot Socket 2</em>: <strong>". ($FindSolds->socket2 == "true" ? "Sim - {$this->socketItemOptionName[1]}" : "N&atilde;o") ."</strong><br />\n
                                <em>Slot Socket 3</em>: <strong>". ($FindSolds->socket3 == "true" ? "Sim - {$this->socketItemOptionName[2]}" : "N&atilde;o") ."</strong><br />\n
                                <em>Slot Socket 4</em>: <strong>". ($FindSolds->socket4 == "true" ? "Sim - {$this->socketItemOptionName[3]}" : "N&atilde;o") ."</strong><br />\n
                                <em>Slot Socket 5</em>: <strong>". ($FindSolds->socket5 == "true" ? "Sim - {$this->socketItemOptionName[4]}" : "N&atilde;o") ."</strong><br /><br />\n
                                <em>Pre&ccedil;o pago</em>: <strong>". $FindSolds->price ."</strong>&nbsp;".GOLDNAME."<br />\n
                                <em>Recuperado</em>: <strong>". $FindSolds->recovery ."</strong> vezes<br />\n
                            </div>
                            <div id=\"Result_Rec_Item_IDI:". $IDI ."\" class=\"quadros\" style=\"display:none;\"></div>";
            }
        }
        public function GetListBoxBuysKits($Recover_Lost_Item)
        {         
            global $ODBC;  
            $findKitsSoldsQ = $ODBC->query("SELECT * FROM LogSoldsKits WHERE login = '". $_SESSION['Login'] ."' ORDER BY Number DESC"); 
            while($findKitsSolds = odbc_fetch_object($findKitsSoldsQ))
            {                                               //var_dump($findKitsSolds);
                $findKitDetailsQuery = $ODBC->query("SELECT * FROM Kits WHERE Number = ". $findKitsSolds->kitNumber);
                $findKitDetails = odbc_fetch_object($findKitDetailsQuery);  //var_dump($findKitDetails);
                $this->tmp_box_list .= "<div class=\"quadros\">\nNome do Kit: <strong>{$findKitDetails->kitName}</strong><br />\nPre&ccedil;o pago: <strong>{$findKitsSolds->price}</strong> ".GOLDNAME."<br />\nComprado em: <strong>". date("d/m/Y g:i a", $findKitsSolds->data) ."</strong><br />\n<strong>Produtos que est&atilde;o incluidos no kit:</strong> ";
                $FindSoldsDetailsQuery = $ODBC->query("SELECT * FROM LogSoldsKitsDetails WHERE NumberSoldKit = ". $findKitsSolds->Number ." AND login = '". $_SESSION['Login'] ."'");
                while($FindSoldsDetails = odbc_fetch_object($FindSoldsDetailsQuery))
                {                           //var_dump($FindSoldsDetails);
                    $FindSoldsQuery = $ODBC->query("SELECT * FROM LogSolds WHERE login = '". $_SESSION['Login'] ."' AND type='kit' AND serial='{$FindSoldsDetails->itemSerial}'");
                    $FindSolds = odbc_fetch_object($FindSoldsQuery);
                    $IDI++;                                                       
                    $FindItemDetailsQuery = $ODBC->query("SELECT NAME,EXE,photoItem,photoItemAnc,JH,RF,SetItem1,SetItem2 FROM Items WHERE Number = '". $FindSoldsDetails->itemId ."'");
                    $FindItemDetails = odbc_fetch_object($FindItemDetailsQuery); 
                    $this->GetNameOptions($FindItemDetails->EXE);                 
                    $this->GetNameOptionJH($FindSolds->jh, $FindItemDetails->JH);
                    $this->GetNameOptionRefine($FindSolds->refine, $FindItemDetails->RF);
                    $this->GetNameOptionsSocketItem($FindSolds->socket1_int,$FindSolds->socket2_int,$FindSolds->socket3_int,$FindSolds->socket4_int,$FindSolds->socket5_int);
                
                    $this->tmp_box_list .= "<div class=\"quadros\">
                                    <div style=\"position:relative; float: right; text-align:center;\">
                                        <img src=\"". ($FindSoldsQuery->ancient == 0 ? $FindItemDetails->photoItem : $FindItemDetails->photoItemAnc ) ."\" style=\"border: none;\" />\n
                                        ". ($Recover_Lost_Item == true ? 
                                                "<br /><input type=\"button\" class=\"button\" value=\"Recuperar item\" id=\"ButtonKitID:". $IDI ."\" onclick=\"javascript: document.getElementById('ButtonKitID:". $IDI ."').disabled = 'disabled'; document.getElementById('Result_Rec_Kit_IDI:". $IDI ."').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=RecoverLostItemSystem&amp;BuyID=". $FindSolds->number ."', 'Result_Rec_Kit_IDI:". $IDI ."', 'get');\" />" : 
                                                "<br /><input type=\"button\" class=\"button\" value=\"Localizar item\" id=\"ButtonKitID:". $IDI ."\" onclick=\"javascript: document.getElementById('ButtonKitID:". $IDI ."').disabled = 'disabled'; document.getElementById('Result_Rec_Kit_IDI:". $IDI ."').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=SearchItemSystem&amp;BuyID=". $FindSolds->number ."', 'Result_Rec_Kit_IDI:". $IDI ."', 'get');\" />") ."
                                    </div>
                                    <em>ID. Interno</em>: <strong>". $FindSolds->number ."</strong><br />\n
                                    <em>Nome do item</em>: <strong>". $FindItemDetails->NAME ."</strong><br />\n
                                    <em>Serial</em>: <strong>". $FindSolds->serial ."</strong><br />\n
                                    <em>Level</em>: <strong>+". $FindSolds->level ."</strong> | \n
                                    <em>Option (adcional)</em>: <strong>+". ($FindSolds->option*4) ."</strong><br />\n
                                    <em>Luck</em>: <strong>". ($FindSolds->luck == "true" ? "Sim" : "N&atilde;o") ."</strong> | \n
                                    <em>Skill</em>: <strong>". ($FindSolds->skill == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                    <em>Ancient</em>: <strong>". ($FindSolds->ancient == 0 ? "N&atilde;o" : "").($FindSolds->ancient == 1 ? $FindItemDetails->SetItem1 : "").($FindSolds->ancient == 2 ? $FindItemDetails->SetItem2 : "") ."</strong><br />\n
                                    <em>Option Harmony</em>: <strong>". $this->textHarmonyOption ."</strong><br />\n
                                    <em>Option Level 380</em>: <strong>". $this->textRefineOption ."</strong><br /><br />\n
                                    <em><strong>Op&ccedil;&otilde;es Excelentes</strong></em>: <br />\n
                                    <em>". $this->NomeOpExc1 ."</em>: <strong>". ($FindSolds->excop1 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                    <em>". $this->NomeOpExc2 ."</em>: <strong>". ($FindSolds->excop2 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                    <em>". $this->NomeOpExc3 ."</em>: <strong>". ($FindSolds->excop3 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                    <em>". $this->NomeOpExc4 ."</em>: <strong>". ($FindSolds->excop4 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                    <em>". $this->NomeOpExc5 ."</em>: <strong>". ($FindSolds->excop5 == "true" ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                    <em>". $this->NomeOpExc6 ."</em>: <strong>". ($FindSolds->excop6 == "true" ? "Sim" : "N&atilde;o") ."</strong><br /><br />\n
                                    <em><strong>Op&ccedil;&otilde;es Sockets</strong></em>: <br />\n
                                    <em>Slot Socket 1</em>: <strong>". ($FindSolds->socket1 == "true" ? "Sim - {$this->socketItemOptionName[0]}" : "N&atilde;o") ."</strong><br />\n
                                    <em>Slot Socket 2</em>: <strong>". ($FindSolds->socket2 == "true" ? "Sim - {$this->socketItemOptionName[1]}" : "N&atilde;o") ."</strong><br />\n
                                    <em>Slot Socket 3</em>: <strong>". ($FindSolds->socket3 == "true" ? "Sim - {$this->socketItemOptionName[2]}" : "N&atilde;o") ."</strong><br />\n
                                    <em>Slot Socket 4</em>: <strong>". ($FindSolds->socket4 == "true" ? "Sim - {$this->socketItemOptionName[3]}" : "N&atilde;o") ."</strong><br />\n
                                    <em>Slot Socket 5</em>: <strong>". ($FindSolds->socket5 == "true" ? "Sim - {$this->socketItemOptionName[4]}" : "N&atilde;o") ."</strong><br /><br />\n
                                    <em>Recuperado</em>: <strong>". $FindSolds->recovery ."</strong> vezes<br />\n
                                </div>
                                <div id=\"Result_Rec_Kit_IDI:". $IDI ."\" class=\"quadros\" style=\"display:none;\"></div>";
                }
                $this->tmp_box_list .= "</div>";  
            }
        }
		public function GetListConfirms()
		{
            global $ODBC;
			$ODBC_Q = $ODBC->query("SELECT * FROM LogsPayments WHERE login='". $_SESSION['Login'] ."' ORDER BY id DESC");
			while($ODBC_R = odbc_fetch_object($ODBC_Q))
			{
				switch($ODBC_R->status)
				{
					case 1: $ODBC_R->status = "Em andamento"; break;
					case 2: $ODBC_R->status = "Concluido"; break;
					case 3: $ODBC_R->status = "Rejeitado"; break;
				}
				$this->tmp_confirms .= "<div class=\"quadros\">
											<em>ID:</em> <strong>". $ODBC_R->id ."</strong> <br />
											<em>Quantidade de ". GOLDNAME .":</em> <strong>". $ODBC_R->golds ."</strong> <br />
											<em>Banco:</em> ". $ODBC_R->banco ." <br />
											<em>Data:</em> ". $ODBC_R->data ." <br />
											<em>Hora:</em> ". $ODBC_R->hora ." <br />
											<em>Pago em:</em> ". $ODBC_R->pago_em ." <br />
											<em>Valor:</em> ". $ODBC_R->valor ." <br />
											<em>Coment&aacute;rio:</em> ". base64_decode($ODBC_R->comentario) ." <br />
											<em>Status:</em> <strong>". $ODBC_R->status ."</strong> <br />
										</div>";
			}
		}
	}
}


?>