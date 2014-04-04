<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Vault" ) == false ) {
	class LD_Vault extends LD_Mssql{
		public $Vault_Content, $Place_Avaliable = NULL, $Vault_End_Process, $Vault_Photo, $Photo_Item, $Photo_Item_Name;
		public $Vault_Slots = array();
        public $Varbinary = null;
        public $LineCounts = null;
        public $SlotCounts = null;
		public function __construct() 
		{ 
			//construct n�o disponivel pois est� como extends
		}
		public function GetVaultContent()
		{ 
            $getLenghts = $this->query("SELECT [length] FROM [syscolumns] WHERE OBJECT_NAME([id]) = 'warehouse' AND [name] = 'Items';");
            $getLenghts = mssql_fetch_object($getLenghts);
            $this->Varbinary = $getLenghts->length;
            $this->LineCounts = (($getLenghts->length * 2) / (constant("SYSTEM_DBVERSION") == 1 ? 20 : 32)) / 8;
            $this->SlotCounts = (($getLenghts->length * 2) / (constant("SYSTEM_DBVERSION") == 1 ? 20 : 32));
            
			$SQL_Q = $this->query("SELECT 1 FROM warehouse WHERE Accountid='". $_SESSION['Login'] ."'");
			if(mssql_num_rows($SQL_Q) == 0) $this->query("INSERT INTO warehouse (AccountID, Items, Money, EndUseDate, DbVersion, pw) VALUES ('". $_SESSION['Login'] ."', 0x".str_pad( "", $this->Varbinary*2, "F" ).", 0, GetDate(), ".constant("SYSTEM_DBVERSION").", 0);");
			$SQL_Q = $this->query("DECLARE @vault varbinary(". $this->Varbinary ."); SELECT @vault = items FROM warehouse WHERE AccountID='".$_SESSION['Login']."' " . (constant("ENCGAMES_S6") === true ? " AND VaultID = 1" : NULL) . "; PRINT @vault;");
			$this->Vault_Content = substr(mssql_get_last_message($SQL_Q),2);
		}
		public function CutSlotsVault()
		{
			$i = (int) 0;
			for($Line = 0; $Line < $this->LineCounts; $Line++)
			{
				for($Column = 0; $Column < 8; $Column++)
				{	
					$this->Vault_Slots[$i/DIVISOR]['Hex'] = substr($this->Vault_Content, $i, DIVISOR);
					$this->Vault_Slots[$i/DIVISOR]['Line'] = $Line;
					$this->Vault_Slots[$i/DIVISOR]['Column'] = $Column;
					$i += DIVISOR;
				}
			}
		}
        
        public function ReverseBits($b)
        {
            switch(strtoupper(substr($b, 0, 1)))
            {
                case "0": return "0000"; 
                case "1": return "0001"; 
                case "2": return "0010";    
                case "3": return "0011"; 
                case "4": return "0100"; 
                case "5": return "0101"; 
                case "6": return "0110"; 
                case "7": return "0111"; 
                case "8": return "1000"; 
                case "9": return "1001"; 
                case "A": return "1010"; 
                case "B": return "1011"; 
                case "C": return "1100";
                case "D": return "1101";
                case "E": return "1110";
                case "F": return "1111";
            }
        }
        
        public function Bit3Reverse($bits)
        {
            switch($bits)
            {
                Case "000": return 0;
                Case "001": return 1;
                Case "010": return 2;
                Case "011": return 3;
                Case "100": return 4; 
                Case "101": return 5; 
                Case "110": return 6; 
                Case "111": return 7; 
                Case "000": return 8; 
                Case "001": return 9; 
                Case "010": return 10; 
                Case "011": return 11; 
                Case "100": return 12; 
                Case "101": return 13; 
                Case "110": return 14; 
                Case "111": return 15; 
                Case "000": return 16; 
                Case "001": return 17; 
                Case "010": return 18; 
                Case "011": return 19; 
                Case "100": return 20; 
                Case "101": return 21; 
                Case "110": return 22; 
                Case "111": return 23; 
                Case "000": return 24; 
                Case "001": return 25; 
                Case "010": return 26; 
                Case "011": return 27; 
                Case "100": return 28; 
                Case "101": return 29; 
                Case "110": return 30; 
            }
        }
        
        public function Bit5Reverse($bits)
        {
            switch($bits)
            {
                Case "00000": return 0;
                Case "00001": return 1;
                Case "00010": return 2;
                Case "00011": return 3;
                Case "00100": return 4;
                Case "00101": return 5;
                Case "00110": return 6;
                Case "00111": return 7;
                Case "01000": return 8;
                Case "01001": return 9;
                Case "01010": return 10;
                Case "01011": return 11;
                Case "01100": return 12;
                Case "01101": return 13;
                Case "01110": return 14;
                Case "01111": return 15;
                Case "10000": return 16;
                Case "10001": return 17;
                Case "10010": return 18;
                Case "10011": return 19;
                Case "10100": return 20;
                Case "10101": return 21;
                Case "10110": return 22;
                Case "10111": return 23;
                Case "11000": return 24;
                Case "11001": return 25;
                Case "11010": return 26;
                Case "11011": return 27;
                Case "11100": return 28;
                Case "11101": return 29;
                Case "11110": return 30;
                Case "11111": return 31;
            }
        }
        
        public function GetItemId($id)
        {
            $bin1 = $this->ReverseBits(strtoupper(substr($id, 0, 1)));
            $bin2 = $this->ReverseBits(strtoupper(substr($id, 1, 1)));
            $bin = $bin1.$bin2;
            return array('section' => $this->Bit3Reverse(substr($bin, 0, 3)), 'index' => $this->Bit5Reverse(substr($bin, 3, 5)));    
        }
        
		public function CutHexSlotsVault()
		{
			$ODBC = new LD_ODBC();
			for($i = 0; $i < 120; $i++)
			{
				if($this->Vault_Slots[$i]['Hex'] <> str_pad("", DIVISOR, "F") && $this->Vault_Slots[$i]['Hex'] <> str_pad("", DIVISOR, "0") && $this->Vault_Slots[$i]['Hex'] <> NULL)
				{
					if(SYSTEM_ITEMS == "NEW")
					{
						$Ancient = hexdec(substr($this->Vault_Slots[$i]['Hex'], 17, 1));
						$Categorie = hexdec(substr($this->Vault_Slots[$i]['Hex'], 18, 1));
						$Index = hexdec(substr($this->Vault_Slots[$i]['Hex'], 0, 2));
						$FindItemDetailsQuery = $ODBC->query("SELECT Number, X, Y, NAME, DUR FROM Items WHERE ID = {$Index} AND TP = {$Categorie}");
                        $FindItemDetails = odbc_fetch_object($FindItemDetailsQuery);
					}
					else
					{
						$Ancient = hexdec(substr($this->Vault_Slots[$i]['Hex'], 17, 1));
						$Index = substr($this->Vault_Slots[$i]['Hex'], 0, 2);
						$Unique = substr($this->Vault_Slots[$i]['Hex'], 14, 2); 
                        $UniqueIntValue = (hexdec($Unique) >= 128 ? 8 : 0);
						$New = substr($this->Vault_Slots[$i]['Hex'], 6, 2);
                        $ID = $this->GetItemId($Index);
                        if($New == "F9") $ID['index'] += 32;                                                                             
						$FindItemDetailsQuery = $ODBC->query("SELECT Number, X, Y, NAME, DUR FROM Items WHERE ID = {$ID['index']} AND TP = ". (int)($ID['section']+$UniqueIntValue) ."");
						$FindItemDetails = odbc_fetch_object($FindItemDetailsQuery);
					}
                    //if($FindItemDetails->Number == NULL);     
                    //    exit(Print_error("<ul><li>Existe um item no seu ba&uacute; que n&atilde;o foi cadastrado no shopping! A a&ccedil;&atildeo foi interrompida, entre em contato com o suporte.</ul></li>"));
            
					$this->Vault_Slots[$i]['Key'] = $FindItemDetails->Number;
					$this->Vault_Slots[$i]['Width'] = $FindItemDetails->X;
					$this->Vault_Slots[$i]['Height'] = $FindItemDetails->Y;     
                    $this->Vault_Slots[$i]['Name'] = $FindItemDetails->NAME;
                    $this->Vault_Slots[$i]['Dur'] = $FindItemDetails->DUR;
					$this->Vault_Slots[$i]['Free'] = false;
				} 
				else
				{
					$this->Vault_Slots[$i]['Key'] = NULL;
					$this->Vault_Slots[$i]['Width'] = 0;
					$this->Vault_Slots[$i]['Height'] = 0;	
					$this->Vault_Slots[$i]['Name'] = NULL;
					$this->Vault_Slots[$i]['Free'] = true;			
				}
			} //var_dump($this->Vault_Slots);
		}
		public function RestructureSlotsFree()
		{
			for($i = 0; $i < 120; $i++)
			{				
				if($this->Vault_Slots[$i]['Hex'] <> str_pad("", DIVISOR, "F") && $this->Vault_Slots[$i]['Hex'] <> str_pad("", DIVISOR, "0") && $this->Vault_Slots[$i]['Hex'] <> NULL)
				{
					for($CTemp = 0; $CTemp < $this->Vault_Slots[$i]['Width']; $CTemp++)
					{
						for($LTemp = 0; $LTemp < $this->Vault_Slots[$i]['Height']; $LTemp++)
						{
							$this->Vault_Slots[$i+$CTemp]['Free'] = false;
							$this->Vault_Slots[$i+$CTemp+(8*$LTemp)]['Free'] = false;
						}
					}
				}
			}
		}		
		public function FindSlotsFree($buyKit = false)
		{
			for($i = (int)0; $i < 120; $i++)
			{
				if($this->Vault_Slots[$i]['Hex'] == str_pad("", DIVISOR, "F"))
				{
					$Full = false;
					for($CTemp = 0; $CTemp < $this->X; $CTemp++)
					{
						for($LTemp = 0; $LTemp < $this->Y; $LTemp++)
						{       
							$tempI = $i+1;
							if(($tempI % 8) == 0 && $this->X > 1) $Full = true; //Necess�rio para n�o adcionar o item partindo ele para outra linha.
							elseif(($tempI % 8) == 7 && $this->X > 2) $Full = true; //Necess�rio para n�o adcionar o item partindo ele para outra linha.
							elseif(($tempI % 8) == 6 && $this->X > 3) $Full = true; //Necess�rio para n�o adcionar o item partindo ele para outra linha.
							elseif(($tempI % 8) == 5 && $this->X > 4) $Full = true; //Necess�rio para n�o adcionar o item partindo ele para outra linha.
							elseif($this->Vault_Slots[$i+$CTemp]['Free'] == false || $this->Vault_Slots[$i+$CTemp+(8*$LTemp)]['Free'] == false) $Full = true; else continue(1);
						}
					}
					if($Full == false) {
						$this->Place_Avaliable = $i;
						break;
					} else $this->Place_Avaliable = -1;
				}
			}
			if($this->Place_Avaliable < 0 && $buyKit == false) 
                exit(Print_error("<ul><li>Infelizmente sua compra n&atilde;o foi realizada, pois n&atilde;o h&aacute; lugar para adicionar o item no bau. Entre no jogo e libere espa&ccedil;o.</ul></li>"));
            elseif($this->Place_Avaliable < 0 && $buyKit == true) return false;  
            
			$this->Vault_Slots[$this->Place_Avaliable]['Free'] = false;
			$this->Vault_Slots[$this->Place_Avaliable]['Hex'] = $this->Hex_ItemBuy;
			$this->Vault_Slots[$this->Place_Avaliable]['Key'] = $this->ProductID;
			$this->Vault_Slots[$this->Place_Avaliable]['Width'] = $this->X;
			$this->Vault_Slots[$this->Place_Avaliable]['Height'] = $this->Y;  
            //var_dump($this->Vault_Slots);
            return true;
		}
		public function DrawVaultOLD() 
		{
			print "<ul><li>Desenhando Bau.</li></ul>";
			$i = (int) 0;
			echo "<div class=\"quadros\" style=\"width:320px;\">";
			for($Line = 0; $Line < 15; $Line++)
			{
				for($Column = 0; $Column < 8; $Column++)
				{	
					if($this->Vault_Slots[$i++]['Free'] == true) 
					{
						echo "<input type=\"button\" style=\"margin: 0px; padding: 0px; background: #FAFAFA; border: 3px solid #EFEFEF; display: marker; width:40px; height:40px; font-size:10px;\" value=\" "; echo $i-1; echo " \" />";
					}
					else 
					{
						echo "<input type=\"button\" style=\"margin: 0px; padding: 0px; color:#000000; background: #FF3737; border: 3px solid #D80E0E; display: marker; width:40px; height:40px; font-size:10px;\" value=\" "; echo $i-1; echo " \" />";
					}
				}
			}
			echo "</div>";
		}
		public function DrawVault() 
		{	
			$this->GetVaultContent();
			$this->CutSlotsVault();
			$this->CutHexSlotsVault();
			$this->RestructureSlotsFree();
			
			$Frist_Slot_Coord_Width = 22;
			$Frist_Slot_Coord_Height = 79;
			$this->Vault_Photo = imagecreatefrompng( "images/vault/vault.png" );
			$this->Vault_Slot_Full = imagecreatefrompng( "images/vault/slot_full.png" );
			
			
			$white = imagecolorallocate($this->Vault_Photo, 255, 255, 255);
			$black = imagecolorallocate($this->Vault_Photo, 0, 0, 0);
			$green = imagecolorallocate($this->Vault_Photo, 0, 216, 0);
			$red = imagecolorallocate($this->Vault_Photo, 255, 0, 0);
			$yellow = imagecolorallocate($this->Vault_Photo, 255, 255, 0);
			$blue = imagecolorallocate($this->Vault_Photo, 0, 0, 255);
			
			$i = (int) 0;
			for($Line = 0; $Line < 15; $Line++)
			{
				for($Column = 0; $Column < 8; $Column++)
				{	
					if($this->Vault_Slots[$i]['Free'] == false) 
					{
						imagecopy($this->Vault_Photo, $this->Vault_Slot_Full , $Frist_Slot_Coord_Width + (32 * $Column), $Frist_Slot_Coord_Height + (32*$Line) ,0,0,32,32);
					}
					$i++;
				}
			}
			$i = (int) 0;
			for($Line = 0; $Line < 15; $Line++)
			{
				for($Column = 0; $Column < 8; $Column++)
				{	
					if($this->Vault_Slots[$i]['Hex'] <> "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF" && $this->Vault_Slots[$i]['Hex'] <> "00000000000000000000000000000000" && $this->Vault_Slots[$i]['Hex'] <> NULL)
					{
						/*
						[categoria][index][level].gif
						################################################################
						[categoria] = categoria no item(kor).txt;
						[index] = index da categoria do item no item(kor).txt;
						[level] = So aparece no nome do arquivo caso seja maior que 0;
						*/
						$Categorie = hexdec(substr($this->Vault_Slots[$i]['Hex'], 17, 2));
						$Index = hexdec(substr($this->Vault_Slots[$i]['Hex'], 0, 2));
						
						$lslo = hexdec(substr($this->Vault_Slots[$i]['Hex'], 2, 2));
						if($lslo >= 128) {
							$Skill = true;
							$lslo -= 128;
						}
						$resto_div = $lslo % 8; //Sofre subtra��es
						$resto_div_2 = $lslo % 8; //Mantem o valor para ver o level
						if($resto_div == 0) {
							$Luck = false;
							$Option = false;
						} else {
							if($resto_div >= 4) {
								$Luck = true;
								$resto_div -= 4;
							}
							$this->option = $resto_div;			
						}
						
						$Level = ($lslo-$resto_div_2)/8;
						//imagestring($this->Vault_Photo, 3, $Frist_Slot_Coord_Width + (32 * $Column), $Frist_Slot_Coord_Height + (32*$Line), $Level, $red); //Imprime o level do item na imagem
						
						$this->Photo_Item_Name = "images/items_vault/".str_pad($Categorie,2,"0", STR_PAD_LEFT).str_pad($Index,2,"0", STR_PAD_LEFT).".gif";
						if(file_exists($this->Photo_Item_Name) == false) $this->Photo_Item_Name = "images/items_vault/".str_pad($Categorie,2,"0", STR_PAD_LEFT).str_pad($Index,2,"0", STR_PAD_LEFT).str_pad($Level,2,"0", STR_PAD_LEFT).".gif";
						if(file_exists($this->Photo_Item_Name) == false) $this->Photo_Item_Name = "images/items_vault/NoPhoto.gif";
						$this->Photo_Item = imagecreatefromgif( $this->Photo_Item_Name );
						$Size = getimagesize($this->Photo_Item_Name);
						imagecopy($this->Vault_Photo, $this->Photo_Item , $Frist_Slot_Coord_Width + (32 * $Column), $Frist_Slot_Coord_Height + (32*$Line) ,0,0,$Size[0],$Size[1]);
					}
					//imagestring($this->Vault_Photo, 3, $Frist_Slot_Coord_Width + (32 * $Column), $Frist_Slot_Coord_Height + (32*$Line), $i, $red); //Imprime o id o slot
					$i++;
				}
			}
			imagestring($this->Vault_Photo, 3, 33, 663, "Visualiza��o n�o � 100% garantida.", $yellow);
		}
		public function WriteVault() 
		{
			//print "<ul><li>Gravando Itens no Bau.</li></ul>";
			$this->Vault_End_Process = NULL;
			for($i = 0; $i < $this->SlotCounts; $i++)
			{
				$this->Vault_End_Process .= $this->Vault_Slots[$i]['Hex'];
			} 
			$SQL_Q = $this->query("UPDATE warehouse SET items = 0x".$this->Vault_End_Process." WHERE AccountID='".$_SESSION['Login']."' " . (constant("ENCGAMES_S6") === true ? " AND VaultID = 1" : NULL) . ";");
			if(!$SQL_Q) exit(Print_error("<ul><li>Erro ao gravar conteudo no bau. [Obs: J&aacute; foi lhe cobrado pelo item]</li></ul>"));
		}
	}
}


?>
