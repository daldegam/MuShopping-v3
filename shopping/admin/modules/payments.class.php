<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Payments" ) == false ) {
	class Payments extends LD_Mssql {
		public $box_result;
		public function __construct() 
		{
			global $tpl;
			if($_GET['Write'] == true && empty($_GET['Id']) == false) $this->Write_Confirmation();
			$tpl->set("BOX_RESULT", $this->box_result);
			switch($_GET['cmd'])
			{
				case "Payments::[InProgress]":
					$this->Find_Number_Confirmations(1);
					$this->Generate_Boxes_Confirmations(1);
				break;
				case "Payments::[Completed]":
					$this->Find_Number_Confirmations(2);
					$this->Generate_Boxes_Confirmations(2);
				break;
				case "Payments::[Rejected]":
					$this->Find_Number_Confirmations(3);
					$this->Generate_Boxes_Confirmations(3);
				break;
			}
			
		}
		private function Find_Number_Confirmations($status)
		{
			global $tpl, $ODBC;
			$findPaymentsQuery = $ODBC->query("SELECT count(1) as countResult FROM LogsPayments WHERE status = ". $status);
			$findPayments = odbc_fetch_object($findPaymentsQuery);
			$tpl->set("TOTAL_CONFIRMATIONS",(int)$findPayments->countResult);
		}
		private function Write_Confirmation()
		{
			global $ODBC;
			$Id = $_GET['Id'];
			$login = $_POST['login'];
			$golds = $_POST['golds'];
			$valor = $_POST['valor'];
			$comentario_adm = $_POST['comentario_adm'];
			$status = $_POST['status'];
			switch($status)
			{
				case 1:   
					$ODBC->query("UPDATE `LogsPayments` SET `comentario_adm` = '". base64_encode($comentario_adm) ."', `status` = 1 WHERE `id` = ". $Id);
				    $ODBC->query("DELETE FROM LogsReports WHERE number = {$Id}");
                break;
				case 2:    
					$ODBC->query("UPDATE LogsPayments SET `comentario_adm` = '". base64_encode($comentario_adm) ."', `status` = 2 WHERE `id` = ". $Id);
					$this->query("UPDATE ". GOLDTABLE ." SET ". GOLDCOLUMN ." = ". GOLDCOLUMN ." + ". $golds ." WHERE ". GOLDMEMBIDENT ." = '". $login ."'");
				    $ODBC->query("INSERT INTO LogsReports (`number`, `login`, `price`, `dateInclude`) VALUES ({$Id},'{$login}','{$valor}',". time() .");");
                break;  
				case 3:  
					$ODBC->query("UPDATE LogsPayments SET `comentario_adm` = '". base64_encode($comentario_adm) ."', `status` = 3 WHERE `id` = ". $Id);
				    $ODBC->query("DELETE FROM LogsReports WHERE number = {$Id}");
                break;
				case 4:       
					$ODBC->query("UPDATE LogsPayments SET `comentario_adm` = '". base64_encode($comentario_adm) ."', `status` = 4 WHERE `id` = ". $Id);
					$this->query("UPDATE ". GOLDTABLE ." SET ". GOLDCOLUMN ." = ". GOLDCOLUMN ." - ". $golds ." WHERE ". GOLDMEMBIDENT ." = '". $login ."'");
				    $ODBC->query("DELETE FROM LogsReports WHERE number = {$Id}");
                break;
			}
			switch($status)
			{
				case 1: $status = "Em andamento"; break;
				case 2: $status = "Concluido"; break;
				case 3: $status = "Rejeitado"; break;
				case 4: $status = "Rejeitado / Removido ". $sgold . "&nbsp;". GOLDNAME; break;
			}
			$this->box_result = "<div class=\"qdestaques\">Novo Status do pedido de número ". $Id ." é <em>". $status ."</em>.<br />". GOLDNAME .": ". $golds ." - Valor: ". $valor .".</div>";
		}
		private function Generate_Boxes_Confirmations($status)
		{
			global $tpl, $ODBC;
			$findPaymentsQuery = $ODBC->query("SELECT * FROM LogsPayments WHERE status = ". $status);
			$Result_Tpl_Temp = NULL;
            
            $begin = (int)($_GET['begin'] < 0 ? 0 : $_GET['begin']);
            $records = (int)10; 
                             
            $i = -1;
			while($findPayments = odbc_fetch_object($findPaymentsQuery))
			{              
                $i++;
                if(isset($_GET['showAll']) == false)
                    if($i < $begin || $i >= ($begin+$records)) continue; 
                
				$findPayments->valor = str_replace("R$", "", $findPayments->valor);
				$findPayments->valor = str_replace(" ", "", $findPayments->valor);
				$findPayments->valor = str_replace(",", ".", $findPayments->valor);
				$Result_Tpl_Temp .= "<form action=\"?cmd=". $_GET['cmd'] ."&amp;Write=true&amp;Id=". $findPayments->id ."\" method=\"post\" class=\"quadros\">
                                        <em>Id:</em> <strong>". $findPayments->id ."</strong><br />
										<em>Login:</em> <input name=\"login\" type=\"text\" value=\"". $findPayments->login ."\" /><br />
										<em>Total de ". GOLDNAME .":</em> <input name=\"golds\" type=\"text\" value=\"". $findPayments->golds ."\" /><br />
										<em>Banco:</em> <strong>". $findPayments->banco ."</strong><br />
										<em>Número Terminal:</em> <strong>". $findPayments->nterminal ."</strong><br />
										<em>Número Transferência:</em> <strong>". $findPayments->ntransferencia ."</strong><br />
										<em>Agência Acolhedora:</em> <strong>". $findPayments->agencia_acolhedora ."</strong><br />
										<em>Número Sequencia:</em> <strong>". $findPayments->nsequencia ."</strong><br />
										<em>CTR:</em> <strong>". $findPayments->ctr ."</strong><br />
										<em>Caixa Eletrônico:</em> <strong>". $findPayments->caixa_eletronico ."</strong><br />
										<em>Número Envelope:</em> <strong>". $findPayments->nenvelope ."</strong><br />
										<em>Número Documento:</em> <strong>". $findPayments->ndocumento ."</strong><br />
										<em>Número Controle:</em> <strong>". $findPayments->ncontrole ."</strong><br />
										<em>Número Operador:</em> <strong>". $findPayments->noperador ."</strong><br />
										<em>Data:</em> <strong>". $findPayments->data ."</strong><br />
										<em>Hora:</em> <strong>". $findPayments->hora ."</strong><br />
										<em>Pago em:</em> <strong>". $findPayments->pago_em ."</strong><br />
										<em>Anexo:</em> <strong>". (strlen($findPayments->anexo) < 2 ? "[Não enviado]":"<a href='../". $findPayments->anexo ."' target=\"_blank\">[Enviado (Clique para ver)]</a>") ."</strong><br />
										<em>Comentário:</em> <strong>". nl2br(base64_decode($findPayments->comentario)) ."</strong><br />
										<em>Valor:</em> <input name=\"valor\" type=\"text\" value=\"". $findPayments->valor ."\" />". ($findPayments->valor < 1 ? "&nbsp;<strong style=\"color:red;\">Atenção no valor</strong>":"") ."<br />
										<em>Comentario ADM:</em> <textarea name=\"comentario_adm\">". nl2br(base64_decode($findPayments->comentario_adm)) ."</textarea><br />
										<em>Novo Status:</em> <select name=\"status\"><option value=\"1\">Em andamento</option><option value=\"2\">Confirmado</option><option value=\"3\">Falso</option><option value=\"4\">Falso / Remover X ". GOLDNAME ."</option></select>
										<input type=\"submit\" value=\"Salvar\" class=\"button\" />
									 </form>";
			}
			$tpl->set("BOXES_CONFIRMATIONS", $Result_Tpl_Temp);
		}
	}
}
?>