<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if(class_exists("LD_Auth") == false) 
{
	class LD_Auth extends LD_Mssql
	{	  
		private $login;
		private $password;
		private $captcha;
		public function __construct($userName, $userPwd,$captcha) 
		{
			global $Protect;
			$this->login = $Protect->Check($userName);
			$this->password = $Protect->Check($userPwd);
			$this->captcha = $Protect->Check($captcha);
			if($_SESSION["SecurityCode"] <> $captcha) exit(Print_error("Texto da imagem inv&aacute;lido."));
			//$this->Valid_UserName();
			$this->Valid_UserPwd();
			
			$_SESSION['Login'] = $this->login;
			$_SESSION['Browser'] = str_replace(";", ":",$_SERVER['HTTP_USER_AGENT']);
			$_SESSION['Address'] = $_SERVER['REMOTE_ADDR'];
			print "Logado com sucesso. Aguarde...";
			Refresh_Page(0);
		}
		public function Valid_UserName() 
		{
			if(empty($this->login) == true) exit(Print_error("Usu&aacute;rio",3));
			$Temp_Q = $this->query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='".(string) $this->login."'");
			$Temp = mssql_num_rows($Temp_Q);
			if($Temp == 0) exit(Print_error(" incorreto."));
		}
		public function Valid_UserPwd() 
		{
			if(empty($this->password) == true) exit(Print_error("Senha",3));
			$checkQ = $this->query('exec dbo.webVerifyLogin "'. $this->login .'","'. $this->password .'","'. HASHMD5 .'"');
            $check = mssql_fetch_row($checkQ);
            if($check[0] == 0) exit(Print_error("Usu&aacute;rio ou Senha incorretos."));
		}
	}
}

?>