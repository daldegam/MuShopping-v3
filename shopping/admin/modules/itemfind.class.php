<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "itemFind" ) == false ) {
	class itemFind extends LD_Mssql {
		public function __construct() 
		{  
            if(strlen((string)$_GET['serialItem']) == 8)
            {
                if((string)$_GET['serialItem'] == "00000000" || (string)$_GET['serialItem'] == "FFFFFFFF") exit("<ul><li>Erro: N&atilde;o &eacute; permitida a busca de seriais 00000000 e FFFFFFFF.</li></ul>");
                $this->ProductSerial = (string)$_GET['serialItem'];
                $this->FindItem();
            }
            else
                echo "<ul><li>Erro: Preencha o serial corretamente.</li></ul>";
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
           
            $findColumnsQ = mssql_query("sp_MShelpcolumns N'dbo.warehouse', null, 'id', 1");
            while($findColumns = mssql_fetch_object($findColumnsQ))
            {
                if($findColumns->col_typename == "varbinary")
                {
                    $resultQ = mssql_query("select [AccountId] from [warehouse] where (charindex (0x".$this->ProductSerial.", ".$findColumns->col_name.") %". DIVISOR/2 ."=4)"); 
                    while($result = mssql_fetch_object($resultQ))
                    {
                         echo Print_error("<ul><li>Encontrado no bau do login: ". $result->AccountId .". Tabela: warehouse, coluna: {$findColumns->name}</li></ul>");
                         $exitFunction = true; 
                    }   
                }   
            }
            unset($result, $resultQ);
            
            $resultQ = mssql_query("select [AccountId],[Number] from [ExtWarehouse] where (charindex (0x".$this->ProductSerial.", Items) %". DIVISOR/2 ."=4)"); 
            while($result = mssql_fetch_object($resultQ))
            {
                 echo Print_error("<ul><li>Item foi encontrado no bau extra ". $result->Number ." do login: ". $result->AccountId .".</li></ul>");
                 $exitFunction = true;   
            }
            unset($result, $resultQ); 
            
            $resultQ = @mssql_query("select [AccountId] from [ExtWarehouseVirtual] where (charindex (0x".$this->ProductSerial.", Item) %". DIVISOR/2 ."=4)"); 
            while($result = @mssql_fetch_object($resultQ))
            {
                 echo Print_error("<ul><li>Item foi encontrado no bau virtual do login: ". $result->AccountId .".</li></ul>");
                 $exitFunction = true;   
            }
            unset($result, $resultQ);            
                              
            if($exitFunction == false)
                echo "<ul><li>Esse item n&atilde;o foi encontrado no servidor.</li></ul>"; 
        }
	}
}
?>