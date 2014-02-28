<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_FinishBuy" ) == false ) {
    class LD_FinishBuy extends LD_Mssql {
     // public $End_Price, $Price, $Price_Level, $Price_Adicional, $Price_Skill, $Price_Luck, $Price_Ancient, $Price_OpExc, $ProductID, $Item_Level, $Item_Option, $Item_Ancient, $Item_Skill, $Item_Luck, $Item_OpExc_1, $Item_OpExc_2, $Item_OpExc_3, $Item_OpExc_4, $Item_OpExc_5, $Item_OpExc_6;
        public function __construct($ProductID,$Item_Level,$Item_Option,$Item_Ancient,$Item_Skill,$Item_Luck,$Item_OpExc_1,$Item_OpExc_2,$Item_OpExc_3,$Item_OpExc_4,$Item_OpExc_5,$Item_OpExc_6,$Item_JH,$Item_Refine,$Item_Socket_Slot_1,$Item_Socket_Slot_2,$Item_Socket_Slot_3,$Item_Socket_Slot_4,$Item_Socket_Slot_5,$Item_Socket_Slot_1_Option,$Item_Socket_Slot_2_Option,$Item_Socket_Slot_3_Option,$Item_Socket_Slot_4_Option,$Item_Socket_Slot_5_Option,$buyKit = false) 
        { 
            global $LD_Items;
            
            $SQL_Q = $this->query("SELECT ConnectStat FROM MEMB_STAT WHERE memb___id='". $_SESSION['Login'] ."'");
            $SQL = mssql_fetch_object($SQL_Q);
            if($SQL->ConnectStat <> 0) exit(Print_error("<ul><li>Voc&ecirc; deve estar offline do jogo para efetuar essa a&ccedil;&atilde;o!</li></ul>"));
            
            $this->buyKit = $buyKit;
            if($this->buyKit == false) print("<ul><li>Aguarde, sua compra esta sendo finalizada.</li></ul>");
            $this->ProductID         = $ProductID;
            $this->Item_Level         = ($Item_Level < 0 || $Item_Level > 15 ? 0 : $Item_Level);
            $this->Item_Option         = ($Item_Option < 0 || $Item_Option > 7 ? 0 : $Item_Option);
            $this->Item_Ancient     = ($Item_Ancient < 0 || $Item_Ancient > 3 ? 0 : $Item_Ancient);
            $this->Item_Skill         = strtolower($Item_Skill);
            $this->Item_Luck         = strtolower($Item_Luck);
            $this->Item_OpExc_1     = strtolower($Item_OpExc_1);
            $this->Item_OpExc_2     = strtolower($Item_OpExc_2);
            $this->Item_OpExc_3     = strtolower($Item_OpExc_3);
            $this->Item_OpExc_4     = strtolower($Item_OpExc_4);
            $this->Item_OpExc_5     = strtolower($Item_OpExc_5);  
            $this->Item_OpExc_6     = strtolower($Item_OpExc_6);
            $this->Item_JH          = (strlen($Item_JH) != 2 || ($Item_JH < 0) ? "00" : $Item_JH);
            $this->Item_Refine      = strtolower($Item_Refine);
            $this->Item_Socket_Slot_1   = strtolower($Item_Socket_Slot_1);
            $this->Item_Socket_Slot_2   = strtolower($Item_Socket_Slot_2);
            $this->Item_Socket_Slot_3   = strtolower($Item_Socket_Slot_3);
            $this->Item_Socket_Slot_4   = strtolower($Item_Socket_Slot_4);
            $this->Item_Socket_Slot_5   = strtolower($Item_Socket_Slot_5);
            $this->Item_Socket_Slot_1_Option   = $Item_Socket_Slot_1_Option;
            $this->Item_Socket_Slot_2_Option   = $Item_Socket_Slot_2_Option;
            $this->Item_Socket_Slot_3_Option   = $Item_Socket_Slot_3_Option;
            $this->Item_Socket_Slot_4_Option   = $Item_Socket_Slot_4_Option;
            $this->Item_Socket_Slot_5_Option   = $Item_Socket_Slot_5_Option;
            $this->Find_Details();
            if($this->buyKit == false)
            {
                $tempOptExcCheck = 0;
                if($this->Item_OpExc_1 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_2 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_3 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_4 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_5 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_6 == 'true') $tempOptExcCheck++;  
                if($tempOptExcCheck > $this->maxOptExcSel) exit(Print_error("<ul><li>Desculpe, op&ccedil;&otilde;es excelentes a mais que o permitido.</li></ul>")); 
            
                $this->Calc_Price();
                $this->Check_Golds_Amount();
            }
            
            $LD_Items->Write_Variables($this->ProductID, $this->TP, $this->ID, $LD_Items->GetSerial(), $this->DUR, $this->X, $this->Y, $this->Item_Level, $this->Item_Option, $this->Item_Ancient, $this->Item_Skill, $this->Item_Luck, $this->Item_OpExc_1, $this->Item_OpExc_2, $this->Item_OpExc_3, $this->Item_OpExc_4, $this->Item_OpExc_5, $this->Item_OpExc_6, $this->Item_JH, $this->Item_Refine, $this->Item_Socket_Slot_1, $this->Item_Socket_Slot_2, $this->Item_Socket_Slot_3, $this->Item_Socket_Slot_4, $this->Item_Socket_Slot_5, $this->Item_Socket_Slot_1_Option, $this->Item_Socket_Slot_2_Option, $this->Item_Socket_Slot_3_Option, $this->Item_Socket_Slot_4_Option, $this->Item_Socket_Slot_5_Option);
            $LD_Items->GenerateHex(); //var_dump($LD_Items->Hex_ItemBuy);
            $LD_Items->GetVaultContent();
            $LD_Items->CutSlotsVault();
            $LD_Items->CutHexSlotsVault();
            $LD_Items->RestructureSlotsFree();
            //$LD_Items->DrawVaultOLD();
            if($LD_Items->FindSlotsFree($this->buyKit) == false) { $this->delivered = false; $this->WriteLog(); return false; }
            if($this->buyKit == false) $this->ChargeGold();
            $this->WriteLog();
            $LD_Items->WriteVault();
            if($this->buyKit == false) print("<ul><li>Sua compra foi efetuada com sucesso! Obrigado.</li></ul>");
            $this->delivered = true;
        }
        private function Find_Details()
        {
            global $ODBC;
            $ODBC_Q = $ODBC->query("SELECT NAME, ID, CATEGORIA, TP, X, Y, DUR, LVL, RF, JH, Socket, ANC, SetItem1, SetItem2, price, priceLevel, priceOption, priceSkill, priceLuck, priceAncient, priceOptExc, priceJh, priceRefine, priceSocket, insertShop, maxOptExcSel FROM Items WHERE Number='".$this->ProductID."'");
            $ODBC_R = odbc_fetch_object($ODBC_Q);
            require("modules/sockets.lib.php");
            if($ODBC_R->Socket == 0 && 
            (
                $socketLib["notSocket"] != $this->Item_Socket_Slot_1_Option ||
                $socketLib["notSocket"] != $this->Item_Socket_Slot_2_Option ||
                $socketLib["notSocket"] != $this->Item_Socket_Slot_3_Option ||
                $socketLib["notSocket"] != $this->Item_Socket_Slot_4_Option ||
                $socketLib["notSocket"] != $this->Item_Socket_Slot_5_Option
            )) exit(Print_error("<ul><li>Desculpe, esse item n&atilde;o suporta socket.</li></ul>"));
            
            if($this->Item_Level > constant("LOCK_MAX_LEVEL"))
            {
                exit(Print_error("<ul><li>Desculpe, o level m&aacute;ximo permitido por item &eacute; ".constant("LOCK_MAX_LEVEL").".</li></ul>")); 
            } 
            if(($ODBC_R->LVL != "NO" && $ODBC_R->LVL != "SN") && $ODBC_R->LVL != $this->Item_Level)
            {
                exit(Print_error("<ul><li>Desculpe, o level permitido para esse item &eacute; ".$ODBC_R->LVL.".</li></ul>")); 
            } 
            
            if(LOCK_REPEAT_SOCKET == true) 
            {
                $tmpSockCheck = array();
                if($this->Item_Socket_Slot_1 == "true" && $this->Item_Socket_Slot_1_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_1_Option != $socketLib['emptySocket']) { $tmpSockCheck[] = $this->Item_Socket_Slot_1_Option; }
                if($this->Item_Socket_Slot_2 == "true" && $this->Item_Socket_Slot_2_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_2_Option != $socketLib['emptySocket']) { $tmpSockCheck[] = $this->Item_Socket_Slot_2_Option; }
                if($this->Item_Socket_Slot_3 == "true" && $this->Item_Socket_Slot_3_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_3_Option != $socketLib['emptySocket']) { $tmpSockCheck[] = $this->Item_Socket_Slot_3_Option; }
                if($this->Item_Socket_Slot_4 == "true" && $this->Item_Socket_Slot_4_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_4_Option != $socketLib['emptySocket']) { $tmpSockCheck[] = $this->Item_Socket_Slot_4_Option; }
                if($this->Item_Socket_Slot_5 == "true" && $this->Item_Socket_Slot_5_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_5_Option != $socketLib['emptySocket']) { $tmpSockCheck[] = $this->Item_Socket_Slot_5_Option; }
            
                $newCheck = array_unique($tmpSockCheck);    
                if(sizeof($newCheck) != sizeof($tmpSockCheck)) exit(Print_error("<ul><li>Desculpe, n&atilde;o &eacute; permitida a repeti&ccedil;&atilde;o de op&ccedil;&otilde;es socket.</li></ul>")); 
            }
            
            if(LOCK_REPEAT_CATEGORIE_SOCKET == true)
            {
                $checkRepeatSocketType['Fire'] = 0;
                $checkRepeatSocketType['Water'] = 0;
                $checkRepeatSocketType['Ice'] = 0;
                $checkRepeatSocketType['Wind'] = 0;
                $checkRepeatSocketType['Lightning'] = 0;
                $checkRepeatSocketType['Ground'] = 0;

                for($i = 1; $i < 6; $i++)
                {     
                    if($i == 1)                                                                                                                                         
                        if($this->Item_Socket_Slot_1_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_1_Option == $socketLib['emptySocket']) continue;
                    if($i == 2)                                                                                                                                         
                        if($this->Item_Socket_Slot_2_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_2_Option == $socketLib['emptySocket']) continue;
                    if($i == 3)                                                                                                                                         
                        if($this->Item_Socket_Slot_3_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_3_Option == $socketLib['emptySocket']) continue;
                    if($i == 4)                                                                                                                                         
                        if($this->Item_Socket_Slot_4_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_4_Option == $socketLib['emptySocket']) continue;
                    if($i == 5)                                                                                                                                         
                        if($this->Item_Socket_Slot_5_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_5_Option == $socketLib['emptySocket']) continue;


                    eval("\$socketId = \$this->Item_Socket_Slot_".$i."_Option % 50;");
                    if(SOCKET_USE_LIB == 1) $socketId -= 1; //Sistema da SCF / SCFMT (MuMaker) precisa de -1 no numero
                    if($socketId >= 0 && $socketId <= 9)
                        $checkRepeatSocketType['Fire'] += 1;
                    elseif($socketId >= 10 && $socketId <= 15)
                        $checkRepeatSocketType['Water'] += 1;
                    elseif($socketId >= 16 && $socketId <= 20)
                        $checkRepeatSocketType['Ice'] += 1;
                    elseif($socketId >= 21 && $socketId <= 28)
                        $checkRepeatSocketType['Wind'] += 1;
                    elseif($socketId >= 29 && $socketId <= 35)
                        $checkRepeatSocketType['Lightning'] += 1;
                    elseif($socketId >= 36 && $socketId <= 46) //Até 46 por garantia
                        $checkRepeatSocketType['Ground'] += 1;
                }  
                foreach($checkRepeatSocketType as $checkTmp)
                    if($checkTmp > 1)
                        exit(Print_error("<ul><li>Desculpe, n&atilde;o &eacute; permitida a repeti&ccedil;&atilde;o das categorias das op&ccedil;&otilde;es sockets.</li></ul>"));  
            }
            
            /*
            Sets & Shields = Water, Wind, Earth
            Armas = Fire, Ice, Lightning
            */
            if($ODBC_R->Socket == 1)
            {
            
                switch($ODBC_R->CATEGORIA)
                {   //None: -1, Fire: 1, Water: 2, Ice: 3, Wind: 4, Lightning: 5, Ground/Earth: 6          
                    case "Armors": 
                        $typesSockets = array(2, 4, 6); 
                        break;  
                    case "Axes":                         
                        $typesSockets = array(1, 3, 5);
                        break;  
                    case "Boots":                                       
                        $typesSockets = array(2, 4, 6); 
                        break;  
                    case "Bows":                          
                        $typesSockets = array(1, 3, 5);
                        break;   
                    case "CrossBows":                       
                        $typesSockets = array(1, 3, 5);
                        break;
                    case "Gloves":                                        
                        $typesSockets = array(2, 4, 6); 
                        break;   
                    case "Helms":                                      
                        $typesSockets = array(2, 4, 6); 
                        break;      
                    case "Maces":                         
                        $typesSockets = array(1, 3, 5);
                        break;   
                    case "Pants":                                       
                        $typesSockets = array(2, 4, 6); 
                        break;  
                    case "Scepters":                       
                        $typesSockets = array(1, 3, 5);
                        break;  
                    case "Shields":                                  
                        $typesSockets = array(2, 4, 6); 
                        break;    
                    case "Spears":                         
                        $typesSockets = array(1, 3, 5);
                        break;    
                    case "Staffs":                        
                        $typesSockets = array(1, 3, 5);
                        break;    
                    case "Swords":                       
                        $typesSockets = array(1, 3, 5);
                        break;  
                    default:
                        $typesSockets = null;                       
                }
                $ignoreCheck = 0;
                for($iSocketCheck = 1; $iSocketCheck < 6; $iSocketCheck++)
                {
                    if($iSocketCheck == 1)                                                                                                                                         
                        if($this->Item_Socket_Slot_1_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_1_Option == $socketLib['emptySocket']) { $ignoreCheck++; continue; }
                    if($iSocketCheck == 2)                                                                                                                                         
                        if($this->Item_Socket_Slot_2_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_2_Option == $socketLib['emptySocket']) { $ignoreCheck++; continue; }
                    if($iSocketCheck == 3)                                                                                                                                         
                        if($this->Item_Socket_Slot_3_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_3_Option == $socketLib['emptySocket']) { $ignoreCheck++; continue; }
                    if($iSocketCheck == 4)                                                                                                                                         
                        if($this->Item_Socket_Slot_4_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_4_Option == $socketLib['emptySocket']) { $ignoreCheck++; continue; }
                    if($iSocketCheck == 5)                                                                                                                                         
                        if($this->Item_Socket_Slot_5_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_5_Option == $socketLib['emptySocket']) { $ignoreCheck++; continue; }
                        
                    if($typesSockets == null)
                        exit(Print_error("<ul><li>Desculpe, a categoria desse item n&atilde;o suporta socket.</li></ul>"));
                    
                    eval("\$socketId = \$this->Item_Socket_Slot_".$iSocketCheck."_Option % 50;");
                    
                    if(isset($socketLib["socketTypeNumber"][$typesSockets[0]][$socketId]) == false && isset($socketLib["socketTypeNumber"][$typesSockets[1]][$socketId]) == false && isset($socketLib["socketTypeNumber"][$typesSockets[2]][$socketId]) == false) {
                        exit("<ul><li>Desculpe, a categoria desse item n&atilde;o suporta o socket selecionado.</li></ul>");
                    }
                }
                
            } 
            
            if(LOCK_REPEAT_SLOT_SOCKET == true)
            {              
                $checkTmp = 0; 
                if($this->Item_Socket_Slot_1_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_1_Option != $socketLib['emptySocket'])
                {   
                    if($this->Item_Socket_Slot_1_Option < 0 || $this->Item_Socket_Slot_1_Option > 49) $checkTmp = 1; 
                }
                if($this->Item_Socket_Slot_2_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_2_Option != $socketLib['emptySocket'])
                {     
                    if($this->Item_Socket_Slot_2_Option < 50 || $this->Item_Socket_Slot_2_Option > 99) $checkTmp = 1; 
                }
                if($this->Item_Socket_Slot_3_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_3_Option != $socketLib['emptySocket'])
                {      
                    if($this->Item_Socket_Slot_3_Option < 100 || $this->Item_Socket_Slot_3_Option > 149) $checkTmp = 1; 
                }
                if($this->Item_Socket_Slot_4_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_4_Option != $socketLib['emptySocket'])
                {       
                    if($this->Item_Socket_Slot_4_Option < 150 || $this->Item_Socket_Slot_4_Option > 199) $checkTmp = 1; 
                }
                if($this->Item_Socket_Slot_5_Option != $socketLib['notSocket'] && $this->Item_Socket_Slot_5_Option != $socketLib['emptySocket'])
                {       
                    if($this->Item_Socket_Slot_5_Option < 200 || $this->Item_Socket_Slot_5_Option > 249) $checkTmp = 1; 
                }     

                if($checkTmp == 1)
                    exit(Print_error("<ul><li>Desculpe, alguma op&ccedil;&atilde;o socket selecionada n&atilde;o faz parte do slot em qual foi colocada.</li></ul>"));  
            }
            
            if(LOCK_REPEAT_SOCKET_TYPE == true)
            {
                $checkRepeatSocketType = array(); 
                
                for($i = 1; $i < 6; $i++)
                {     
                    if($i == 1)                                                                                                                                         
                        if($this->Item_Socket_Slot_1_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_1_Option == $socketLib['emptySocket']) continue;
                    if($i == 2)                                                                                                                                         
                        if($this->Item_Socket_Slot_2_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_2_Option == $socketLib['emptySocket']) continue;
                    if($i == 3)                                                                                                                                         
                        if($this->Item_Socket_Slot_3_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_3_Option == $socketLib['emptySocket']) continue;
                    if($i == 4)                                                                                                                                         
                        if($this->Item_Socket_Slot_4_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_4_Option == $socketLib['emptySocket']) continue;
                    if($i == 5)                                                                                                                                         
                        if($this->Item_Socket_Slot_5_Option == $socketLib['notSocket'] || $this->Item_Socket_Slot_5_Option == $socketLib['emptySocket']) continue;

                    eval("\$checkRepeatSocketType[] = \$this->Item_Socket_Slot_".$i."_Option % 50;");
                }
                $newCheck = array_unique($checkRepeatSocketType);    
                if(sizeof($newCheck) != sizeof($checkRepeatSocketType)) exit(Print_error("<ul><li>Desculpe, n&atilde;o &eacute; permitida a repeti&ccedil;&atilde;o de op&ccedil;&otilde;es sockets do mesmo tipo.</li></ul>"));  
            }
            
            if(LOCK_ANCIENT_AND_EXCELLENT == true)
            {
                $tempOptExcCheck = 0;
                if($this->Item_OpExc_1 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_2 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_3 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_4 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_5 == 'true') $tempOptExcCheck++;
                if($this->Item_OpExc_6 == 'true') $tempOptExcCheck++;  
                if($tempOptExcCheck > 0 && $this->Item_Ancient > 0) exit(Print_error("<ul><li>Desculpe, op&ccedil;&otilde;es excelentes n&atilde;o s&atilde;o permitidas com ancient.</li></ul>")); 
            }
            
            if(LOCK_SOCKET_AND_HARMONY == true)
            {
                if(($this->Item_Socket_Slot_1 == "true" || $this->Item_Socket_Slot_2 == "true" || $this->Item_Socket_Slot_3 == "true" || $this->Item_Socket_Slot_4 == "true" || $this->Item_Socket_Slot_5 == "true") && $this->Item_JH != "00")
                    exit(Print_error("<ul><li>Desculpe, op&ccedil;&otilde;es sockets n&atilde;o s&atilde;o permitidas com harmony.</li></ul>")); 
            }
            
            if($ODBC_R->ANC == 0 && $this->Item_Ancient > 0) exit(Print_error("<ul><li>Desculpe, esse item n&atilde;o suporta ancient.</li></ul>"));
            switch($this->Item_Ancient) 
            {
                case 1:
                    if($ODBC_R->SetItem1 == "NO") exit(Print_error("<ul><li>Desculpe, esse item n&atilde;o suporta o ancient selecionado.</li></ul>"));
                break;
                case 2:
                    if($ODBC_R->SetItem2 == "NO") exit(Print_error("<ul><li>Desculpe, esse item n&atilde;o suporta o ancient selecionado.</li></ul>"));
                break;
            }
            if($ODBC_R->JH == 0 && $this->Item_JH != 0) exit(Print_error("<ul><li>Desculpe, esse item n&atilde;o suporta harmony.</li></ul>")); 
            if($ODBC_R->RF == 0 && $this->Item_Refine != "false") exit(Print_error("<ul><li>Desculpe, esse item n&atilde;o suporta refine.</li></ul>")); 
            if((int)$ODBC_R->insertShop == 0) exit(Print_error("<ul><li>Desculpe, esse produto n&atilde;o foi cadastrado em nosso shopping.</li></ul>")); 
            $this->NAME = $ODBC_R->NAME;
            $this->ID = $ODBC_R->ID;
            $this->TP = $ODBC_R->TP;        
            $this->X = $ODBC_R->X;
            $this->Y = $ODBC_R->Y;
            $this->DUR = $ODBC_R->DUR;
            $this->LVL = $ODBC_R->LVL;
            $this->RF = $ODBC_R->RF;
            $this->JH = $ODBC_R->JH;
            $this->Price = $ODBC_R->price;
            $this->Price_Level = $ODBC_R->priceLevel;
            $this->Price_Adicional = $ODBC_R->priceOption;
            $this->Price_Skill = $ODBC_R->priceSkill;
            $this->Price_Luck = $ODBC_R->priceLuck;
            $this->Price_Ancient = $ODBC_R->priceAncient;  
            $this->Price_OpExc = $ODBC_R->priceOptExc;        
            $this->Price_JH = $ODBC_R->priceJh;           
            $this->Price_Refine = $ODBC_R->priceRefine;  
            $this->Price_Socket = $ODBC_R->priceSocket;            
            $this->maxOptExcSel = $ODBC_R->maxOptExcSel;            
        }
        private function Calc_Price()
        {
            $this->End_Price = 0;
            $this->End_Price += $this->Price;
            $this->End_Price += ($this->Item_Level * $this->Price_Level);
            $this->End_Price += ($this->Item_Option * $this->Price_Adicional);
            $this->End_Price += ($this->Item_Ancient * $this->Price_Ancient);
            $this->End_Price += ($this->Item_Skill == "true" ? $this->Price_Skill : 0);
            $this->End_Price += ($this->Item_Luck == "true" ? $this->Price_Luck : 0);
            $this->End_Price += ($this->Item_OpExc_1 == "true" ? $this->Price_OpExc : 0);
            $this->End_Price += ($this->Item_OpExc_2 == "true" ? $this->Price_OpExc : 0);
            $this->End_Price += ($this->Item_OpExc_3 == "true" ? $this->Price_OpExc : 0);
            $this->End_Price += ($this->Item_OpExc_4 == "true" ? $this->Price_OpExc : 0);
            $this->End_Price += ($this->Item_OpExc_5 == "true" ? $this->Price_OpExc : 0);     
            $this->End_Price += ($this->Item_OpExc_6 == "true" ? $this->Price_OpExc : 0);   
            $this->End_Price += ($this->Item_JH != "00" ? $this->Price_JH : 0);                    
            $this->End_Price += ($this->Item_Refine == "true" ? $this->Price_Refine : 0);        
            $this->End_Price += ($this->Item_Socket_Slot_1 == "true" ? $this->Price_Socket : 0); 
            $this->End_Price += ($this->Item_Socket_Slot_2 == "true" ? $this->Price_Socket : 0); 
            $this->End_Price += ($this->Item_Socket_Slot_3 == "true" ? $this->Price_Socket : 0); 
            $this->End_Price += ($this->Item_Socket_Slot_4 == "true" ? $this->Price_Socket : 0); 
            $this->End_Price += ($this->Item_Socket_Slot_5 == "true" ? $this->Price_Socket : 0);  
            if($_SESSION['COUPON_ACTIVE'] == true) $this->End_Price = ceil((( $this->End_Price / 100 ) * (100 - $_SESSION['COUPON_PERCENT'])));
        }
        private function Check_Golds_Amount()
        {
            $SQL_Q = $this->query("SELECT ".GOLDCOLUMN." FROM ".GOLDTABLE." WHERE ".GOLDMEMBIDENT." = '". $_SESSION['Login'] ."'");
            $SQL = mssql_fetch_row($SQL_Q);
            if($SQL[0] < $this->End_Price) exit(Print_error("<ul><li>Desculpe, essa compra n&atilde;o pode ser realizada, pois seu saldo de ".GOLDNAME." &eacute; insuficiente.</li></ul>"));
        }
        private function ChargeGold()
        {
            $SQL_Q = $this->query("UPDATE ".GOLDTABLE." SET ".GOLDCOLUMN." = ".GOLDCOLUMN."-".$this->End_Price." WHERE ".GOLDMEMBIDENT." = '". $_SESSION['Login'] ."' AND ".GOLDCOLUMN." >= ".$this->End_Price."; select @@rowcount as rows;");
            $SQL_R = mssql_fetch_object($SQL_Q);
            if((int)$SQL_R->rows == 0) exit(Print_error("<ul><li>Erro ao cobrar pelo item.</li></ul>"));
        }
        private function WriteLog()
        {
            global $LD_Items;
            $ODBC = new LD_ODBC();
            if($this->buyKit == false) $ODBC->query("UPDATE Items SET solds=solds+1 WHERE Number='".$this->ProductID."'");
            $ODBC->query("INSERT INTO LogSolds (`login`, `itemNumber`, `serial`, `level`, `option`, `luck`, `skill`, `ancient`, `excop1`, `excop2`, `excop3`, `excop4`, `excop5`, `excop6`, `jh`, `refine`, `socket1`, `socket2`, `socket3`, `socket4`, `socket5`, `socket1_int`, `socket2_int`, `socket3_int`, `socket4_int`, `socket5_int`, `price`, `data`, `recovery`, `type`) VALUES 
                                                          ('".$_SESSION['Login']."','".$this->ProductID."','".$LD_Items->Item_Serial."','".$this->Item_Level."','".$this->Item_Option."','".$this->Item_Luck."','".$this->Item_Skill."','".$this->Item_Ancient."','".$this->Item_OpExc_1."','".$this->Item_OpExc_2."','".$this->Item_OpExc_3."','".$this->Item_OpExc_4."','".$this->Item_OpExc_5."','".$this->Item_OpExc_6."','".$this->Item_JH."','".$this->Item_Refine."','".$this->Item_Socket_Slot_1."','".$this->Item_Socket_Slot_2."','".$this->Item_Socket_Slot_3."','".$this->Item_Socket_Slot_4."','".$this->Item_Socket_Slot_5."','".$this->Item_Socket_Slot_1_Option."','".$this->Item_Socket_Slot_2_Option."','".$this->Item_Socket_Slot_3_Option."','".$this->Item_Socket_Slot_4_Option."','".$this->Item_Socket_Slot_5_Option."','".(int)$this->End_Price."','".time()."','0','". ($this->buyKit == false ? "common":"kit") ."')");
            if($this->buyKit == false) print "<ul><li>Gravando Log.</li></ul>";            
        }
    }
}


?>
