<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xml:lang="en-gb" xmlns="http://www.w3.org/1999/xhtml" lang="en-gb"><head>


  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta name="robots" content="index, follow">
  <meta name="keywords" content="MuOnline, Shopping, Daldegam">
  <meta name="description" content="MuOnline Shopping - Sistema de vendas de itens.">
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
								<li class="item53"><a href="?cmd=Default"><span>Inicio</span></a></li>
								<li class="item54"><a href="?cmd=CatalogSystem"><span>Produtos</span></a></li>
								<li class="item55"><a href="?cmd=HistorySystem"><span>Hist&oacute;rico de compras</span></a></li>
								<li class="item56"><a href="?cmd=LogoutSystem"><span>Logout</span></a></li>
								<li class="item57"><a href="../"><span>Voltar para o site</span></a></li>
							</ul>		
						</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="logo-search clear">
        	<div class="fright">
				<div id="search">
                	<div class="corner-top-left">
                    	<div class="corner-top-right clear">
                        	<div class="moduletable">
								<div class="search">
									<input class="inputbox" size="70" value="Seu saldo &eacute;: {#Golds_Amount} <?= GOLDNAME; ?>" type="text" readonly="readonly">	
								</div>		
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fleft"><h1><a href="?"></a></h1></div>
        </div>
       <div id="content">
            <div class="border2-bottom clear">
            	<div class="corner2-top-left clear">
                	<div class="corner2-top-right clear">
                    	<div class="corner2-bottom-left clear">
                        	<div class="corner2-bottom-right clear">
                            	<div class="content-indent">
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
						<div class="clear contentpaneopen">
							<div class="fleft contentheading">
							   <div class="title">Produtos do shopping</div>
							</div>
						</div>
					</div>
				</div>   
			<div class="wrapper-corner-bottom clear png"><div class="png"><div></div></div></div>  
		</div> 	
        <div class="content-text">
			<div class="clear">
			<table class="contentpaneopen">
			<tbody><tr>
			<td colspan="2" class="article_indent" valign="top">
			<div class="quadros">
                Selecione o tipo de produtos a ser exibido ao lado: 
                <select id="ProductType" name="ProductType" onchange="javascript: Verify ('index.php?AjaxFunctions=TRUE&amp;Function=CatalogSystem&amp;ShowCatalogType='+this.options[this.selectedIndex].value, 'Result_Ajax_Catalog', 'get');">
                    <option value="0" disabled="disabled" selected="selected">Selecione</option>
                    <option value="Ofert">--- Promo&ccedil;&otilde;es</option>  
                    <option value="All">--- Todos os Itens</option>
                    <option value="Kits">--- Kits</option>
                    <option value="0" disabled="disabled">- Defesa</option>
                    <option value="Helms">--- Helms</option>
                    <option value="Pants">--- Pants</option>
                    <option value="Gloves">--- Gloves</option>
                    <option value="Boots">--- Boots</option>
                    <option value="Armors">--- Armors</option>
                    <option value="Shields">--- Shields</option>
                    <option value="Pendants">--- Pendants</option>
                    <option value="Rings">--- Rings</option>
                    <option value="Wings">--- Wings</option>
                    
                    <option value="0" disabled="disabled">- Ataque</option>
                    <option value="Axes">--- Axes</option>
                    <option value="Bows">--- Bows</option>
                    <option value="Crossbows">--- Crossbows</option>
                    <option value="Maces">--- Maces</option>
                    <option value="Scepters">--- Scepters</option>
                    <option value="Spears">--- Spears</option>
                    <option value="Staffs">--- Staffs</option>
                    <option value="Swords">--- Swords</option>
                    
                    <option value="0" disabled="disabled">- Outros</option>
                    <option value="Amulets">--- Amulets</option>
                    <option value="Castel Siege">--- Castel Siege</option>
                    <option value="Events">--- Events</option>
                    <option value="Events MIX">--- Events MIX</option>
                    <option value="Gifts/Boxs">--- Gifts/Boxs</option>
                    <option value="Guards/Pets">--- Guards/Pets</option>  
                    <option value="Jewels">--- Jewels</option>
                    <option value="Jewels MIX">--- Jewels MIX</option>
                    <option value="Mix Items">--- Mix Items</option>
                    <option value="Mix Pets">--- Mix Pets</option>
                    <option value="New/Test">--- New/Test</option>
                    <option value="Potions">--- Potions</option>
                    <option value="Quests">--- Quests</option>
                    <option value="Orbs">--- Orbs</option>  
                    <option value="Scrolls">--- Scrolls</option>               
                </select>
                </div>
                <div id="Result_Ajax_Catalog">
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
                                <div class="box-content">
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
                                                      
                <div class="box-content">
                  <div class="clear">
                    <ul class="menu">
                        <li class="item1"><a href="?cmd=Default"><span>Inicio</span></a></li>
                        <li class="item2"><a href="?cmd=CatalogSystem"><span>Ver Produtos</span></a></li>
                        <li class="item60"><a href="?cmd=HistorySystem"><span>Meus Hist&oacute;ricos</span></a></li>
                        <li class="item61"><a href="?cmd=ConfirmSystem"><span>Dep&oacute;sitos</span></a></li>
                        <li class="item62"><a href="?cmd=RecoverLostItemSystem"><span>Recuperar item</span></a></li>
                        <li class="item63"><a href="?cmd=RecoverBrokenItemSystem"><span>Consertar item</span></a></li>
                        <li class="item64"><a href="?cmd=AboutSystem"><span>Sobre o shopping</span></a></li>   
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