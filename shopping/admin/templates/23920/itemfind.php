<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" lang="en-gb"><head>


  <meta http-equiv="contentAdmin-type" contentAdmin="text/html; charset=iso-8859-1">
  <meta name="robots" contentAdmin="index, follow">
  <meta name="keywords" contentAdmin="MuOnline, Shopping, Daldegam">
  <meta name="description" contentAdmin="MuOnline Shopping - Sistema de vendas de itens.">
  <title>{#TITLE} - Administração</title>                                               
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
								<li class="item53"><a href="?cmd=Default"><span>Inicio</span></a></li>        
								<li class="item56"><a href="?cmd=LogoutSystem"><span>Logout</span></a></li>
								<li class="item57"><a href="../"><span>Voltar para o shop</span></a></li>
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
							   <div class="title">Buscar itens</div>
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
			    <div class="quadros">                              
                    <p>
                        Serial do item a ser encontrado: <br /><input value="" type="text" id="serialItem" name="serialItem" maxlength="8" /> <br />
                        <input value="Procurar" type="button" class="button" onclick="Verify('?AjaxFunctions=true&Function=itemFind&serialItem='+document.getElementById('serialItem').value, 'content', 'GET');" />
                    </p>                              
                    <div id="content"></div>                                                                       
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
<td>                                                                        <?php
                                                                            /*  Box de login
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
                                         <form action="?" method="post" name="login" class="form-login">
                                            <label>Login</label>
                                            <input name="username" class="inputbox" alt="Username" type="text">
                                            <label>Senha</label>
                                            <input name="passwd" class="inputbox" alt="Password" type="password"><br />
                                            <input name="Submit" class="button indent-button" value="Logar" type="submit">
                                         </form>
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
                                                                            </tbody></table>  */ ?>
                                                                        
                                                                            <table id="left">
                                                                                <tbody><tr>
                                                                                <td>

        <!-- Menu Begin -->
        <div class="clear">
        <div class="wrapper_box_right">
            <div class="module_menu">
                <div class="box-title">
                    <div class="border5-top">
                        <div class="border5-bottom">
                            <div class="border5-left">
                                <div class="border5-right">
                                    <div class="corner5-top-left">
                                        <div class="corner5-top-right">
                                            <div class="corner5-bottom-left">
                                                <div class="corner5-bottom-right">
                                                    <div class="box-title-bull png">
                                                        <h3>Menu</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                                                      
                <div class="box-contentAdmin">
                  <div class="clear">
                    <ul class="menu">                                                         
                        <li class="item2"><a href="?cmd=Product::[Manager]"><span>Produtos [Gerenciar]</span></a></li>
                        <li class="item60"><a href="?cmd=Coupons::[Manager]"><span>Cupons [Gerenciar]</span></a></li>
                        <li class="item61"><a href="?cmd=Logs::[ItemsBuys]"><span>Logs [Compra de itens]</span></a></li>
                        <li class="item62"><a href="?cmd=Logs::[KitsBuys]"><span>Logs [Compra de kits]</span></a></li>
                        <li class="item63"><a href="?cmd=Payments::[InProgress]"><span>Pagamentos [Andamento]</span></a></li>
                        <li class="item64"><a href="?cmd=Payments::[Completed]"><span>Pagamentos [Concluidos]</span></a></li>   
                        <li class="item65"><a href="?cmd=Payments::[Rejected]"><span>Pagamentos [Rejeitados]</span></a></li>   
                        <li class="item66"><a href="?cmd=Reports"><span>Relatórios Financeiros</span></a></li>          
                        <li class="item67"><a href="?cmd=Logins::[Manager]"><span>Gerenciador de Logins</span></a></li> 
                        <li class="item68"><a href="?cmd=ItemFind"><span>Buscar Itens (Serial)</span></a></li> 
                    </ul>                    
                  </div>
                </div>
            </div>
        </div> 
        </div>
        <!-- Menu End -->
           
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