<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "Coupons" ) == false ) {
	class Coupons {
		public function __construct() 
		{
			switch($_GET['module'])
            {     
                case "includeCoupon":
                    if($_GET['action'] == "insertDb") return $this->loadIncludeCouponDb(); 
                    $this->loadFormIncludeCoupon();
                    break;
                case "alterCoupon":
                    $this->loadCoupons();
                    $this->loadFormAlterCouponSelect();
                    break;
                case "alterThisCoupon":
                    if($_GET['action'] == "alterDb") return $this->loadAlterCouponDb();
                    $this->loadFormAlterCoupon();
                    break;
                case "removeCoupon":
                    $this->loadCoupons();
                    $this->loadFormRemoveCouponSelect();
                    break;
                case "removeThisCoupon":
                    $this->loadRemoveCouponDb();
                    break;
                default: echo "Erro, modulo desconhecido.";  
            } 
		}  
        private function loadFormIncludeCoupon()
        {    
            echo "<form action=\"\" method=\"POST\" id=\"manager\" name=\"manager\">";                      
            echo "Nome do cupon:<br />\n<input id=\"couponCode\" name=\"couponCode\" type=\"text\" value=\"cuponTeste\" /><br />\n"; 
            echo "Porcentagem de desconto:<br />\n<input type=\"text\" value=\"0\" id=\"percent\" name=\"percent\" /><br />\n";   
            echo "Ativado:<br />\n<input type=\"checkbox\" value=\"1\" id=\"active\" name=\"active\" /><br />\n";
            echo "Data de in&iacute;cio:<br />\n<input type=\"text\" value=\"". date("d/m/Y") ."\" id=\"dateBegin\" name=\"dateBegin\" /> Exemplo: " .date("d/m/Y") ."<br />\n";
            echo "Data de t&eacute;rmino:<br />\n<input type=\"text\" value=\"". date("d/m/Y", strtotime("+3 days")) ."\" id=\"dateEnd\" name=\"dateEnd\" /> Exemplo: ". date("d/m/Y", strtotime("+3 days")) ."<br />\n";
            echo "<div class=\"qdestaques\">Aten&ccedil;&atilde;o, escreva as datas no mesmo formato que mostram os exemplos.</div>";
            echo "<input type=\"button\" class=\"button\" value=\"Salvar\" onclick=\"Verify('?AjaxFunctions=TRUE&Function=managerCoupons&module=includeCoupon&action=insertDb', 'resultAjax', 'POST', BuscaElementosForm('manager'));\" />";
            
            echo "</form>";
            echo "<div id=\"resultAjax\"></div>"; 
        }
        private function loadIncludeCouponDb()
        {      
            global $ODBC;                                
            $couponCode =   (string)$_POST['couponCode'];
            $percent =      (int)$_POST['percent'];
            $active =       (int)$_POST['active'];
            $dateBegin =    (string)$_POST['dateBegin'];
            $dateEnd =      (string)$_POST['dateEnd']; 
                                                  
            $dateBegin = explode("/", $dateBegin);
            $dateBegin = mktime("0", "0", "0", $dateBegin[1], $dateBegin[0], $dateBegin[2]); 
            $dateEnd = explode("/", $dateEnd);
            $dateEnd = mktime("0", "0", "0", $dateEnd[1], $dateEnd[0], $dateEnd[2]); 
            
            if($dateBegin > $dateEnd) exit("<ul><li>Erro, a data de in&iacute;cio &eacute; maior que a data do t&eacute;rmino.</li></ul>");
            
            $findCouponExistQuery = $ODBC->query("SELECT couponCode FROM CouponCodes WHERE couponCode='{$couponCode}'");
            $findCouponExist = odbc_fetch_object($findCouponExistQuery);
            if($findCouponExist->couponCode == $couponCode) exit("<ul><li>Erro, esse cupon j&aacute; existe.</li></ul>");
            
            if($ODBC->query("INSERT INTO CouponCodes (`couponCode`, `percent`, `active`, `dateBegin`, `dateEnd`) VALUES ('{$couponCode}', {$percent}, {$active}, '{$dateBegin}', '{$dateEnd}');") == true)
                echo "<ul><li>Cupon salvo com sucesso.</li></ul>";
            else
                echo "<ul><li>Erro ao inserir cupon.</li></ul>"; 
        }
        private function loadCoupons()
        {
            global $ODBC;
            $memoryCouponsQuery = $ODBC->query("SELECT id, couponCode FROM CouponCodes ORDER BY couponCode");
            while($memoryCoupons = odbc_fetch_object($memoryCouponsQuery))
                $this->memoryCoupons[] = $memoryCoupons;
        }
        private function loadFormAlterCouponSelect()
        {
            echo "<strong>Selecione o cupom a ser alterado na lista abaixo:</strong><br /><select multiple style=\"width:500px; height:150px\" onchange=\"javascript: Verify('?AjaxFunctions=TRUE&Function=managerCoupons&module=alterThisCoupon&number='+this.options[this.selectedIndex].value, 'resultItemsAjax', 'get');\">";
            foreach($this->memoryCoupons as $coupon)
            {
                echo "<option value=\"{$coupon->id}\">{$coupon->couponCode}</option>";    
            }   
            echo "</select>";
            echo "<div id=\"resultItemsAjax\" class=\"quadros\"></div>";
        }
        private function loadFormAlterCoupon()
        {    
            global $ODBC;
            if(is_numeric($_GET['number']) == false) exit("<ul><li>Erro, N&uacute;mero inv&aacute;lido.</li></ul>");
            $findDetailsCouponQuery = $ODBC->query("SELECT * FROM CouponCodes WHERE id = ". $_GET['number']);
            $findDetailsCoupon = odbc_fetch_object($findDetailsCouponQuery);
            echo "<form action=\"\" method=\"POST\" id=\"manager\" name=\"manager\">";                      
            echo "Nome do cupon:<br />\n<input id=\"couponCode\" name=\"couponCode\" type=\"text\" value=\"{$findDetailsCoupon->couponCode}\" readonly=\"readonly\" /><br />\n"; 
            echo "Porcentagem de desconto:<br />\n<input type=\"text\" value=\"{$findDetailsCoupon->percent}\" id=\"percent\" name=\"percent\" /><br />\n";   
            echo "Ativado:<br />\n<input type=\"checkbox\" value=\"1\" id=\"active\" name=\"active\" ". ($findDetailsCoupon->active == "1" ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Data de in&iacute;cio:<br />\n<input type=\"text\" value=\"". date("d/m/Y", $findDetailsCoupon->dateBegin) ."\" id=\"dateBegin\" name=\"dateBegin\" /> Exemplo: " .date("d/m/Y") ."<br />\n";
            echo "Data de t&eacute;rmino:<br />\n<input type=\"text\" value=\"". date("d/m/Y", $findDetailsCoupon->dateEnd) ."\" id=\"dateEnd\" name=\"dateEnd\" /> Exemplo: ". date("d/m/Y", strtotime("+3 days")) ."<br />\n";
            echo "<div class=\"qdestaques\">Aten&ccedil;&atilde;o, escreva as datas no mesmo formato que mostram os exemplos.</div>";
            echo "<input type=\"button\" class=\"button\" value=\"Salvar altera&ccedil;&otilde;es\" onclick=\"Verify('?AjaxFunctions=TRUE&Function=managerCoupons&module=alterThisCoupon&action=alterDb', 'resultAjax', 'POST', BuscaElementosForm('manager'));\" />";
            echo "</form>";
            echo "<div id=\"resultAjax\"></div>"; 
        }
        private function loadAlterCouponDb()
        {
            global $ODBC;                                
            $couponCode =   (string)$_POST['couponCode'];
            $percent =      (int)$_POST['percent'];
            $active =       (int)$_POST['active'];
            $dateBegin =    (string)$_POST['dateBegin'];
            $dateEnd =      (string)$_POST['dateEnd']; 
                                                  
            $dateBegin = explode("/", $dateBegin);
            $dateBegin = mktime("0", "0", "0", $dateBegin[1], $dateBegin[0], $dateBegin[2]); 
            $dateEnd = explode("/", $dateEnd);
            $dateEnd = mktime("0", "0", "0", $dateEnd[1], $dateEnd[0], $dateEnd[2]); 
                                                                                                                                      
            if($dateBegin > $dateEnd) exit("<ul><li>Erro, a data de in&iacute;cio &eacute; maior que a data do t&eacute;rmino.</li></ul>");
           
            if($ODBC->query("UPDATE CouponCodes SET 
                            `couponCode` = '{$couponCode}', 
                            `percent` = {$percent}, 
                            `active` = {$active}, 
                            `dateBegin` = '{$dateBegin}', 
                            `dateEnd` = '{$dateEnd}'
                            WHERE `couponCode` = '{$couponCode}'") == true)
                echo "<ul><li>Cupon salvo com sucesso.</li></ul>";
            else
                echo "<ul><li>Erro ao inserir cupon.</li></ul>"; 
               
        }
        private function loadFormRemoveCouponSelect()
        {
            echo "<strong>Selecione o item a ser <strong style=\"color: #FF0000;\">deletado</strong> na lista abaixo:</strong><br /><select multiple style=\"width:500px; height:150px\" id=\"productsList\">";
            foreach($this->memoryCoupons as $coupon)
            {
                echo "<option value=\"{$coupon->id}\">{$coupon->couponCode}</option>";    
            }   
            echo "</select>";
            echo "<input type=\"button\" class=\"button\" value=\"Deletar cupon selecionado\" onclick=\"javascript: Verify('?AjaxFunctions=TRUE&Function=managerCoupons&module=removeThisCoupon&number='+document.getElementById('productsList').value, 'content', 'get');\" />";
        }
        private function loadRemoveCouponDb()
        {
            global $ODBC;
            if(is_numeric($_GET['number']) == false) exit("<ul><li>Erro, N&uacute;mero inv&aacute;lido.</li></ul>");
            if($ODBC->query("DELETE FROM CouponCodes WHERE id=". $_GET['number']) == true)
                echo "<ul><li>Cupon deletado com sucesso.</li></ul>";
            else
                echo "<ul><li>Erro ao deletar cupom, tenta novamente.</li></ul>";     
        }
	}
}
?>