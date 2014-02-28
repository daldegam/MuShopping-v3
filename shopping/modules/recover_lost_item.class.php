<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Recover_Lost_Item" ) == false ) {
	class LD_Recover_Lost_Item extends LD_Mssql {
    public $BuyID, $ProductID, $ProductSerial, $Item_Level, $Item_Option, $Item_Ancient, $Item_Skill, $Item_Luck, $Item_OpExc_1, $Item_OpExc_2, $Item_OpExc_3, $Item_OpExc_4, $Item_OpExc_5, $Item_OpExc_6, $Item_JH;	
		public function __construct($BuyID, $searchItem = false)
		{                    
			global $LD_Items;
			$this->searchItem = $searchItem;
			$SQL_Q = $this->query("SELECT ConnectStat, DATEDIFF(MI, DisConnectTM, getdate()) DisConnectTM FROM MEMB_STAT WHERE memb___id='". $_SESSION['Login'] ."'");
            if(mssql_num_rows($SQL_Q) == 0) exit(Print_error("<ul><li>Voc&ecirc; deve entrar no jogo ao menos uma vez para efetuar essa a&ccedil;&atilde;o!</li></ul>"));   
			$SQL = mssql_fetch_object($SQL_Q);                                                                                                               
            if($SQL->ConnectStat <> 0) exit(Print_error("<ul><li>Voc&ecirc; deve estar offline do jogo para efetuar essa a&ccedil;&atilde;o!</li></ul>"));
            if($SQL->DisConnectTM < (int)constant("RECOVERY_LIMIT_MIN_TIME")) exit(Print_error("<ul><li>Voc&ecirc; deve estar aguardar ". (int)constant("RECOVERY_LIMIT_MIN_TIME") ." minutos ap&oacute;s sair do jogo para efetuar essa a&ccedil;&atilde;o!</li></ul>"));
			                
			$this->BuyID = $BuyID;
			$this->VerifyBuy();
			$this->FindItem();  
            if($this->searchItem == true) exit();
            if((int)RECOVERY_LIMIT_ITEM > 0 && $this->recovery >= (int)RECOVERY_LIMIT_ITEM)
            {
                exit(Print_error("<ul><li>Erro, excedido o n&uacute;mero de vezes que o item ser recuperado (".RECOVERY_LIMIT_ITEM." vezes).</li></ul>"));
            }
            $this->Find_Details();
            $LD_Items->Write_Variables($this->ProductID, $this->TP, $this->ID, $this->ProductSerial, $this->DUR, $this->X, $this->Y, $this->Item_Level, $this->Item_Option, $this->Item_Ancient, $this->Item_Skill, $this->Item_Luck, $this->Item_OpExc_1, $this->Item_OpExc_2, $this->Item_OpExc_3, $this->Item_OpExc_4, $this->Item_OpExc_5, $this->Item_OpExc_6, $this->Item_JH, $this->Item_Refine, $this->Item_Socket_Slot_1, $this->Item_Socket_Slot_2, $this->Item_Socket_Slot_3, $this->Item_Socket_Slot_4, $this->Item_Socket_Slot_5, $this->Item_Socket_Slot_1_Option, $this->Item_Socket_Slot_2_Option, $this->Item_Socket_Slot_3_Option, $this->Item_Socket_Slot_4_Option, $this->Item_Socket_Slot_5_Option);
             
            $LD_Items->GenerateHex();
			$LD_Items->GetVaultContent();
			$LD_Items->CutSlotsVault();
			$LD_Items->CutHexSlotsVault();
			$LD_Items->RestructureSlotsFree();        
			$LD_Items->FindSlotsFree();    
			$this->WriteLog();
			$LD_Items->WriteVault();
			print("<ul><li>Seu item foi recuperado com sucesso! Obrigado.</li></ul>");
		}
		public function VerifyBuy()
		{
            global $ODBC;
			$ODBC_Q = $ODBC->query("SELECT * FROM LogSolds WHERE number=". (int)$this->BuyID ." AND login = '". $_SESSION['Login'] ."'"); 
			$ODBC_R = odbc_fetch_object($ODBC_Q);
            if($ODBC_R->login != $_SESSION['Login']) exit(Print_error("<ul><li>Erro, essa compra n&atilde;o foi efetuada pelo seu login.</li></ul>"));
			$this->ProductID 		= $ODBC_R->itemNumber;
			$this->ProductSerial	= $ODBC_R->serial;
			$this->Item_Level 		= $ODBC_R->level;
			$this->Item_Option 		= $ODBC_R->option;
			$this->Item_Ancient 	= $ODBC_R->ancient;
			$this->Item_Skill 		= $ODBC_R->skill;
			$this->Item_Luck 		= $ODBC_R->luck;
			$this->Item_OpExc_1 	= $ODBC_R->excop1;
			$this->Item_OpExc_2 	= $ODBC_R->excop2;
			$this->Item_OpExc_3 	= $ODBC_R->excop3;
			$this->Item_OpExc_4 	= $ODBC_R->excop4;
			$this->Item_OpExc_5 	= $ODBC_R->excop5; 
            $this->Item_OpExc_6     = $ODBC_R->excop6;    
            $this->Item_JH          = $ODBC_R->jh;  
            $this->Item_Refine      = $ODBC_R->refine; 
            $this->Item_Socket_Slot_1   = $ODBC_R->socket1;
            $this->Item_Socket_Slot_2   = $ODBC_R->socket2;
            $this->Item_Socket_Slot_3   = $ODBC_R->socket3;
            $this->Item_Socket_Slot_4   = $ODBC_R->socket4;
            $this->Item_Socket_Slot_5   = $ODBC_R->socket5;
            $this->Item_Socket_Slot_1_Option   = $ODBC_R->socket1_int;
            $this->Item_Socket_Slot_2_Option   = $ODBC_R->socket2_int;
            $this->Item_Socket_Slot_3_Option   = $ODBC_R->socket3_int;
            $this->Item_Socket_Slot_4_Option   = $ODBC_R->socket4_int;  
            $this->Item_Socket_Slot_5_Option   = $ODBC_R->socket5_int; 
            $this->recovery   = $ODBC_R->recovery; 
		} 
        private function Find_Details()
        {
            global $ODBC;
            $ODBC_Q = $ODBC->query("SELECT ID, TP, X, Y, DUR, CATEGORIA FROM Items WHERE Number='".$this->ProductID."'");
            $ODBC_R = odbc_fetch_object($ODBC_Q);
            $this->ID = $ODBC_R->ID;
            $this->TP = $ODBC_R->TP;         
            $this->X = $ODBC_R->X;
            $this->Y = $ODBC_R->Y;
            $this->DUR = $ODBC_R->DUR;
           
            $this->categoriasBlockeds = array("Amulets","Castel Siege","Events","Events MIX","Gifts/Boxs","Jewels","Jewels MIX","Mix Items","Mix Pets","Orbs","Quests","Scrolls");
            if(in_array($ODBC_R->CATEGORIA, $this->categoriasBlockeds) == true)
                exit("<ul><li>Erro, esse tipo de item n&atilde;o pode ser recuperado no shopping.</li></ul>");
        }
		public function FindItem() 
		{
            $resultQ = mssql_query("select [Name] from [Character] where (charindex (0x".$this->ProductSerial.", Inventory) %". DIVISOR/2 ."=4)"); 
            while($result = mssql_fetch_object($resultQ))
            {
                 echo Print_error("<ul><li>Item foi encontrado no invent&aacute;rio do char: ". $result->Name .".</li></ul>");   
                 $exitFunction = true;
            }
            unset($result, $resultQ);
            
            $findColumnsQ = mssql_query("sp_MShelpcolumns N'dbo.warehouse', null, 'id', 1"); //SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'warehouse'
            while($findColumns = mssql_fetch_object($findColumnsQ))
            {
                if($findColumns->col_typename == "varbinary")
                {
                    $resultQ = mssql_query("select [AccountId] from [warehouse] where (charindex (0x".$this->ProductSerial.", ".$findColumns->col_name.") %". DIVISOR/2 ."=4)"); 
                    while($result = mssql_fetch_object($resultQ))
                    {
                         echo Print_error("<ul><li>Item foi encontrado no bau do login: ". $result->AccountId .".<!-- Column: {$findColumns->col_name} --></li></ul>");
                         $exitFunction = true; 
                    }   
                }   
            }
            
            $resultQ = @mssql_query("select [AccountId],[Number] from [ExtWarehouse] where (charindex (0x".$this->ProductSerial.", Items) %". DIVISOR/2 ."=4)"); 
            while($result = @mssql_fetch_object($resultQ))
            {
                 echo Print_error("<ul><li>Item foi encontrado no bau extra ". $result->Number ." do login: ". $result->AccountId .".</li></ul>");
                 $exitFunction = true;   
            }
            
            $resultQ = @mssql_query("select [AccountId],[Number] from [ExtendedWarehouse] where (charindex (0x".$this->ProductSerial.", Items) %". DIVISOR/2 ."=4)"); 
            while($result = @mssql_fetch_object($resultQ))
            {
                 echo Print_error("<ul><li>Item foi encontrado no bau extra ". $result->Number ." do login: ". $result->AccountId .".</li></ul>");
                 $exitFunction = true;   
            }
            
            $resultQ = @mssql_query("select [AccountId] from [ExtWarehouseVirtual] where (charindex (0x".$this->ProductSerial.", Item) %". DIVISOR/2 ."=4)"); 
            while($result = @mssql_fetch_object($resultQ))
            {
                 echo Print_error("<ul><li>Item foi encontrado no bau virtual do login: ". $result->AccountId .".</li></ul>");
                 $exitFunction = true;   
            }
            unset($result, $resultQ);             
                              
            if($exitFunction === true && $this->searchItem === true) 
                exit();
            elseif($exitFunction === true)
                exit(Print_error("<ul><li>Erro, o item ainda existe algum local no servidor, a recupera&ccedil;&atilde;o n&atilde;o pode continuar.</li></ul>"));
            else echo "<ul><li>Esse item n&atilde;o foi encontrado no servidor.</li></ul>"; 
		}
		public function WriteLog()
		{
            global $ODBC;
			$ODBC->query("UPDATE LogSolds SET recovery = recovery + 1 WHERE number = ". (int) $this->BuyID);
		}
	}
}


?>
