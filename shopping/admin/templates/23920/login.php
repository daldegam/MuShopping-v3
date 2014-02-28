<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" lang="en-gb"><head>


  <meta http-equiv="contentAdmin-type" contentAdmin="text/html; charset=iso-8859-1">
  <meta name="robots" contentAdmin="index, follow">
  <meta name="keywords" contentAdmin="MuOnline, Shopping, Daldegam">
  <meta name="description" contentAdmin="MuOnline Shopping - Sistema de vendas de itens.">
  <title>{#TITLE}</title>                                        
	<link rel="stylesheet" href="templates/23920/styles/template.css" type="text/css">
	<link rel="stylesheet" href="templates/23920/styles/constant.css" type="text/css">
    <script type="text/javascript" src="modules/ajax.js"></script>
     <!--[if IE 6]>
   <script type="text/javascript" src="templates/23920/scripts/ie_png.js"></script>
   <script type="text/javascript">
       ie_png.fix('.png');
	</script>
<![endif]-->
</head><body id="body">
    <div class="main">
        <div class="top-menu clear">
        	<div class="border-top">
            	<div class="corner-top-left">
                	<div class="corner-top-right clear">
                    	<div class="moduletable">
							<ul class="menu-nav">
								<li class="item53"><a href="?"><span>Inicio</span></a></li>            
							</ul>		
						</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="logo-search clear">
        	<div class="fleft"><h1><a href="?"></a></h1></div>
        </div>
       <div id="contentAdmin">
            <div class="border2-bottom clear">
            	<div class="corner2-top-left clear">
                	<div class="corner2-top-right clear">
                    	<div class="corner2-bottom-left clear">
                        	<div class="corner2-bottom-right clear">
                            	<div class="contentAdmin-indent">
                                	<div class="clear">
                                    	<table>
                                        	<tbody><tr>
                                            	<td id="container">
                                                	<table>
                                                    	<tbody><tr>
                                                        	<td class="indent-1">
                                                            	<div class="wrapper-main-top clear png"><div class="png"><div class="png"></div></div></div>
                                                            	<div class="clear">
                                                                	<div class="bg-6 png">
                                                                        <div class="clear border6-right">
                                                                            <table class="extra-height">
                                                                            	<tbody><tr>
                                                                                	<td>
                                                                                    	<div class="indent-2">
                                                                                            <div class="clear">
<table class="blog" cellpadding="0" cellspacing="0">
<tbody><tr>
	<td valign="top">
		<div>
		<div class="clear">
			<div class="wrapper-corner-top clear png"><div class="png"><div></div></div></div>
				<div class="clear">
					<div class="wrapper-center">
						<div class="clear contentAdminpaneopen">
							<div class="fleft contentAdminheading">
							   <div class="title">{#TITLE}</div>
							</div>
						</div>
					</div>
				</div>   
			<div class="wrapper-corner-bottom clear png"><div class="png"><div></div></div></div>  
		</div> 	
        <div class="contentAdmin-text">
			<div class="clear">
			<table class="contentAdminpaneopen">
			<tbody><tr>
			<td colspan="2" class="article_indent" valign="top">
			    <div class="indent-top text">
                Seja bem vindo ao shopping v3.<br />
                Aqui voc&ecirc; pode comprar itens para sua conta entre outros.<br />
                Logue-se no sistema usando ao painel ao lado direto.<br />
                Obrigado.
                </div>
			</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
	    <span class="article_separator">&nbsp;</span>
	    </div>
	</td>
</tr></tbody>
</table>

                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="wrapper-main-bottom clear png"><div class="png"><div class="png"></div></div></div>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                                <td class="wrapper-col-box extra-height">
                                                <div class="wrapper-main7-top clear png"><div class="png"><div class="png"></div></div></div>	
                                                  <div class="bg-7">
                                                        <div class="border7-left">
                                                            <div class="border7-right">
                                                                <table class="wrapper-col-box-indent" style="width: auto;">
                                                                    <tbody><tr>
<td>
                                                                            <table id="right">
                                                                                <tbody><tr>
                                                                                    <td>
           <!-- Box Login Begin -->                                                                         
           <div class="clear">        
            <div class="box-left module-login">
                <div class="corner4-top-left">
                    <div class="corner4-top-right">
                        <div class="corner4-bottom-left">
                            <div class="corner4-bottom-right clear">
                                <div class="box-title"></div>                                        
                                <div class="box-contentAdmin">
                                    <div class="clear">
                                            <label>{#LABEL_LOGIN}</label>
                                            <input id="userName" type="text" maxlength="10" class="inputbox" />
                                            <label>{#LABEL_PASSWORD}</label>
                                            <input id="userPwd" type="password" maxlength="10" class="inputbox" />
                                            <label>{#LABEL_IMAGE}:</label>
                                            <img src="../modules/captcha.php?<?=mktime();?>" style="border:none;" /><br />
                                            <input id="captcha" type="text" maxlength="8" class="inputbox" /><br />   
                                            <input value="{#LABEL_BUTTON_SUBMIT_LOGIN}" type="submit" class="button indent-button" onclick="javascript: Verify ('index.php?AjaxFunctions=TRUE&amp;Function=Login&amp;userName='+ document.getElementById('userName').value+'&amp;userPwd='+ document.getElementById('userPwd').value+'&amp;captcha='+ document.getElementById('captcha').value, 'Ajax_Result_Login', 'get');" />
                                            
                                            <div id="Ajax_Result_Login" class="quadros"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           </div>
           <!-- Box Login End -->
          
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody></table>
                                                                                    
                                                                        </td>
</tr>
                                                                </tbody></table>
                                                            </div>
                                                        </div>
                                                  </div>
                                                  <div class="wrapper-main7-bottom clear png"><div class="png"><div class="png"></div></div></div>                                 
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <div id="footer">
            <div class="footer-indent">
            <span>&copy; <? echo date("Y"); ?> <strong>{#TITLE}</strong> | <a href="admin/">[AdminSystem]</a><br />
                P&aacute;gina gerada em: {#Time} secs. | Layout by <a href="http://www.joomla.org/">Joomla!</a></span>
            </div>
        </div>
	</div>
</body></html>