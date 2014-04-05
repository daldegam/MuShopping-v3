<?php        
require("settings.php");
session_save_path("./tmp"); 
session_name(SESSION_NAME_SHOP);
session_start();                                          

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
    if(isset($_SESSION['Login']) == false) exit("<script type=\"text/javascript\">alert(\"Invalid Session. Redirect for Login Page.\"); window.location='?cmd=LogoutSystem';</script>");
}

/*
    @Import Template Class
*/
Require_File("modules/templates.class.php");
$tpl = new LD_Templates();

/*
    @Settings Configs
*/
Require_File("modules/time.class.php");
$LD_Time = new LD_Time();
Require_File("modules/protect.class.php");
$Protect = new LD_Protect();       
if(defined("LANGUAGE") == true) Require_File("languages/".LANGUAGE.".php"); else exit(Print_error("LANGUAGE",1));
if(defined("HOST_SQL") == false) exit(Print_error("HOST_SQL",1));
if(defined("DATABASE_SQL") == false) exit(Print_error("DATABASE_SQL",1));
if(defined("USER_SQL") == false) exit(Print_error("USER_SQL",1));
if(defined("PWD_SQL") == false) exit(Print_error("PWD_SQL",1));
if(defined("DNS_ODBC") == false) exit(Print_error("DNS_ODBC",1));
if(defined("USER_ODBC") == false) exit(Print_error("USER_ODBC",1));
if(defined("PWD_ODBC") == false) exit(Print_error("PWD_ODBC",1));
Require_File("modules/mssql.class.php");
$SQL = new LD_Mssql();
Require_File("modules/odbc.class.php");
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
            Require_File("modules/login.class.php"); 
            $LD_Auth = new LD_Auth($_GET['userName'],$_GET['userPwd'],$_GET["captcha"]);            
        break;
        case "CatalogSystem" : 
            VerifyLogin();
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            Require_File("modules/catalog.class.php"); 
            $LD_Catalog = new LD_Catalog();
            if(!empty($_GET['ShowCatalogType'])) 
            {
                $LD_Catalog->ShowCatalogType($_GET['ShowCatalogType']);
            }             
        break;
        case "FinishBuy" :
            VerifyLogin();
            if(!isset($_GET['ProductID']) || 
                !isset($_GET['Item_Level']) || 
                !isset($_GET['Item_Option']) || 
                !isset($_GET['Item_Ancient']) || 
                !isset($_GET['Item_Skill']) || 
                !isset($_GET['Item_Luck']) || 
                !isset($_GET['Item_OpExc_1']) || 
                !isset($_GET['Item_OpExc_2']) || 
                !isset($_GET['Item_OpExc_3']) || 
                !isset($_GET['Item_OpExc_4']) || 
                !isset($_GET['Item_OpExc_5']) || 
                !isset($_GET['Item_OpExc_6']) ||  
                !isset($_GET['Item_JH']) ||
                !isset($_GET['Item_Refine']) ||
                !isset($_GET['Item_Socket_Slot_1']) ||
                !isset($_GET['Item_Socket_Slot_2']) ||
                !isset($_GET['Item_Socket_Slot_3']) ||
                !isset($_GET['Item_Socket_Slot_4']) ||
                !isset($_GET['Item_Socket_Slot_5']) ||       
                !isset($_GET['Item_Socket_Slot_1_Option']) ||
                !isset($_GET['Item_Socket_Slot_2_Option']) ||
                !isset($_GET['Item_Socket_Slot_3_Option']) ||
                !isset($_GET['Item_Socket_Slot_4_Option']) ||
                !isset($_GET['Item_Socket_Slot_5_Option'])
                ) exit(Print_error("<script type=\"text/javascript\">alert(\"Erro ao gravar variaveis. Favor tentar efetuar a compra novamente.\"); window.location='?';</script>")); 
            Require_File("modules/vault.class.php");
            Require_File("modules/items.class.php");
            $LD_Items = new LD_Items();
            Require_File("modules/finishbuy.class.php"); 
            //var_dump($_GET);exit(); 
            $LD_FinishBuy = new LD_FinishBuy($_GET['ProductID'],
                                            $_GET['Item_Level'],
                                            $_GET['Item_Option'],
                                            $_GET['Item_Ancient'],
                                            $_GET['Item_Skill'],
                                            $_GET['Item_Luck'],
                                            $_GET['Item_OpExc_1'],
                                            $_GET['Item_OpExc_2'],
                                            $_GET['Item_OpExc_3'],
                                            $_GET['Item_OpExc_4'],
                                            $_GET['Item_OpExc_5'],
                                            $_GET['Item_OpExc_6'],
                                            $_GET['Item_JH'],    
                                            $_GET['Item_Refine'],         
                                            $_GET['Item_Socket_Slot_1'],
                                            $_GET['Item_Socket_Slot_2'],
                                            $_GET['Item_Socket_Slot_3'],
                                            $_GET['Item_Socket_Slot_4'],
                                            $_GET['Item_Socket_Slot_5'],
                                            $_GET['Item_Socket_Slot_1_Option'],
                                            $_GET['Item_Socket_Slot_2_Option'],
                                            $_GET['Item_Socket_Slot_3_Option'],
                                            $_GET['Item_Socket_Slot_4_Option'],
                                            $_GET['Item_Socket_Slot_5_Option']
                                            );
        break;
        case "FinishBuyKit" :
            VerifyLogin();
            if(!isset($_GET['ProductID'])) exit(Print_error("<script type=\"text/javascript\">alert(\"Erro ao gravar variaveis. Favor tentar efetuar a compra novamente.\"); window.location='?';</script>")); 
            Require_File("modules/vault.class.php");
            Require_File("modules/items.class.php");
            $LD_Items = new LD_Items();                  
            Require_File("modules/finishbuy.class.php"); 
            Require_File("modules/finishbuykits.class.php"); 
            $FinishBuyKits = new LD_FinishBuyKits();  
        break; 
        case "RecoverLostItemSystem" :
            VerifyLogin();
            if(!isset($_GET['BuyID'])) exit(Print_error("<script type=\"text/javascript\">alert(\"Erro ao gravar variaveis. Favor tentar efetuar a recupera��o novamente.\"); window.location='?';</script>")); 
            Require_File("modules/vault.class.php");
            Require_File("modules/items.class.php");
            $LD_Items = new LD_Items();
            Require_File("modules/recover_lost_item.class.php");
            $LD_Recover_Lost_Item = new LD_Recover_Lost_Item($_GET['BuyID']);            
        break;
        case "SearchItemSystem" :
            VerifyLogin();
            if(!isset($_GET['BuyID'])) exit(Print_error("<script type=\"text/javascript\">alert(\"Erro ao gravar variaveis. Favor tentar efetuar a recupera��o novamente.\"); window.location='?';</script>")); 
            Require_File("modules/recover_lost_item.class.php");                      
            $LD_Recover_Lost_Item = new LD_Recover_Lost_Item($_GET['BuyID'], true);  
        break;
        case "CouponActive" :
            VerifyLogin();            
            $couponCode = $Protect->Check($_GET['couponCode']);
            Require_File("modules/coupon.class.php");
            $LD_Coupon = new LD_Coupon($couponCode);
        break;
    }
  exit(); //Para a execu��o da p�gina para retornar o ajax
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
    @Open system shop
*/
else
{
    $_SESSION['AddressShop'] = base64_encode("index.php?".$_SERVER[QUERY_STRING]);
    switch($_GET['cmd'])
    {
        case "LogoutSystem": 
            session_destroy();
            Refresh_Page(0);
        break;
        case "CatalogSystem": 
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            $tpl->open("templates/".TEMPLATE."/catalog.php");
        break;
        case "CatalogSystemDetails": 
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            Require_File("modules/catalog.class.php");
            $LD_Catalog = new LD_Catalog();
            $LD_Catalog->GetProductDetails($Protect->Check($_GET['ProductId']));
            $tpl->open("templates/".TEMPLATE."/product_details.php");
        break;
        case "HistorySystem":
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            Require_File("modules/history.class.php");
            $LD_History = new LD_History();
            $tpl->open("templates/".TEMPLATE."/history.php");
        break;  
        case "RecoverLostItemSystem":
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            Require_File("modules/history.class.php");
            $LD_History = new LD_History(true);
            $tpl->open("templates/".TEMPLATE."/recover_lost_item.php");
        break; 
        case "RecoverBrokenItemSystem":
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            Require_File("modules/vault.class.php");
            Require_File("modules/items.class.php");
            $LD_Items = new LD_Items();
            Require_File("modules/recover_broken_item.class.php");
            $LD_Recover_Broken_Item = new LD_Recover_Broken_Item();
            $tpl->open("templates/".TEMPLATE."/recover_broken_item.php");
        break;
        case "ConfirmSystem":
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            Require_File("modules/confirmsystem.class.php");
            $ConfirmSystem = new ConfirmSystem();
            $tpl->open("templates/".TEMPLATE."/confirmsystem.php");
        break;
        case "AboutSystem": 
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            $tpl->open("templates/".TEMPLATE."/about.php");
        break;
        case "DrawVault": 
            /*
            //Tem que refazer isso aqui tudo ainda            
            Require_File("modules/xml.class.php");
            $LD_XML = new LD_XML();
            $LD_XML->OpenFile("modules/items/items_list.xml");
            Require_File("modules/vault.class.php");
            $LD_Vault = new LD_Vault();            
            $LD_Vault->DrawVault();
            header("Content-Type: image/png");
            imagepng( $LD_Vault->Vault_Photo );    */
        break;
        default: 
            Require_File("modules/general.class.php");
            $LD_General = new LD_General();
            $LD_General->GetGolds();
            $LD_General->GetMembname();
            $tpl->open("templates/".TEMPLATE."/index.php");
        break;
    }
    $tpl->set("Time", $LD_Time->Result_Time());
    $tpl->show();
} 
?>
<!-- MuShopping v.3.2.4 - Powered by Leandro Daldegam -->
