<?php                
require("../settings.php");               
session_save_path("../tmp");    
session_name(SESSION_NAME_SHOP);
session_start(); 

class ldSerial
{
    public static $authenticate = false;
    private static $hashDelLicense = false;
    private static $addressPhysicLicense = false;
    private static $trialVersion = false;
    public static final function valid()
    {
        $addressSite = preg_replace("/(www\.|:.*)/i", "", strtolower($_SERVER["HTTP_HOST"]));
        self::$addressPhysicLicense = "../licenses/".crc32($addressSite).".txt";
        if(file_exists(self::$addressPhysicLicense) == false)
        {
            echo("<strong>O arquivo referente a licença desse endereço não existe.</strong><br />");
            echo("-----------------------------------------<br />");    
            echo("Visite <a href='http://www.daldegamserver.com'>http://www.daldegamserver.com</a> para adiquirir uma licença válida.<br />");    
            echo("Leandro Daldegam - ldaldegam@hotmail.com - (31) 8693-5000.<br />");
            exit(); 
        }
        else
        {
            $handle = fopen(self::$addressPhysicLicense, "r");
            $licenseFileEncode = fread($handle, filesize(self::$addressPhysicLicense));
            fclose($handle);
            
            //Primeiro método - Falha de php injection
            define("hookSite", true);
            require_once("../modules/ldcrypt.class.php");
            $licenseFile = unserialize(ldCrypt::decode($licenseFileEncode, "5561a20defad5617fbe01440826ecf46"));
            if($licenseFile["trialVersion"] == true)
                $licenseFile["addressUse"] = ldCrypt::mask(urldecode($licenseFile["addressUse"]), $licenseFile["maskExpireTime"], "5561a20defad5617fbe01440826ecf46");   
            if($licenseFile["addressUse"] != $addressSite) $errorLicense = true;
            
            //Segundo método - Via HTTP sem falhas ;D
            // licensehosteua.no-ip.biz && licensehostbrasil.no-ip.biz 
            date_default_timezone_set("America/Sao_Paulo");
                         
            if(defined("countryPreference") == false)
                exit("Fatal error: Undefined countryPreference constant");
            
            $sendAuth = array("addressUse" => strrev($licenseFile["addressUse"]), "publicKey" => md5(rand(1,9999)));
            $sendAuthCrypt = ldCrypt::encode(serialize($sendAuth), "5561a20defad5617fbe01440826ecf46");
                
            if(autenticationCache === true)
            {
                $file = "../licenses/".crc32($addressSite).".cache.ini";
                if(($tmpLicense = @parse_ini_file($file, true)) == false)
                {
                    $licenseReturn = self::createCacheFile($file,$sendAuthCrypt,$sendAuth); //File not exists
                }
                else
                {     
                    $licenseReturn = unserialize(
                                        ldCrypt::decode(
                                            ldCrypt::mask(
                                                base64_decode($tmpLicense["ldKey"]["key"]),
                                                ldCrypt::mask(base64_decode($tmpLicense["ldKey"]["subKey"])
                                                , "2ac018b1369c98b50c747725f778eb0f", "5561a20defad5617fbe01440826ecf46")
                                            , "5561a20defad5617fbe01440826ecf46")
                                        , "5561a20defad5617fbe01440826ecf46")
                    );  
                }
                if($licenseReturn == false)
                {
                    $licenseReturn = self::createCacheFile($file,$sendAuthCrypt,$sendAuth); //File corrupted
                }
                if($licenseReturn["validAddressIp"] == false || (strrev($licenseReturn["timeKey"]) + 3600) < time() || (strrev($licenseReturn["timeKey"]) - 3600) > time() || strrev($licenseReturn["ipChecker"]) != $licenseFile["addressUse"] ) 
                {
                    $licenseReturn = self::createCacheFile($file,$sendAuthCrypt,$sendAuth); //Expired file
                }
            }
            else
            {   
                $licenseReturn = self::getRemoteLicenseInfos($sendAuthCrypt);
                $licenseReturn = unserialize( ldCrypt::decode( ldCrypt::mask(base64_decode($licenseReturn), $sendAuth["publicKey"], "5561a20defad5617fbe01440826ecf46") , "5561a20defad5617fbe01440826ecf46") );
            }                                                                                                                          
            $licenseFile["expireTime"] = (int) ldCrypt::mask(urldecode($licenseFile["expireTime"]), $licenseFile["maskExpireTime"], "5561a20defad5617fbe01440826ecf46");
            if($licenseReturn["validAddressIp"] == false || (strrev($licenseReturn["timeKey"]) + 7200) < time() || (strrev($licenseReturn["timeKey"]) - 7200) > time() || strrev($licenseReturn["ipChecker"]) != $licenseFile["addressUse"] ) $errorLicense = true;
            if($licenseFile["expireTime"] < time() && $licenseFile["trialVersion"] == true) $errorLicense = true;
            if($errorLicense == true)
            {   
                //var_dump($licenseReturn,$sendAuth);
                echo("<strong>Erro, a licença especificada é inválida.</strong><br />");   
                echo("-----------------------------------------<br />");   
                echo("Produto: <strong>". $licenseFile["product"]."</strong><br />");   
                echo("Versão: <strong>". $licenseFile["version"]."</strong><br />");   
                echo("Empresa proprietária: <strong>". $licenseFile["customerCompany"]."</strong><br />");   
                echo("Encarregado pela licença: <strong>". $licenseFile["customerName"]."</strong><br />");   
                echo("Email do encarregado: <strong>". $licenseFile["customerContact"]."</strong><br />");   
                echo("Licença disponivel para: <strong>". $licenseFile["addressUse"]."</strong><br />");  
                if($licenseFile["trialVersion"] ==  true)
                    echo("Vencimento da licença: <strong>". date("d/m/Y \a\s G:i:s", $licenseFile["expireTime"])."</strong><br />");  
                echo("Data do servidor local: <strong>".date("d/m/Y \a\s G:i:s", time())."</strong><br />");    
                if(isset($licenseReturn["timeKey"]) == true)
                    echo("Data do servidor de autenticação: <strong>".date("d/m/Y \a\s G:i:s", strrev($licenseReturn["timeKey"]))."</strong><br />");    
                echo("-----------------------------------------<br />");    
                echo("Visite <a href='http://www.daldegamserver.com'>http://www.daldegamserver.com</a> para adquirir uma licença válida.<br />");    
                //echo("Visite <a href='http://www.daldegamserver.com/geradorLicencasMuShopping1_3Trial/'>http://www.daldegamserver.com/geradorLicencasMuSite1_3Trial/</a> para adquirir uma licença de demonstração.<br />");    
                echo("Leandro Daldegam - ldaldegam@hotmail.com - (31) 8693-5000.<br />");    
                exit();
            } 
            self::$authenticate = true;
            self::$hashDelLicense = $licenseFile["hashDelLicense"];
            if($licenseFile["trialVersion"] ==  true)
                self::$trialVersion = true;  
        }
    } 
     
    public static final function createCacheFile($file,$sendAuthCrypt, $sendAuth)
    {
        $licenseReturnTmp = self::getRemoteLicenseInfos($sendAuthCrypt);
        $licenseReturn = unserialize( ldCrypt::decode( ldCrypt::mask(base64_decode($licenseReturnTmp), $sendAuth["publicKey"], "5561a20defad5617fbe01440826ecf46"), "5561a20defad5617fbe01440826ecf46") );
        $handle = fopen($file, "w");
        fwrite($handle, "[ldKey]\r\nsubKey = \"".base64_encode(ldCrypt::mask($sendAuth["publicKey"], "2ac018b1369c98b50c747725f778eb0f", "5561a20defad5617fbe01440826ecf46"))."\"\r\nkey = \"{$licenseReturnTmp}\"");
        fclose($handle);
        return $licenseReturn;  
    }
    
    public static final function getRemoteLicenseInfos($sendAuthCrypt)
    {
        if(ini_get('allow_url_fopen') == "1")
        {
            switch( constant("countryPreference") )
            {
                case 0x01:
                    if(gethostbyname("www.mudkt.com.br") != gethostbyname("licensehostbrasil.no-ip.biz"))
                        exit("Fatal error: Loopback detect [Server Brasil]");
                    $licenseReturn = @file_get_contents("http://www.mudkt.com.br/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        $licenseReturn = @file_get_contents("http://www.daldegamserver.com/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        exit("Fatal error: Cant connect to autentication server (0x01 - A.U.F.)");
                    break;
                case 0x02:
                    if(gethostbyname("www.daldegamserver.com") != gethostbyname("licensehosteua.no-ip.biz"))
                        exit("Fatal error: Loopback detect [Server EUA]");
                    $licenseReturn = @file_get_contents("http://www.daldegamserver.com/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        $licenseReturn = @file_get_contents("http://www.mudkt.com.br/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        exit("Fatal error: Cant connect to autentication server (0x02 - A.U.F.)");
                    break;
                default: 
                    exit("Fatal error: Invalid value in countryPreference.");   
            }    
        }
        else
        {
            if(function_exists("curl_init") == false)
            {
                exit("Fatal error: Turn on allow_url_fopen or cUrl in php.ini");
            }
            switch( constant("countryPreference") )
            {
                case 0x01:
                    if(gethostbyname("www.mudkt.com.br") != gethostbyname("licensehostbrasil.no-ip.biz"))
                        exit("Fatal error: Loopback detect [Server Brasil]");
                    $licenseReturn = self::getCURLRequest("http://www.mudkt.com.br/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        $licenseReturn = self::getCURLRequest("http://www.daldegamserver.com/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        exit("Fatal error: Cant connect to autentication server (0x01 - CURL)");
                    break;
                case 0x02:
                    if(gethostbyname("www.daldegamserver.com") != gethostbyname("licensehosteua.no-ip.biz"))
                        exit("Fatal error: Loopback detect [Server EUA]");
                    $licenseReturn = self::getCURLRequest("http://www.daldegamserver.com/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        $licenseReturn = self::getCURLRequest("http://www.mudkt.com.br/authLicense_MuShopV3.php?dump=".urlencode(base64_encode($sendAuthCrypt)));
                    if($licenseReturn === false)
                        exit("Fatal error: Cant connect to autentication server (0x02 - CURL)");
                    break;
                default: 
                    exit("Fatal error: Invalid value in countryPreference.");   
            } 
        }
        return $licenseReturn;  
    }
    
    public static final function deleteLicenseFile($string)
    {
        if(md5(base64_decode(hash("sha512", $string))) == self::$hashDelLicense)
        {                            
            chmod(self::$addressPhysicLicense, 0777);
            unlink(self::$addressPhysicLicense); 
            exit("Authentic hash, file deleted."); 
        }                                 
        else
        exit("Invalid hash for delete license file.");  
    }
    
    public static final function licenseInfo()
    {
        $handle = fopen(self::$addressPhysicLicense, "r");
        $licenseFileEncode = fread($handle, filesize(self::$addressPhysicLicense));
        fclose($handle);
                                                   
        define("hookSite", true);
        require_once("../modules/ldcrypt.class.php");
        $licenseFile = unserialize(ldCrypt::decode($licenseFileEncode, "5561a20defad5617fbe01440826ecf46"));
        if($licenseFile["trialVersion"] == true)
        {
            $licenseFile["expireTime"] = date("d/m/Y \a\s G:i:s", (int) ldCrypt::mask(urldecode($licenseFile["expireTime"]), $licenseFile["maskExpireTime"], "5561a20defad5617fbe01440826ecf46")); 
            $licenseFile["addressUse"] = ldCrypt::mask(urldecode($licenseFile["addressUse"]), $licenseFile["maskExpireTime"], "5561a20defad5617fbe01440826ecf46");
            unset($licenseFile["maskExpireTime"]);
        }
        exit("<pre>File: ".self::$addressPhysicLicense. "<br />". print_r($licenseFile, true) ."</pre>");       
    }
    
    public static final function checkTrialVersion()
    {
        return self::$trialVersion;       
    }
    
    public static final function getCURLRequest($url)
    {
        $cUrl = curl_init($url); 
        curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true); 
        $pageContent = curl_exec($cUrl);
        if(curl_getinfo($cUrl, CURLINFO_HTTP_CODE) <> 200) return false;
        curl_close($cUrl);
        return $pageContent;       
    }
}
ldSerial::valid();
if(ldSerial::$authenticate == false) exit("Erro de autenticação;");
if(isset($_GET['deleteSerialFile'])) ldSerial::deleteLicenseFile($_GET['deleteSerialFile']);
if(isset($_GET['licenseInfo'])) ldSerial::licenseInfo();
 
/*
	@Important Functions
*/
function Print_error ($Msg, $Type = 0) 
{
	switch ($Type) 
	{
		case 1: return "Erro: A constante ".$Msg." n&atilde;o foi declarada."; break;
		case 2: return "Erro: A p&aacute;gina ".$Msg." n&atilde;o existe."; break;
		case 3: return "Erro: O campo ".$Msg." est&aacute; em branco."; break;
		default: return $Msg; break;
	}
}
function Require_File($file)
{
	if(file_exists($file) == true) require $file; else exit(Print_error($file,2));
}
function Refresh_Page($Time = 1000)
{
	if($Time == 0) print "<script type=\"text/javascript\">window.location='?';</script>";
	else print "<script type=\"text/javascript\">setInterval(\"window.location='?';\",".$Time.");</script>";
}
function VerifyLogin()
{
	$FAuthFile = fopen("login_auth.inc", "r");
	$FAuthFile_Content = fread($FAuthFile, filesize("login_auth.inc"));
	$FAuthFile_Content = explode("|",$FAuthFile_Content);
	if(in_array($_SESSION['Login'], $FAuthFile_Content) == false) exit("<script type=\"text/javascript\">alert(\"Seu login não tem previlégio para acessar essa área.\"); window.location='?cmd=LogoutSystem';</script>");
	if(isset($_SESSION['Login']) == false) exit("<script type=\"text/javascript\">alert(\"Invalid Session. Redirect for Login Page.\"); window.location='?cmd=LogoutSystem';</script>");
}

/*
	@Import Template Class
*/
Require_File("../modules/templates.class.php");
$tpl = new LD_Templates();

/*
	@Settings Configs
*/
Require_File("../modules/time.class.php");
$LD_Time = new LD_Time();
Require_File("../modules/protect.class.php");
$Protect = new LD_Protect();
//Require_File("../settings.php");
if(defined("LANGUAGE") == true) Require_File("../languages/".LANGUAGE.".php"); else exit(Print_error("LANGUAGE",1));
if(defined("HOST_SQL") == false) exit(Print_error("HOST_SQL",1));
if(defined("DATABASE_SQL") == false) exit(Print_error("DATABASE_SQL",1));
if(defined("USER_SQL") == false) exit(Print_error("USER_SQL",1));
if(defined("PWD_SQL") == false) exit(Print_error("PWD_SQL",1));
if(defined("DNS_ODBC") == false) exit(Print_error("DNS_ODBC",1));
if(defined("USER_ODBC") == false) exit(Print_error("USER_ODBC",1));
if(defined("PWD_ODBC") == false) exit(Print_error("PWD_ODBC",1));
Require_File("../modules/mssql.class.php");
$SQL = new LD_Mssql();
Require_File("../modules/odbc.class.php");
$ODBC = new LD_ODBC();

switch(SYSTEM_ITEMS)
{
    case "NEW": 
        define("VARBINARY", 1920);
        define("DIVISOR", 32);
        break;
    case "OLD": 
        define("VARBINARY", 1200);
        define("DIVISOR", 20);
        break;
    default: 
        exit(Print_error("Valor da SYSTEM_ITEMS inv&aacute;lido",0));
        break;
}

/*
	@Ajax Functions
*/
if(isset($_GET['AjaxFunctions']) == TRUE)
{
	switch($_GET['Function']) 
	{
		case "Login" : 
			Require_File("../modules/login.class.php"); 
			$LD_Auth = new LD_Auth($_GET['userName'],$_GET['userPwd'],$_GET["captcha"]);			
		break;   
        case "managerProducts":
            VerifyLogin();
            Require_File("modules/products.class.php");
            $products = new products();    
        break;
        case "managerCoupons":
            VerifyLogin();
            Require_File("modules/coupons.class.php");
            $Coupons = new Coupons();    
        break;
        case "itemFind":
            VerifyLogin();
            Require_File("modules/itemfind.class.php");
            $itemFind = new itemFind();
        break;
		// 	VerifyLogin(); << Colocar nos outros modulos em ajax para admin
	}
  exit(); //Para a execução da página para retornar o ajax
}

/*
	@Verify auth [Session]
*/
if(!isset($_SESSION['Login']))
{
	$tpl->set("Time", $LD_Time->Result_Time());
	$tpl->set("Address", $_SERVER[SCRIPT_NAME]."?".$_SERVER[QUERY_STRING]);
	$tpl->open("templates/".TEMPLATE."/login.php");
	$tpl->show();
}
/*
	@Open system shop administration
*/
else
{
    if($_GET['cmd'] != "LogoutSystem") VerifyLogin();
	$_SESSION['AddressShop'] = base64_encode("index.php?".$_SERVER['QUERY_STRING']);
    switch($_GET['cmd'])
	{
		case "LogoutSystem": 
			session_destroy();
			Refresh_Page(0);
		break;
		case "Product::[Manager]":                       
			$tpl->open("templates/".TEMPLATE."/product[manager].php");
		break;
        case "ManagerPhoto":
            Require_File("modules/managerPhoto.class.php");
            $managerPhoto = new managerPhoto();
            $tpl->open("templates/".TEMPLATE."/managerphoto.php");            
        break; 
        case "Coupons::[Manager]":     
            $tpl->open("templates/".TEMPLATE."/coupons[manager].php");
        break;
        case "Logins::[Manager]": 
            Require_File("modules/logins.class.php");
            $Logins = new Logins();
            $tpl->open("templates/".TEMPLATE."/manager[login].php");
        break;
        case "ItemFind":
            $tpl->open("templates/".TEMPLATE."/itemfind.php");
        break;   
        case "Logs::[ItemsBuys]":
            Require_File("../modules/history.class.php");
            $LD_History = new LD_History(false, true);
            Require_File("modules/logsitems.class.php");
            $LogsItems = new LogsItems();
            $tpl->open("templates/".TEMPLATE."/logs[itemsbuys].php");
            break;
        case "Logs::[KitsBuys]":
            Require_File("../modules/history.class.php");
            $LD_History = new LD_History(false, true);
            Require_File("modules/logskits.class.php");
            $LogsKits = new LogsKits();
            $tpl->open("templates/".TEMPLATE."/logs[kitsbuys].php");
            break;
        case "Payments::[InProgress]":     
            Require_File("modules/payments.class.php");
            $Payments = new Payments();
            $tpl->open("templates/".TEMPLATE."/payments[inprogress].php");
        break;
		case "Payments::[Completed]":     
            Require_File("modules/payments.class.php");
            $Payments = new Payments();
			$tpl->open("templates/".TEMPLATE."/payments[completed].php");
		break;
		case "Payments::[Rejected]":      
            Require_File("modules/payments.class.php");
            $Payments = new Payments();
			$tpl->open("templates/".TEMPLATE."/payments[rejected].php");
		break;  
		case "Reports": 	
			Require_File("modules/reports.class.php");
			$Reports = new Reports();
			$tpl->open("templates/".TEMPLATE."/reports.php");
		break;
		default: 			 
			$tpl->open("templates/".TEMPLATE."/index.php");
		break;
	}
	$tpl->set("Time", $LD_Time->Result_Time());
	$tpl->show();
} 
?>