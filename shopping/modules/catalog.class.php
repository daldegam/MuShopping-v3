<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Catalog" ) == false ) {
	class LD_Catalog {
		public function __construct(){}   
        public function ShowCatalogKits()
        {
            global $LD_General, $ODBC;
            Require_File("modules/history.class.php");
            $LD_History = new LD_History(false, true);
                    
            $searchKitsQ = $ODBC->query("SELECT * FROM Kits WHERE active = 1");
            while($searchKits = odbc_fetch_object($searchKitsQ))
            {
                print "<div class=\"quadros\">\nNome do Kit: <strong>{$searchKits->kitName}</strong><br />\nPre&ccedil;o total: <strong>{$searchKits->priceFix}</strong> ".GOLDNAME."<br />\nVendido: <strong>{$searchKits->solds}</strong> vez(es)<br />\n<div id='kitNumber{$searchKits->Number}' style='display: none'><strong>Produtos que est&atilde;o incluidos no kit: </strong>";
                $searchItensKitQ = $ODBC->query("SELECT * FROM KitsItemsDetails WHERE kitNumber = ". $searchKits->Number );
                while($searchItensKit = odbc_fetch_object($searchItensKitQ))
                {
                    $searchItemDetailsQ = $ODBC->query("SELECT NAME,EXE,JH,RF,photoItem,photoItemAnc FROM Items WHERE Number = '{$searchItensKit->itemNumber}'");
                    $searchItemDetails = odbc_fetch_object($searchItemDetailsQ);
                    $LD_History->GetNameOptions($searchItemDetails->EXE);
                    $LD_History->GetNameOptionJH($searchItensKit->fixJH, $searchItemDetails->JH);
                    $LD_History->GetNameOptionRefine(($searchItensKit->fixRefine == 1 ? "true":"false"),$searchItemDetails->RF);
                    $LD_History->GetNameOptionsSocketItem(array($searchItensKit->fixSocket1, $searchItensKit->fixSocket2, $searchItensKit->fixSocket3, $searchItensKit->fixSocket4, $searchItensKit->fixSocket5));
                                   
                    require("sockets.lib.php");
                    //exit(var_dump($socketLib));
                    print "<div class=\"quadros\">
                            <table border=\"0\">
                                <tr><td rowspan=\"3\" valign=\"top\"><img src=\"".$searchItemDetails->photoItem."\" style=\"border:none;\" /></td></tr>
                                <tr><td>Nome: <strong>".$searchItemDetails->NAME."</strong></td></tr>
                                <tr><td>Detalhes do item:\n<br />                  
                                        <em>Level</em>: <strong>+". $searchItensKit->fixLVL ."</strong> | \n
                                        <em>Option (adcional)</em>: <strong>+". ($searchItensKit->fixOP * 4) ."</strong><br />\n
                                        <em>Luck</em>: <strong>". ($searchItensKit->fixLuck == 1 ? "Sim" : "N&atilde;o") ."</strong> | \n
                                        <em>Skill</em>: <strong>". ($searchItensKit->fixSkill == 1 ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                        <em>Ancient</em>: <strong>". ($searchItensKit->fixANC == 0 ? "N&atilde;o" : "").($searchItensKit->fixANC == 1 ? "+5 Stamina" : "").($searchItensKit->fixANC == 2 ? "+10 Stamina" : "") ."</strong><br />\n
                                        <em>Option Harmony</em>: <strong>". $LD_History->textHarmonyOption ."</strong><br />\n
                                        <em>Option Level 380</em>: <strong>". $LD_History->textRefineOption ."</strong><br /><br />\n
                                        <em><strong>Op&ccedil;&otilde;es Excelentes</strong></em>: <br />\n
                                        <em>". $LD_History->NomeOpExc1 ."</em>: <strong>". ($searchItensKit->fixOpEx1 == 1 ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                        <em>". $LD_History->NomeOpExc2 ."</em>: <strong>". ($searchItensKit->fixOpEx2 == 1 ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                        <em>". $LD_History->NomeOpExc3 ."</em>: <strong>". ($searchItensKit->fixOpEx3 == 1 ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                        <em>". $LD_History->NomeOpExc4 ."</em>: <strong>". ($searchItensKit->fixOpEx4 == 1 ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                        <em>". $LD_History->NomeOpExc5 ."</em>: <strong>". ($searchItensKit->fixOpEx5 == 1 ? "Sim" : "N&atilde;o") ."</strong><br />\n
                                        <em>". $LD_History->NomeOpExc6 ."</em>: <strong>". ($searchItensKit->fixOpEx6 == 1 ? "Sim" : "N&atilde;o") ."</strong><br /><br />\n
                                        <em><strong>Op&ccedil;&otilde;es Sockets</strong></em>: <br />\n
                                        <em>Slot Socket 1</em>: <strong>". ($searchItensKit->fixSocket1 != $socketLib['notSocket'] ? "Sim - {$LD_History->socketItemOptionName[0]}" : "N&atilde;o") ."</strong><br />\n
                                        <em>Slot Socket 2</em>: <strong>". ($searchItensKit->fixSocket2 != $socketLib['notSocket'] ? "Sim - {$LD_History->socketItemOptionName[1]}" : "N&atilde;o") ."</strong><br />\n
                                        <em>Slot Socket 3</em>: <strong>". ($searchItensKit->fixSocket3 != $socketLib['notSocket'] ? "Sim - {$LD_History->socketItemOptionName[2]}" : "N&atilde;o") ."</strong><br />\n
                                        <em>Slot Socket 4</em>: <strong>". ($searchItensKit->fixSocket4 != $socketLib['notSocket'] ? "Sim - {$LD_History->socketItemOptionName[3]}" : "N&atilde;o") ."</strong><br />\n
                                        <em>Slot Socket 5</em>: <strong>". ($searchItensKit->fixSocket5 != $socketLib['notSocket'] ? "Sim - {$LD_History->socketItemOptionName[4]}" : "N&atilde;o") ."</strong><br /><br />\n
                                </td></tr>                                                        
                             </table>
                           </div>";
                }
                print "</div>
                       <div style=\"text-align: right;\">
                        <input type=\"button\" class=\"button\" value='Mostrar itens do Kit' id='kitInputNumber{$searchKits->Number}' onclick=\"if(document.getElementById('kitNumber{$searchKits->Number}').style.display == 'none') { document.getElementById('kitNumber{$searchKits->Number}').style.display = 'block'; document.getElementById('kitInputNumber{$searchKits->Number}').value = 'Esconder itens do Kit'; } else { document.getElementById('kitNumber{$searchKits->Number}').style.display = 'none'; document.getElementById('kitInputNumber{$searchKits->Number}').value = 'Mostrar itens do Kit'; }\" />
                        <input type=\"button\" class=\"button\" value=\"Comprar Kit\" onclick=\"javascript: document.getElementById('FinishBuyDIV{$searchKits->Number}').style.display = 'block'; \" />
                        </div>
                        <div id=\"FinishBuyDIV{$searchKits->Number}\" style=\"display:none; text-align:center;\" class=\"qdestaques\"> 
                            <strong>Voc&ecirc; tem certeza que deseja comprar esse kit?<br />Compras n&atilde;o podem ser desfeitas!</strong><br />               
                            <input type=\"button\" class=\"button\" value=\"Desejo comprar e declaro aceitar os termos de uso do servidor.\" onclick=\"javascript: document.getElementById('FinishBuyDIV{$searchKits->Number}').style.display = 'none'; document.getElementById('Result_Ajax_FinishBuy{$searchKits->Number}').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=FinishBuyKit&amp;ProductID={$searchKits->Number}', 'Result_Ajax_FinishBuy{$searchKits->Number}', 'get');\" />
                        </div>
                        <div class=\"quadros\" id=\"Result_Ajax_FinishBuy{$searchKits->Number}\" style=\"display:none;\"></div>
                      </div>";
            }            
        }
        public function ShowCatalogType($ShowCatalogType)
        {
            global $LD_General, $ODBC;
            switch($ShowCatalogType)
            {                                                                            
                case "Kits": return $this->ShowCatalogKits();
                case "Ofert": $ODBC_Party = " AND ofert=1 ORDER BY solds DESC"; break;
                case "All": $ODBC_Party = " ORDER BY solds DESC"; break;
                default: $ODBC_Party = " AND CATEGORIA='".$ShowCatalogType."' ORDER BY solds DESC"; break;
            }
            $ODBC_Q = $ODBC->query("SELECT * FROM Items WHERE insertShop = 1 ". $ODBC_Party);
            while($ODBC = odbc_fetch_object($ODBC_Q))
            {
                print "<div class=\"quadros\">
                        <table border=\"0\">
                            <tr><td rowspan=\"6\"><img src=\"".$ODBC->photoItem."\" style=\"border:none;\" /></td></tr>
                            <tr><td>Nome: <strong>".$ODBC->NAME."</strong></td></tr>
                            <tr><td>Pre&ccedil;o normal: <strong>". $ODBC->price ."</strong>&nbsp;". GOLDNAME ."</td></tr>
                            <tr><td>Dispon&iacute;vel nas classes: ". 
                                    ($ODBC->C_0 == 1 ? $LD_General->GetNameClass(0).",&nbsp;":"") . 
                                    ($ODBC->C_1 == 1 ? $LD_General->GetNameClass(1).",&nbsp;":"") . 
                                    ($ODBC->C_2 == 1 ? $LD_General->GetNameClass(2).",&nbsp;":"") . 
                                    ($ODBC->C_16 == 1 ? $LD_General->GetNameClass(16).",&nbsp;":"") . 
                                    ($ODBC->C_17 == 1 ? $LD_General->GetNameClass(17).",&nbsp;":"") . 
                                    ($ODBC->C_18 == 1 ? $LD_General->GetNameClass(18).",&nbsp;":"") . 
                                    ($ODBC->C_32 == 1 ? $LD_General->GetNameClass(32).",&nbsp;":"") . 
                                    ($ODBC->C_33 == 1 ? $LD_General->GetNameClass(33).",&nbsp;":"") . 
                                    ($ODBC->C_34 == 1 ? $LD_General->GetNameClass(34).",&nbsp;":"") . 
                                    ($ODBC->C_48 == 1 ? $LD_General->GetNameClass(48).",&nbsp;":"") . 
                                    ($ODBC->C_49 == 1 ? $LD_General->GetNameClass(49).",&nbsp;":"") . 
                                    ($ODBC->C_64 == 1 ? $LD_General->GetNameClass(64).",&nbsp;":"") .  
                                    ($ODBC->C_65 == 1 ? $LD_General->GetNameClass(65).",&nbsp;":"") .
                                    ($ODBC->C_80 == 1 ? $LD_General->GetNameClass(80).",&nbsp;":"") . 
                                    ($ODBC->C_81 == 1 ? $LD_General->GetNameClass(81).",&nbsp;":"") . 
                                    ($ODBC->C_82 == 1 ? $LD_General->GetNameClass(82).",&nbsp;":"") .
                                    ($ODBC->C_96 == 1 ? $LD_General->GetNameClass(96).",&nbsp;":"") .
                                    ($ODBC->C_98 == 1 ? $LD_General->GetNameClass(98):"") 
                            ."</td></tr>
                            ".(defined("HIDDEN_TOTAL_BUYS_CATALOG_ITEM") == true && constant("HIDDEN_TOTAL_BUYS_CATALOG_ITEM") == true ? "<tr><td>Comprado: <strong>".$ODBC->solds." vezes</strong></td></tr>" : null)."
                            <tr><td><input type=\"button\" class=\"button\" value=\"Ver informa&ccedil;&otilde;es\" onclick=\"Javascript: window.location='?cmd=CatalogSystemDetails&amp;ProductId=". $ODBC->Number ."'\" /></td></tr>
                        </table>
                       </div>";
            }            
        }
		public function GetProductDetails($ProductID)
		{
			global $tpl, $LD_General, $ODBC;
			$ODBC_Q = $ODBC->query("SELECT * FROM Items WHERE Number='".$ProductID."'");
			$ODBC_R = odbc_fetch_object($ODBC_Q);
			if(odbc_num_rows($ODBC_Q) == 0) exit(Print_error("<script type=\"text/javascript\">alert(\"Desculpe, esse produto não encontrado.\"); //history.go(-1);</script>"));
			$tpl->set("ProductID", $ProductID);
			$tpl->set("ProductName", $ODBC_R->NAME);
			$tpl->set("ProductPhoto", $ODBC_R->photoItem);
			$tpl->set("ProductPhotoAnc", $ODBC_R->photoItemAnc);
			$tpl->set("NormalPriceJS", $ODBC_R->price);
			$tpl->set("LevelPrice", $ODBC_R->priceLevel);
			$tpl->set("AdcionalPrice", $ODBC_R->priceOption);
			$tpl->set("SkillPrice", $ODBC_R->priceSkill);
			$tpl->set("LuckPrice", $ODBC_R->priceLuck);        
            $tpl->set("AncientPrice", $ODBC_R->priceAncient);   
            $tpl->set("JhPrice", $ODBC_R->priceJh);             
            $tpl->set("RefinePrice", $ODBC_R->priceRefine);
            $tpl->set("SocketPrice", $ODBC_R->priceSocket);
			$tpl->set("OpExcPrice", $ODBC_R->priceOptExc);
			$tpl->set("ClassesName", ($ODBC_R->C_0 == 1 ? $LD_General->GetNameClass(0).",&nbsp;":"") . 
									 ($ODBC_R->C_1 == 1 ? $LD_General->GetNameClass(1).",&nbsp;":"") . 
									 ($ODBC_R->C_2 == 1 ? $LD_General->GetNameClass(2).",&nbsp;":"") . 
									 ($ODBC_R->C_16 == 1 ? $LD_General->GetNameClass(16).",&nbsp;":"") . 
									 ($ODBC_R->C_17 == 1 ? $LD_General->GetNameClass(17).",&nbsp;":"") . 
									 ($ODBC_R->C_18 == 1 ? $LD_General->GetNameClass(18).",&nbsp;":"") . 
									 ($ODBC_R->C_32 == 1 ? $LD_General->GetNameClass(32).",&nbsp;":"") . 
									 ($ODBC_R->C_33 == 1 ? $LD_General->GetNameClass(33).",&nbsp;":"") . 
									 ($ODBC_R->C_34 == 1 ? $LD_General->GetNameClass(34).",&nbsp;":"") . 
									 ($ODBC_R->C_48 == 1 ? $LD_General->GetNameClass(48).",&nbsp;":"") . 
									 ($ODBC_R->C_49 == 1 ? $LD_General->GetNameClass(49).",&nbsp;":"") . 
									 ($ODBC_R->C_64 == 1 ? $LD_General->GetNameClass(64).",&nbsp;":"") .  
									 ($ODBC_R->C_65 == 1 ? $LD_General->GetNameClass(65).",&nbsp;":"") .
									 ($ODBC_R->C_80 == 1 ? $LD_General->GetNameClass(80).",&nbsp;":"") . 
                                     ($ODBC_R->C_81 == 1 ? $LD_General->GetNameClass(81).",&nbsp;":"") . 
                                     ($ODBC_R->C_82 == 1 ? $LD_General->GetNameClass(82).",&nbsp;":"") . 
									 ($ODBC_R->C_96 == 1 ? $LD_General->GetNameClass(96).",&nbsp;":"") . 
									 ($ODBC_R->C_98 == 1 ? $LD_General->GetNameClass(98).",&nbsp;":""));
			$tpl->set("DisabledLevel", ($ODBC_R->LVL == "SN" || $ODBC_R->LVL != "NO" ? "disabled=\"disabled\"":""));
			$tpl->set("LevelFix", ($ODBC_R->LVL != "SN" && $ODBC_R->LVL != "NO" ? (int)$ODBC_R->LVL:"0"));
			$tpl->set("DisabledAdcional", ($ODBC_R->OP == 0 ? "disabled=\"disabled\"":"")); 
			$tpl->set("DisabledAncient", ($ODBC_R->ANC == 0 ? "disabled=\"disabled\"":""));
			//$tpl->set("ProductNameAncient", ($ODBC_R->ANC == 1 ? $ODBC_R->SetItem1:""));
			$tpl->set("DisabledSkill", ($ODBC_R->SK == 0 ? "disabled=\"disabled\"":""));
			$tpl->set("DisabledLuck", ($ODBC_R->LK == 0 ? "disabled=\"disabled\"":""));
			$tpl->set("DisabledOpExc", ($ODBC_R->EXE == 0 ? "disabled=\"disabled\"":""));                     
            $tpl->set("DisabledJH", ($ODBC_R->JH == 0 || SYSTEM_ITEMS == "OLD" ? "disabled=\"disabled\"":""));
            $tpl->set("DisabledRefine", ($ODBC_R->RF == 0 || SYSTEM_ITEMS == "OLD" ? "disabled=\"disabled\"":""));  
            $tpl->set("DisabledSocket", ($ODBC_R->Socket == 0 ? "disabled=\"disabled\"":""));
			$tpl->set("MaxOptionsBuy", $ODBC_R->maxOptExcSel); 
            if($ODBC_R->ANC == 1)
            {
                $tmpAncSelect = "<option value='0'>N&atilde;o</option>";
                if($ODBC_R->SetItem1 != "NO") $tpl->set("SetItemAnc1", $ODBC_R->SetItem1); else $tpl->set("SetItemAnc1", "");
                if($ODBC_R->SetItem2 != "NO") $tpl->set("SetItemAnc2", $ODBC_R->SetItem2); else $tpl->set("SetItemAnc2", ""); 
                if($ODBC_R->SetItem1 != "NO") $tmpAncSelect .= "<option value='1'>{$ODBC_R->SetItem1}</option>";
                if($ODBC_R->SetItem2 != "NO") $tmpAncSelect .= "<option value='2'>{$ODBC_R->SetItem2}</option>";
                $tpl->set("OptionSelectAnc", $tmpAncSelect);  
            } 
            else
            {
                $tpl->set("SetItemAnc1", "");
                $tpl->set("SetItemAnc2", ""); 
                $tpl->set("OptionSelectAnc", "<option value='0'>N&atilde;o</option>");  
            }                                                
            
            if($ODBC_R->JH == 0)
            {
                $tpl->set("OptionSelectJH", "<option value='00'>Nenhuma</option>");   
            }   
            else
            {
                $SelectOptionsJhQ = $ODBC->query("SELECT * FROM ItemsJewelOfHarmony WHERE TP = '{$ODBC_R->JH}' ORDER BY [Number]");
                while($SelectOptionsJh = odbc_fetch_array($SelectOptionsJhQ))
                {
                    if(substr($SelectOptionsJh['NM'],0 ,8) == "NONE JoH") continue;  
                    
                    for($iJh = 0; $iJh < 14; $iJh++)
                    {         
                        $indexJh = strtoupper(dechex($iJh)); 
                        if($this->isZeroOptionJh == true && $SelectOptionsJh['prefx'.$indexJh] == 0) continue;             
                        if($SelectOptionsJh['prefx'.$indexJh] == 0) $this->isZeroOptionJh = true;
                        $this->optionJHTemp .= "<option value='{$SelectOptionsJh['ID']}{$indexJh}'>{$SelectOptionsJh['NM']} ". $SelectOptionsJh['prefx'.$indexJh] ." </option>\n";
                    } 
                    $this->isZeroOptionJh = false;   
                    $this->optionJHTemp .= "<option disabled='disabled'>--------</option>\n";  
                }     
                $tpl->set("OptionSelectJH", "<option value='00'>Nenhuma</option><option disabled='disabled'>--------</option>\n".$this->optionJHTemp);           
            }  
            
            if($ODBC_R->RF == 0)
            {
                $tpl->set("OptionRadioRF", "Nenhuma");   
            }   
            else
            {
                $SelectOptionRefineQ = $ODBC->query("SELECT prefx1, prefx2 FROM ItemsRefinery WHERE ID={$ODBC_R->RF}");
                $SelectOptionRefine = odbc_fetch_object($SelectOptionRefineQ);  
                $tpl->set("OptionRadioRF", $SelectOptionRefine->prefx1.", ".$SelectOptionRefine->prefx2);    
            }
            
            require("modules/sockets.lib.php");
            if($ODBC_R->Socket == 0)
            {                                                                                                
                $tpl->set("OptionSocketSelect1", "<option value=\"{$socketLib['notSocket']}\">Slot de socket fechado</option>");   
                $tpl->set("OptionSocketSelect2", "<option value=\"{$socketLib['notSocket']}\">Slot de socket fechado</option>");   
                $tpl->set("OptionSocketSelect3", "<option value=\"{$socketLib['notSocket']}\">Slot de socket fechado</option>");   
                $tpl->set("OptionSocketSelect4", "<option value=\"{$socketLib['notSocket']}\">Slot de socket fechado</option>");   
                $tpl->set("OptionSocketSelect5", "<option value=\"{$socketLib['notSocket']}\">Slot de socket fechado</option>");   
            }   
            else
            {
                switch($ODBC_R->CATEGORIA)
                {   //None: -1, Fire: 1, Water: 2, Ice: 3, Wind: 4, Lightning: 5, Ground/Earth: 6          
                    case "Amulets": 
                        $typesSockets = array("-1");
                        break;  
                    case "Armors": 
                        $typesSockets = array("2", "4", "6"); 
                        break;  
                    case "Axes":                         
                        $typesSockets = array("1", "3", "5");
                        break;  
                    case "Boots":                                       
                        $typesSockets = array("2", "4", "6"); 
                        break;  
                    case "Bows":                          
                        $typesSockets = array("1", "3", "5");
                        break;  
                    case "Castel Siege": 
                        $typesSockets = array("-1");
                        break;  
                    case "CrossBows":                       
                        $typesSockets = array("1", "3", "5");
                        break;  
                    case "Events": 
                        $typesSockets = array("-1");
                        break;  
                    case "Events MIX": 
                        $typesSockets = array("-1");
                        break;  
                    case "Gifts/Boxs": 
                        $typesSockets = array("-1");
                        break;  
                    case "Gloves":                                        
                        $typesSockets = array("2", "4", "6"); 
                        break;  
                    case "Guards/Pets": 
                        $typesSockets = array("-1");
                        break;   
                    case "Helms":                                      
                        $typesSockets = array("2", "4", "6"); 
                        break;    
                    case "Jewels": 
                        $typesSockets = array("-1");
                        break;    
                    case "Jewels MIX": 
                        $typesSockets = array("-1");
                        break;    
                    case "Maces":                         
                        $typesSockets = array("1", "3", "5");
                        break;    
                    case "Mix Items": 
                        $typesSockets = array("-1");
                        break;    
                    case "Mix Pets": 
                        $typesSockets = array("-1");
                        break;    
                    case "New/Test": 
                        $typesSockets = array("-1");
                        break;    
                    case "Orbs": 
                        $typesSockets = array("-1");
                        break;    
                    case "Other Items": 
                        $typesSockets = array("-1");
                        break;    
                    case "Pants":                                       
                        $typesSockets = array("2", "4", "6"); 
                        break;    
                    case "Pendants": 
                        $typesSockets = array("-1");
                        break;    
                    case "Potions": 
                        $typesSockets = array("-1");
                        break;    
                    case "Quests": 
                        $typesSockets = array("-1");
                        break;    
                    case "Rings": 
                        $typesSockets = array("-1");
                        break;    
                    case "Scepters":                       
                        $typesSockets = array("1", "3", "5");
                        break;    
                    case "Scrolls": 
                        $typesSockets = array("-1");
                        break;    
                    case "Shields":                                  
                        $typesSockets = array("2", "4", "6"); 
                        break;    
                    case "Spears":                         
                        $typesSockets = array("1", "3", "5");
                        break;    
                    case "Staffs":                        
                        $typesSockets = array("1", "3", "5");
                        break;    
                    case "Swords":                       
                        $typesSockets = array("1", "3", "5");
                        break;    
                    case "Wings":                      
                        $typesSockets = array("-1"); 
                        break;  
                    default:
                        $typesSockets = array("-1");                       
                }
                if($typesSockets[0] == "-1")   
                {                                                                                  
                    $tpl->set("OptionSocketSelect1", "<option value=\"{$socketLib['emptySocket']}\">Socket livre [Provavelmente sem suporte]</option>"); 
                    $tpl->set("OptionSocketSelect2", "<option value=\"{$socketLib['emptySocket']}\">Socket livre [Provavelmente sem suporte]</option>"); 
                    $tpl->set("OptionSocketSelect3", "<option value=\"{$socketLib['emptySocket']}\">Socket livre [Provavelmente sem suporte]</option>"); 
                    $tpl->set("OptionSocketSelect4", "<option value=\"{$socketLib['emptySocket']}\">Socket livre [Provavelmente sem suporte]</option>"); 
                    $tpl->set("OptionSocketSelect5", "<option value=\"{$socketLib['emptySocket']}\">Socket livre [Provavelmente sem suporte]</option>"); 
                }
                else
                {
                    for($iSocketCount = 0, $iSocketIncrement = count($typesSockets); $iSocketCount < $iSocketIncrement; $iSocketCount++)
                    {   
                        foreach($socketLib['socketTypeNumber'][$typesSockets[$iSocketCount]] as $key => $socket)
                        {
                            $this->selectOptionsSocketItemTmp[0] .= "<option value=\"". (int)($key) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][1]})</option>\n";
                            $this->selectOptionsSocketItemTmp[1] .= "<option value=\"". (int)($key+50) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][2]})</option>\n";
                            $this->selectOptionsSocketItemTmp[2] .= "<option value=\"". (int)($key+100) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][3]})</option>\n";
                            $this->selectOptionsSocketItemTmp[3] .= "<option value=\"". (int)($key+150) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][5]})</option>\n";
                            $this->selectOptionsSocketItemTmp[4] .= "<option value=\"". (int)($key+200) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][5]})</option>\n";
                        }
                    }
                    /*for($iSocketCount = 0, $iSocketIncrement = count($typesSockets); $iSocketCount < $iSocketIncrement; $iSocketCount++)
                    {
                        $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, ID, S1, S2, S3, S4, S5 FROM ItemsSocket WHERE TP = ".$typesSockets[$iSocketCount]);
                        while($SelectOptionsSocket = odbc_fetch_array($SelectOptionsSocketQ))
                        {                                                                      
                            $this->selectOptionsSocketItemTmp[0] .= "<option value=\"". ($SelectOptionsSocket['ID']) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S1']})</option>\n";
                            $this->selectOptionsSocketItemTmp[1] .= "<option value=\"". ($SelectOptionsSocket['ID']+50) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S2']})</option>\n";
                            $this->selectOptionsSocketItemTmp[2] .= "<option value=\"". ($SelectOptionsSocket['ID']+100) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S3']})</option>\n";
                            $this->selectOptionsSocketItemTmp[3] .= "<option value=\"". ($SelectOptionsSocket['ID']+150) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S4']})</option>\n";
                            $this->selectOptionsSocketItemTmp[4] .= "<option value=\"". ($SelectOptionsSocket['ID']+200) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S5']})</option>\n";
                        }
                    }*/                                                                                       
                    $tpl->set("OptionSocketSelect1", "<option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre</option>".$this->selectOptionsSocketItemTmp[0]); 
                    $tpl->set("OptionSocketSelect2", "<option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre</option>".$this->selectOptionsSocketItemTmp[1]); 
                    $tpl->set("OptionSocketSelect3", "<option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre</option>".$this->selectOptionsSocketItemTmp[2]); 
                    $tpl->set("OptionSocketSelect4", "<option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre</option>".$this->selectOptionsSocketItemTmp[3]); 
                    $tpl->set("OptionSocketSelect5", "<option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre</option>".$this->selectOptionsSocketItemTmp[4]); 
                }  
            }                    
			$tpl->set("MaxOptText", "<em>Max. de op&ccedil;&otilde;es excelentes: </em><strong>". $ODBC_R->maxOptExcSel ."</strong>");
			if($_SESSION['COUPON_ACTIVE'] == true)
			{
				$tpl->set("NormalPrice", ceil((( $ODBC_R->preco / 100 ) * (100 - $_SESSION['COUPON_PERCENT']))));
				$tpl->set("CouponActiveJS", "true");
				$tpl->set("CouponAmount", $_SESSION['COUPON_PERCENT']);
				$tpl->set("CouponCode", $_SESSION['COUPON_CODE']);
				$tpl->set("CouponActiveDIV", "<div id=\"CouponCodeDIV\" style=\"text-align:center;\" class=\"quadros\">Cupom <em>".$_SESSION['COUPON_CODE']."</em> ativado.<br />Valor do desconto <em>".$_SESSION['COUPON_PERCENT']."%</em>.</div>");
			}
			else
			{
				$tpl->set("NormalPrice", $ODBC_R->price);
				$tpl->set("CouponActiveJS", "false");
				$tpl->set("CouponAmount", 0);
				$tpl->set("CouponCode", "");
				$tpl->set("CouponActiveDIV", "");
			}
			switch($ODBC_R->EXE) 
			{
				case 1:
                    $tpl->set("NomeOpExc1", "Aumenta mana ap&oacute;s matar monstros +mana/8 "); 
                    $tpl->set("NomeOpExc2", "Aumenta vida ap&oacute;s matar monstros +vida/8"); 
                    $tpl->set("NomeOpExc3", "Aumenta velocidade de ataque +7"); 
                    $tpl->set("NomeOpExc4", "Adiciona dano +2%"); 
                    $tpl->set("NomeOpExc5", "Aumenta danos +leve1/20"); 
                    $tpl->set("NomeOpExc6", "Excelente dano ratio +10%"); 
                    
                    $tpl->set("NomeOpExc1Disabled", "false"); 
                    $tpl->set("NomeOpExc2Disabled", "false"); 
                    $tpl->set("NomeOpExc3Disabled", "false"); 
                    $tpl->set("NomeOpExc4Disabled", "false"); 
                    $tpl->set("NomeOpExc5Disabled", "false"); 
                    $tpl->set("NomeOpExc6Disabled", "false"); 
                    break;
                case 2:
                    $tpl->set("NomeOpExc1", "Aumenta os zens que caem em +40%"); 
                    $tpl->set("NomeOpExc2", "&Ecirc;xito rank defensivo +10%"); 
                    $tpl->set("NomeOpExc3", "Devolve o golpe recebido +5%"); 
                    $tpl->set("NomeOpExc4", "Golpe recebido reduzido +4%"); 
                    $tpl->set("NomeOpExc5", "Aumenta mana em +4%"); 
                    $tpl->set("NomeOpExc6", "Aumenta vida em +4%");
                    
                    $tpl->set("NomeOpExc1Disabled", "false"); 
                    $tpl->set("NomeOpExc2Disabled", "false"); 
                    $tpl->set("NomeOpExc3Disabled", "false"); 
                    $tpl->set("NomeOpExc4Disabled", "false"); 
                    $tpl->set("NomeOpExc5Disabled", "false"); 
                    $tpl->set("NomeOpExc6Disabled", "false"); 
                    break;
                case 3:
                    $tpl->set("NomeOpExc1", "Aumenta hp"); 
                    $tpl->set("NomeOpExc2", "Aumenta mana"); 
                    $tpl->set("NomeOpExc3", "Poder defensivo contra oponentes de 3%"); 
                    $tpl->set("NomeOpExc4", "Aumenta stamina"); 
                    $tpl->set("NomeOpExc5", "Aumenta velocidade de ataque +7"); 
                    $tpl->set("NomeOpExc6", "Sem Efeito");
                    
                    $tpl->set("NomeOpExc1Disabled", "false"); 
                    $tpl->set("NomeOpExc2Disabled", "false"); 
                    $tpl->set("NomeOpExc3Disabled", "false"); 
                    $tpl->set("NomeOpExc4Disabled", "false"); 
                    $tpl->set("NomeOpExc5Disabled", "false"); 
                    $tpl->set("NomeOpExc6Disabled", "\"disabled\"");
                    break;
                case 4:
                    $tpl->set("NomeOpExc1", "+ Ataque"); 
                    $tpl->set("NomeOpExc2", "+ Defesa"); 
                    $tpl->set("NomeOpExc3", "+ Illusion"); 
                    $tpl->set("NomeOpExc4", "Sem efeito"); 
                    $tpl->set("NomeOpExc5", "Sem efeito"); 
                    $tpl->set("NomeOpExc6", "Sem efeito");
                    
                    $tpl->set("NomeOpExc1Disabled", "false"); 
                    $tpl->set("NomeOpExc2Disabled", "false"); 
                    $tpl->set("NomeOpExc3Disabled", "false"); 
                    $tpl->set("NomeOpExc4Disabled", "\"disabled\""); 
                    $tpl->set("NomeOpExc5Disabled", "\"disabled\""); 
                    $tpl->set("NomeOpExc6Disabled", "\"disabled\"");
                    break;
                case 5:
                    $tpl->set("NomeOpExc1", "Aumenta os zens que caem em +40%"); 
                    $tpl->set("NomeOpExc2", "&Ecirc;xito rank defensivo +10%"); 
                    $tpl->set("NomeOpExc3", "Devolve o golpe recebido +5%"); 
                    $tpl->set("NomeOpExc4", "Golpe recebido reduzido +4%"); 
                    $tpl->set("NomeOpExc5", "Aumenta mana em +4%"); 
                    $tpl->set("NomeOpExc6", "Aumenta vida em +4%");
                    
                    $tpl->set("NomeOpExc1Disabled", "false"); 
                    $tpl->set("NomeOpExc2Disabled", "false"); 
                    $tpl->set("NomeOpExc3Disabled", "false"); 
                    $tpl->set("NomeOpExc4Disabled", "false"); 
                    $tpl->set("NomeOpExc5Disabled", "false"); 
                    $tpl->set("NomeOpExc6Disabled", "false");
                    break;
                case 6:
                    $tpl->set("NomeOpExc1", "Aumenta mana ap&oacute;s matar monstros +mana/8"); 
                    $tpl->set("NomeOpExc2", "Aumenta vida ap&oacute;s matar monstros +vida/8"); 
                    $tpl->set("NomeOpExc3", "Aumenta velocidade de ataque +7"); 
                    $tpl->set("NomeOpExc4", "Adiciona dano +2%"); 
                    $tpl->set("NomeOpExc5", "Aumenta danos +leve1/20"); 
                    $tpl->set("NomeOpExc6", "&Ecirc;xito rank defensivo +10%");
                    
                    $tpl->set("NomeOpExc1Disabled", "false"); 
                    $tpl->set("NomeOpExc2Disabled", "false"); 
                    $tpl->set("NomeOpExc3Disabled", "false"); 
                    $tpl->set("NomeOpExc4Disabled", "false"); 
                    $tpl->set("NomeOpExc5Disabled", "false"); 
                    $tpl->set("NomeOpExc6Disabled", "false");
                    break;
                case 7:
                    $tpl->set("NomeOpExc1", "Ignora o Poder Defensivo do Oponente 5%"); 
                    $tpl->set("NomeOpExc2", "5% Chance de retornar o dano"); 
                    $tpl->set("NomeOpExc3", "5% Chance de recuperar toda a vida"); 
                    $tpl->set("NomeOpExc4", "5% Chance de recuperar toda a mana"); 
                    $tpl->set("NomeOpExc5", "Sem efeito"); 
                    $tpl->set("NomeOpExc6", "Sem efeito");
                    
                    $tpl->set("NomeOpExc1Disabled", "false"); 
                    $tpl->set("NomeOpExc2Disabled", "false"); 
                    $tpl->set("NomeOpExc3Disabled", "false"); 
                    $tpl->set("NomeOpExc4Disabled", "false"); 
                    $tpl->set("NomeOpExc5Disabled", "true"); 
                    $tpl->set("NomeOpExc6Disabled", "true");
                    break;
                default:
                    $tpl->set("NomeOpExc1", "Sem efeito"); 
                    $tpl->set("NomeOpExc2", "Sem efeito"); 
                    $tpl->set("NomeOpExc3", "Sem efeito"); 
                    $tpl->set("NomeOpExc4", "Sem efeito"); 
                    $tpl->set("NomeOpExc5", "Sem efeito"); 
                    $tpl->set("NomeOpExc6", "Sem efeito");
                    
                    $tpl->set("NomeOpExc1Disabled", "\"disabled\""); 
                    $tpl->set("NomeOpExc2Disabled", "\"disabled\""); 
                    $tpl->set("NomeOpExc3Disabled", "\"disabled\""); 
                    $tpl->set("NomeOpExc4Disabled", "\"disabled\""); 
                    $tpl->set("NomeOpExc5Disabled", "\"disabled\""); 
                    $tpl->set("NomeOpExc6Disabled", "\"disabled\"");
                    break;
			}
		}
	}
}


?>