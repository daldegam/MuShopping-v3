<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_FinishBuyKits" ) == false ) {
	class LD_FinishBuyKits extends LD_Mssql {
	 	public function __construct() 
		{ 
            global $ODBC, $LD_Items;
            $_GET['ProductID'] = (int) $_GET['ProductID'];
		    $SQL_Q = $this->query("SELECT ConnectStat FROM MEMB_STAT WHERE memb___id='". $_SESSION['Login'] ."'");
            $SQL = mssql_fetch_object($SQL_Q);
            if($SQL->ConnectStat <> 0) exit(Print_error("<ul><li>Voc&ecirc; deve estar offline do jogo para efetuar essa a&ccedil;&atilde;o!</li></ul>"));
            
            $searchKitQ = $ODBC->query("SELECT priceFix FROM Kits WHERE active = 1 AND Number = ". $_GET['ProductID'] ); 
            if(odbc_num_rows($searchKitQ) == 0) exit(Print_error("<script type=\"text/javascript\">alert(\"Erro kit n&atilde;o cadastrado.\"); window.location='?';</script>")); 
            $searchItensKitQ = $ODBC->query("SELECT * FROM KitsItemsDetails WHERE kitNumber = ". $_GET['ProductID'] );
            echo "<ul><li>Aguarde em quanto sua compra &eacute; processada.</li><br />";
                          
            //Inicio Função independente para cobrar o kit
            $searchKit = odbc_fetch_object($searchKitQ);
            $SQL_Q = $this->query("SELECT ".GOLDCOLUMN." FROM ".GOLDTABLE." WHERE ".GOLDMEMBIDENT." = '". $_SESSION['Login'] ."'");
            $SQL_R = mssql_fetch_row($SQL_Q);
            if($SQL_R[0] < $searchKit->priceFix) exit(Print_error("<ul><li>Desculpe, essa compra n&atilde;o pode ser realizada, pois seu saldo de ".GOLDNAME." &eacute; insuficiente.</li></ul>"));
            $SQL_Q = $this->query("UPDATE ".GOLDTABLE." SET ".GOLDCOLUMN." = ".GOLDCOLUMN."-".$searchKit->priceFix." WHERE ".GOLDMEMBIDENT." = '". $_SESSION['Login'] ."' AND ".GOLDCOLUMN." >= ".$searchKit->priceFix."; select @@rowcount as rows;");
            $SQL_R = mssql_fetch_object($SQL_Q);
            if((int)$SQL_R->rows == 0) exit(Print_error("<ul><li>Erro ao cobrar pelo kit.</li></ul>"));
            //Fim Função independente para cobrar o kit
            $ODBC->query("UPDATE Kits SET solds=solds+1 WHERE Number=".$_GET['ProductID']);
            $searchLastSoldNumberQ = $ODBC->query("SELECT max(Number) as Numb FROM LogSoldsKits");
            $searchLastSoldNumber = odbc_fetch_object($searchLastSoldNumberQ);
            $searchLastSoldNumber->Numb = (int)$searchLastSoldNumber->Numb+1;
            
            $ODBC->query("INSERT INTO LogSoldsKits (login,kitNumber,price,data) VALUES ('{$_SESSION['Login']}', {$_GET['ProductID']}, {$searchKit->priceFix}, '". time() ."')");   
            require("sockets.lib.php");
            //exit(var_dump($socketLib));
                        
            while($searchItensKit = odbc_fetch_object($searchItensKitQ))
            {
                //var_dump($searchItensKit);
                $LD_FinishBuy = new LD_FinishBuy($searchItensKit->itemNumber,
                                                $searchItensKit->fixLVL,
                                                $searchItensKit->fixOP,
                                                $searchItensKit->fixANC,
                                                ($searchItensKit->fixSkill == 0 ? "false" : "true"),
                                                ($searchItensKit->fixLuck == 0 ? "false" : "true"),
                                                ($searchItensKit->fixOpEx1 == 0 ? "false" : "true"),
                                                ($searchItensKit->fixOpEx2 == 0 ? "false" : "true"),
                                                ($searchItensKit->fixOpEx3 == 0 ? "false" : "true"),
                                                ($searchItensKit->fixOpEx4 == 0 ? "false" : "true"),
                                                ($searchItensKit->fixOpEx5 == 0 ? "false" : "true"),  
                                                ($searchItensKit->fixOpEx6 == 0 ? "false" : "true"),
                                                $searchItensKit->fixJH,
                                                ($searchItensKit->fixRefine == 0 ? "false" : "true"),  
                                                ($searchItensKit->fixSocket1 == $socketLib['notSocket'] ? "false" : "true"),  
                                                ($searchItensKit->fixSocket2 == $socketLib['notSocket'] ? "false" : "true"),
                                                ($searchItensKit->fixSocket3 == $socketLib['notSocket'] ? "false" : "true"),
                                                ($searchItensKit->fixSocket4 == $socketLib['notSocket'] ? "false" : "true"),
                                                ($searchItensKit->fixSocket5 == $socketLib['notSocket'] ? "false" : "true"),
                                                $searchItensKit->fixSocket1,
                                                $searchItensKit->fixSocket2,
                                                $searchItensKit->fixSocket3,
                                                $searchItensKit->fixSocket4,
                                                $searchItensKit->fixSocket5,
                                                true);
                $ODBC->query("INSERT INTO LogSoldsKitsDetails (NumberSoldKit,login,itemId,itemSerial) VALUES ({$searchLastSoldNumber->Numb}, '{$_SESSION['Login']}', '{$searchItensKit->itemNumber}', '{$LD_Items->Item_Serial}')");   
                if($LD_FinishBuy->delivered == true)
                    echo "<li>Item: <strong>{$LD_FinishBuy->NAME}</strong>, entregue.</li>";
                else
                    echo "<li>Item: <strong>{$LD_FinishBuy->NAME}</strong>, n&atilde;o houve espa&ccedil;o. <br />Libere espa&ccedil;o no bau e reenvie o item pelo hist&oacute;rico de compras.</li>";
                
                unset($LD_FinishBuy);
            }
            echo "<br /><li>Compra finalizada com sucesso!</li></ul>";
		}
	}
}


?>