<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "LD_Coupon" ) == false ) {
	class LD_Coupon {
		public function __construct($couponCode) 
		{
			global $ODBC;
			$findQ = $ODBC->query("SELECT * FROM CouponCodes WHERE couponCode='".$couponCode."'");
			$find = odbc_fetch_object($findQ);
			if($find->active == 0) exit(Print_error("Esse cupom est&aacute; desativado ou &eacute; inv&aacute;lido."));   
            elseif($find->dateBegin > time()) exit(Print_error("Esse cupom inicia em: ". date("d/m/Y g:i a", $find->dateBegin)));  
            elseif(time() > $find->dateEnd) exit(Print_error("Esse cupom venceu em: ". date("d/m/Y g:i a", $find->dateEnd)));  
            else
			{
				echo "Copum com o ".$find->percent."% de desconto ativado.<br />Aguarde enquanto a p&aacute;gina &eacute; atualizada.";
				$_SESSION['COUPON_ACTIVE'] = true;
				$_SESSION['COUPON_CODE'] = $couponCode;
				$_SESSION['COUPON_PERCENT'] = $find->percent;
				echo "<script type=\"text/javascript\">setInterval(\"top.location = self.location;\",3000);</script>";
			}
		}
	}
}


?>