<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "ConfirmSystem" ) == false ) {
	class ConfirmSystem {
		public $ResponseTpl;
		public $Check_List_Error;
		public function __construct()
		{
			global $tpl;
			if(isset($_GET['Write']) == true)
			{
				$this->Check_List();
				if(empty($this->Check_List_Error) == true) $this->Write();
			}
			$tpl->set("ResponseTpl", $this->ResponseTpl);
		}
		private function Check_List()
		{
			$this->golds = $_POST['golds'];
			$this->bank = $_POST['bank'];
			$this->captcha = $_POST['captcha'];
			$this->nterminal = $_POST['nterminal'];
			$this->ntransferencia = $_POST['ntransferencia'];
			$this->agencia_acolhedora = $_POST['agencia_acolhedora'];
			$this->nsequencia = $_POST['nsequencia'];
			$this->ctr = $_POST['ctr'];
			$this->caixa_eletronico = $_POST['caixa_eletronico'];
			$this->nenvelope = $_POST['nenvelope'];
			$this->ndocumento = $_POST['ndocumento'];
			$this->ncontrole = $_POST['ncontrole'];
			$this->noperador = $_POST['noperador'];
			$this->data = $_POST['data'];
			$this->hora = $_POST['hora'];
			$this->valor = $_POST['valor'];
			$this->pago_em = $_POST['pago_em'];
			$this->file = $_FILES['image'];
			$this->comment = $_POST['comment'];
			
			if($this->captcha <> $_SESSION["SecurityCode"]) $this->Check_List_Error .= "<ul><li> A imagem não foi digitada corretamente. </li></ul>";
			if(empty($this->golds) == true) $this->Check_List_Error .= "<ul><li> Você deve escrever a quantia de ". GOLDNAME .". </li></ul>";
			if(empty($this->bank) == true) $this->Check_List_Error .= "<ul><li> Você deve selecionar um banco na lista acima. </li></ul>";
			if(empty($this->data) == true) $this->Check_List_Error .= "<ul><li> Você deve escrever a data em que você efetuou o depósito. </li></ul>";
			if(empty($this->hora) == true) $this->Check_List_Error .= "<ul><li> Você deve escrever o horário em que você efetuou o depósito. </li></ul>";
			if(empty($this->valor) == true) $this->Check_List_Error .= "<ul><li> Você deve escrever o valor do depósito. </li></ul>";
			if(empty($this->pago_em) == true) $this->Check_List_Error .= "<ul><li> Você deve preencha o campo: Pago em. </li></ul>";
			
			if(empty($this->Check_List_Error) == false) $this->ResponseTpl = "<div class=\"qdestaques\"><strong><em>Erros encontrados:</em></strong> <br />". $this->Check_List_Error ."</div>";
		}
		private function Write()
		{
            global $ODBC;
			if(in_array($this->file['type'], array('image/jpeg', 'image/pjpeg', 'image/png')))
			{
				$TmpUploadName = "images/comprovantes/". $_SESSION['Login'] ."[". date("d-m-Y~G-i-s") ."].jpg";
				move_uploaded_file($this->file['tmp_name'], $TmpUploadName);
			}
			$this->ResponseTpl .= "<script type=\"text/javascript\"> document.getElementById('FormConfirm').style.display = 'none'; </script>";
			$ODBC->query("INSERT INTO LogsPayments
							(login,golds,banco,nterminal,ntransferencia,agencia_acolhedora,nsequencia,ctr,caixa_eletronico,nenvelope,ndocumento,ncontrole,noperador,data,hora,pago_em,anexo,comentario,valor,status) VALUES
							('". $_SESSION['Login'] ."', '". $this->golds ."', '". $this->bank ."', '". $this->nterminal ."', '". $this->ntransferencia ."', '". $this->agencia_acolhedora ."', '". $this->nsequencia ."', '". $this->ctr ."', '". $this->caixa_eletronico ."', '". $this->nenvelope ."', '". $this->ndocumento ."', '". $this->ncontrole ."', '". $this->noperador."', '". $this->data ."', '". $this->hora ."', '". $this->pago_em ."', '". $TmpUploadName  ."', '".base64_encode($this->comment)."', '". $this->valor ."', 1);");
			$this->ResponseTpl .= "<div class=\"qdestaques\">Sua confirmação foi enviada com sucesso!<br/>Aguarde que nossa equipe confirme seu pagamento.<br/>Para ver o status da sua confirmação acesse o link: <a href='?cmd=HistorySystem'>Ver confirmações</a><br/>Obrigado.</div>";
		}
	}
}


?>