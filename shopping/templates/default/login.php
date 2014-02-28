<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="Description" content="MuOnline Shop, powered by Leandro Daldegam" />
<meta name="Keywords" content="MuDKT, MuOnline, Private Servers, Mu, MuServer, MuGlobal, MuChina, MuKorea, Mu Servers, Top Servers, Mu Online, Itens, Shop, MuShop, MuOnline Shop" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Leandro Daldegam" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="templates/default/images/Refresh.css" type="text/css" />
<script type="text/javascript" src="modules/ajax.js"></script>
<title>{#TITLE}</title>
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<!--header -->
		<div id="header"></div>
        
		<!-- menu -->	
		<div id="menu">
		</div>					
			
		<!-- content-wrap starts here -->
		<div id="content-wrap">
			  
			<div id="main">
				
              <h1>{#H1_TITLE}</h1>
              
                <div class="quadros">
                {#LABEL_LOGIN}:<br /> <input id="userName" type="text" maxlength="10" /><br />
                {#LABEL_PASSWORD}:<br /> <input id="userPwd" type="password" maxlength="10" /><br />
                {#LABEL_IMAGE}:<br /> <img src="modules/captcha.php?<?=mktime();?>" style="border:none;" /><br />
                <input id="captcha" type="text" maxlength="8" /><br /><br />
                <input value="{#LABEL_BUTTON_SUBMIT_LOGIN}" type="submit" class="button" onclick="javascript: Verify ('index.php?AjaxFunctions=TRUE&amp;Function=Login&amp;userName='+ document.getElementById('userName').value+'&amp;userPwd='+ document.getElementById('userPwd').value+'&amp;captcha='+ document.getElementById('captcha').value, 'Ajax_Result_Login', 'get');" />
                </div>
                <div id="Ajax_Result_Login" class="quadros"></div>

			</div>
		
		<!-- content-wrap ends here -->	
		</div>
					
		<!--footer starts here-->
		<div id="footer">
        	<p>&copy; <? echo date("Y"); ?> <strong>{#TITLE}</strong> | Powered by Leandro Daldegam | Página gerada em: {#Time} secs. | <a href="admin/">[AdminSystem]</a></p>
        </div>	

<!-- wrap ends here -->
</div>


</body>
</html>