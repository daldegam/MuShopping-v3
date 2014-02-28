<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Reports" ) == false ) {
	class Reports {
		public $Results_Reports;           
        public $totalPaymentsValueOne = 0;
        public $totalPaymentsValueTwo = 0;
		public function __construct() 
		{
			global $tpl;
			if($_GET['Generate'] == true) $this->GenerateReports();
			$tpl->set("RESULT_REPORTS", $this->Results_Reports);
		}	
		private function GenerateReports()
		{
			global $ODBC;
			$months_one = $_POST['months_one'];
            $year_one = $_POST['year_one'];
			$months_two = $_POST['months_two'];
            $year_two = $_POST['year_two'];
                                                                          
            $timeOneBegin = mktime(0, 0, 0, $months_one, 1, $year_one);
            $timeOneEnd = mktime(0, 0, 0, $months_one, 29, $year_one); 
            
            $timeTwoBegin = mktime(0, 0, 0, $months_two, 1, $year_two);
            $timeTwoEnd = mktime(0, 0, 0, $months_two, 29, $year_two);
            
            if($timeOneBegin > $timeTwoBegin) return $this->Results_Reports .= "<div class=\"quadros\"><ul><li>Erro: A data inicial deve ser menor que a data final.</li></ul></div>";
                       
            $this->findPaymentsQuery = $ODBC->query("SELECT price FROM LogsReports WHERE dateInclude > {$timeOneBegin} AND dateInclude < {$timeOneEnd}");
            while($this->findPayments = odbc_fetch_object($this->findPaymentsQuery))
                 $this->totalPaymentsValueOne += $this->findPayments->price;
            
            $this->findPaymentsQuery = $ODBC->query("SELECT price FROM LogsReports WHERE dateInclude > {$timeTwoBegin} AND dateInclude < {$timeTwoEnd}");
            while($this->findPayments = odbc_fetch_object($this->findPaymentsQuery))
                 $this->totalPaymentsValueTwo += $this->findPayments->price;
                 
            $this->findSoldsItemsOneQuery = $ODBC->query("SELECT count(1) as totalSolds FROM LogSolds WHERE data > '{$timeOneBegin}' AND data < '{$timeOneEnd}'");
            $this->findSoldsItemsOne = odbc_fetch_object($this->findSoldsItemsOneQuery);
            $this->findSoldsItemsTwoQuery = $ODBC->query("SELECT count(1) as totalSolds FROM LogSolds WHERE data > '{$timeTwoBegin}' AND data < '{$timeTwoEnd}'");
            $this->findSoldsItemsTwo = odbc_fetch_object($this->findSoldsItemsTwoQuery);
            
            $this->findSoldsKitsOneQuery = $ODBC->query("SELECT count(1) as totalSolds FROM LogSoldsKits WHERE data > '{$timeOneBegin}' AND data < '{$timeOneEnd}'");
            $this->findSoldsKitsOne = odbc_fetch_object($this->findSoldsKitsOneQuery);
            $this->findSoldsKitsTwoQuery = $ODBC->query("SELECT count(1) as totalSolds FROM LogSoldsKits WHERE data > '{$timeTwoBegin}' AND data < '{$timeTwoEnd}'");
            $this->findSoldsKitsTwo = odbc_fetch_object($this->findSoldsKitsTwoQuery);
            
            $this->Results_Reports .= "<div class=\"quadros\">Gerando relatório entre as datas: <strong>".$months_one."/".$year_one."</strong> e <strong>".$months_two."/".$year_two."</strong><br /><br />";
			$this->Results_Reports .= "Atenção, esse relatório é uma estimativa. Não garantimos total precisão.<br /><br />";
            $this->Results_Reports .= "<ul><li>Mês: <strong>{$months_one}</strong> do ano: <strong>{$year_one}</strong> total: <strong>R\$ {$this->totalPaymentsValueOne}</strong></li><li>Mês: <strong>{$months_two}</strong> do ano: <strong>{$year_two}</strong> total: <strong>R\$ {$this->totalPaymentsValueTwo}</strong></li>";
            if($this->totalPaymentsValueOne > $this->totalPaymentsValueTwo) 
            {
                $this->differenceSolds = number_format(($this->totalPaymentsValueOne - $this->totalPaymentsValueTwo), 2, ".", "");
                $this->Results_Reports .= "<li>O mês <strong>{$months_one}</strong> do ano <strong>{$year_one}</strong> teve um lucro maior de:<strong> R\$ {$this->differenceSolds}</strong></li><br />";   
            }
            elseif($this->totalPaymentsValueOne < $this->totalPaymentsValueTwo) 
            {
                $this->differenceSolds = number_format(($this->totalPaymentsValueTwo - $this->totalPaymentsValueOne), 2, ".", "");
                $this->Results_Reports .= "<li>O mês <strong>{$months_two}</strong> do ano <strong>{$year_two}</strong> teve um lucro maior de: <strong>R\$ {$this->differenceSolds}</strong></li><br />";   
            }                                                                                                                                         
            $this->Results_Reports .= "<li>No mês <strong>{$months_one}</strong> do ano <strong>{$year_one}</strong> o shopping vendeu <strong>{$this->findSoldsItemsOne->totalSolds}</strong> itens.</li>";
            $this->Results_Reports .= "<li>No mês <strong>{$months_two}</strong> do ano <strong>{$year_two}</strong> o shopping vendeu <strong>{$this->findSoldsItemsTwo->totalSolds}</strong> itens.</li><br />";
            
            $this->Results_Reports .= "<li>No mês <strong>{$months_one}</strong> do ano <strong>{$year_one}</strong> o shopping vendeu <strong>{$this->findSoldsKitsOne->totalSolds}</strong> kits.</li>";
            $this->Results_Reports .= "<li>No mês <strong>{$months_two}</strong> do ano <strong>{$year_two}</strong> o shopping vendeu <strong>{$this->findSoldsKitsTwo->totalSolds}</strong> kits.</li>";
            
            $this->Results_Reports .= "</ul></div>";
		}
	}
}
?>