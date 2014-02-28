<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Items" ) == false ) {
	class LD_Items extends LD_Vault {
	    public function __construct() 
		{
		}
		public function Write_Variables($ProductID, $Categorie, $Index, $Item_Serial, $Durability, $X, $Y, $Item_Level, $Item_Option, $Item_Ancient, $Item_Skill, $Item_Luck, $Item_OpExc_1, $Item_OpExc_2, $Item_OpExc_3, $Item_OpExc_4, $Item_OpExc_5, $Item_OpExc_6, $Item_JH, $Item_Refine, $Item_Socket_Slot_1, $Item_Socket_Slot_2, $Item_Socket_Slot_3, $Item_Socket_Slot_4, $Item_Socket_Slot_5, $Item_Socket_Slot_1_Option, $Item_Socket_Slot_2_Option, $Item_Socket_Slot_3_Option, $Item_Socket_Slot_4_Option, $Item_Socket_Slot_5_Option)
		{		
			$this->ProductID 		= $ProductID;
			$this->Categorie 		= $Categorie;
			$this->Index 			= $Index;        
			$this->Item_Serial 		= $Item_Serial;
			$this->Durability 		= $Durability;
			$this->X 				= $X;
			$this->Y 				= $Y;
			$this->Item_Level 		= $Item_Level;
			$this->Item_Option 		= $Item_Option*4;
			$this->Item_Ancient 	= $Item_Ancient;
			$this->Item_Skill 		= $Item_Skill;
			$this->Item_Luck 		= $Item_Luck;
			$this->Item_OpExc_1 	= $Item_OpExc_1;
			$this->Item_OpExc_2 	= $Item_OpExc_2;
			$this->Item_OpExc_3 	= $Item_OpExc_3;
			$this->Item_OpExc_4 	= $Item_OpExc_4;
			$this->Item_OpExc_5 	= $Item_OpExc_5;  
            $this->Item_OpExc_6     = $Item_OpExc_6;
            $this->Item_JH          = $Item_JH;  
            $this->Item_Refine      = $Item_Refine; 
            $this->Item_Socket_Slot_1   = $Item_Socket_Slot_1;
            $this->Item_Socket_Slot_2   = $Item_Socket_Slot_2;
            $this->Item_Socket_Slot_3   = $Item_Socket_Slot_3;
            $this->Item_Socket_Slot_4   = $Item_Socket_Slot_4;
            $this->Item_Socket_Slot_5   = $Item_Socket_Slot_5;
            $this->Item_Socket_Slot_1_Option   = $Item_Socket_Slot_1_Option;
            $this->Item_Socket_Slot_2_Option   = $Item_Socket_Slot_2_Option;
            $this->Item_Socket_Slot_3_Option   = $Item_Socket_Slot_3_Option;
            $this->Item_Socket_Slot_4_Option   = $Item_Socket_Slot_4_Option;
            $this->Item_Socket_Slot_5_Option   = $Item_Socket_Slot_5_Option;
		}	  
		public function GetSerial() {
            if(defined("WZ_GETITEMSERIAL") == false)
                $SQL_Q = $this->query("exec WZ_GetItemSerial");
            else
			    $SQL_Q = $this->query("exec ".constant("WZ_GETITEMSERIAL"));
			$SQL = mssql_fetch_row($SQL_Q);
			$Serial = strtoupper(dechex($SQL[0]));
			$Serial = str_pad($Serial, 8, 0, STR_PAD_LEFT); 
			$this->Item_Serial = $Serial;
			return $Serial;
	  	}
		public function GenerateItemIdOld($section, $index)
		{
			return ((($index & 0x1F) | (($section << 5) & 0xE0)) & 0xFF);	
		}
		public function GenerateHex()
		{                                                                 
			switch($this->Item_Ancient)
			{
				case 1: 
                    $this->Item_Ancient = "5"; 
                    break;
				case 2: 
                    $this->Item_Ancient = "A"; 
                    break;
				default: 
                    $this->Item_Ancient = "0"; 
                    break;
			}
			if(SYSTEM_ITEMS == "OLD") 
            {
                $this->indexItem = $this->GenerateItemIdOld($this->Categorie, $this->Index);
				$aa = dechex($this->indexItem);   
                if((int)($this->Categorie * 32) > 255) $this->Unique = true; else $this->Unique = false; 
                if($this->Index > 31) $this->Item_Serial = "F9".substr($this->Item_Serial, 2);
            }
			else 
            {
				$aa = dechex($this->Index); 
			}
             
			$bb = 0; //Level / Skill / Luck / Option Data
			$cc = dechex($this->Durability); //Durabilidade
			$dd = $this->Item_Serial; //Serial
			$ee = 0; //Opções Excelentes
			if(SYSTEM_ITEMS == "NEW") 
			{	
                require("sockets.lib.php");
                //exit(var_dump($socketLib));
				$ffgg = "0".$this->Item_Ancient.substr($this->Fix_Left_0(dechex($this->Categorie),2), 1); 
                if($this->Item_Socket_Slot_1 == "true") $this->socketHex1 = dechex($this->Item_Socket_Slot_1_Option); else $this->socketHex1 = dechex($socketLib['notSocket']);
                if($this->Item_Socket_Slot_2 == "true") $this->socketHex2 = dechex($this->Item_Socket_Slot_2_Option); else $this->socketHex2 = dechex($socketLib['notSocket']);
                if($this->Item_Socket_Slot_3 == "true") $this->socketHex3 = dechex($this->Item_Socket_Slot_3_Option); else $this->socketHex3 = dechex($socketLib['notSocket']);
                if($this->Item_Socket_Slot_4 == "true") $this->socketHex4 = dechex($this->Item_Socket_Slot_4_Option); else $this->socketHex4 = dechex($socketLib['notSocket']);
                if($this->Item_Socket_Slot_5 == "true") $this->socketHex5 = dechex($this->Item_Socket_Slot_5_Option); else $this->socketHex5 = dechex($socketLib['notSocket']);
			}
			else
			{
				$ffgg = "0".$this->Item_Ancient;
			}
			if($this->Item_Level > 0) $bb += $this->Item_Level*8;
			if($this->Item_Skill == 'true') $bb += 128;
			if($this->Item_Luck == 'true') $bb += 4;
			if($this->Item_Option == 4) $bb += 1;
			if($this->Item_Option == 8) $bb += 2;
			if($this->Item_Option == 12) $bb += 3;
			if($this->Item_Option == 16) $bb += 0;
			if($this->Item_Option == 20) $bb += 1;
			if($this->Item_Option == 24) $bb += 2;
			if($this->Item_Option == 28) $bb += 3;
			$bb = dechex($bb);
			//ps: option >=16 soma 64 de unique
			if(SYSTEM_ITEMS == "OLD" && $this->Unique == true) $ee += 128;
			if($this->Item_Option >= 16) $ee += 64;
			if($this->Item_OpExc_1 == 'true') $ee += 1;
			if($this->Item_OpExc_2 == 'true') $ee += 2;
			if($this->Item_OpExc_3 == 'true') $ee += 4;
			if($this->Item_OpExc_4 == 'true') $ee += 8;
			if($this->Item_OpExc_5 == 'true') $ee += 16;
			if($this->Item_OpExc_6 == 'true') $ee += 32;
			$ee = dechex($ee);
            if(SYSTEM_ITEMS == "OLD")
            {
                $this->Hex_ItemBuy = $this->Fix_Right_0(strtoupper($this->Fix_Left_0($aa,2).$this->Fix_Left_0($bb,2).$this->Fix_Left_0($cc,2).$dd.$this->Fix_Left_0($ee,2).$ffgg), 20);
                $this->Hex_ItemBuy = substr($this->Hex_ItemBuy, 0, 20);
            }
            else
            {
                $this->Hex_ItemBuy = $this->Fix_Right_0(strtoupper(
                                                        $this->Fix_Left_0($aa,2).
                                                        $this->Fix_Left_0($bb,2).
                                                        $this->Fix_Left_0($cc,2).
                                                        $dd.
                                                        $this->Fix_Left_0($ee,2).
                                                        $ffgg.
                                                        ($this->Item_Refine == "true" ? "8":"0").
                                                        $this->Fix_Left_0($this->Item_JH,2). 
                                                        $this->Fix_Left_0($this->socketHex1,2). 
                                                        $this->Fix_Left_0($this->socketHex2,2). 
                                                        $this->Fix_Left_0($this->socketHex3,2). 
                                                        $this->Fix_Left_0($this->socketHex4,2). 
                                                        $this->Fix_Left_0($this->socketHex5,2)
                                                        ),
                                                        32);
                $this->Hex_ItemBuy = substr($this->Hex_ItemBuy, 0, 32);
            }                                                       
			//echo( $this->Hex_ItemBuy );
		}
        private function Fix_Left_F($Value, $Legents) 
        {
            return str_pad($Value, $Legents, "F", STR_PAD_LEFT);
        }
        private function Fix_Left_0($Value, $Legents) 
        {
            return str_pad($Value, $Legents, 0, STR_PAD_LEFT);
        }
		private function Fix_Right_0($Value, $Legents) 
		{
			return str_pad($Value, $Legents, 0, STR_PAD_RIGHT);
		}
	}
}


?>