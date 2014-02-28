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
							   <div class="title">Confirmar Dep&oacute;sitos</div>
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
			    <script type="text/javascript">
                    function show_hide_blocks(name) 
                    {            
                        if(name == "Opt_Bradesco") 
                        {
                            document.getElementById('Opt_Bradesco').style.display = 'block'; 
                            document.getElementById('Opt_Bradesco_nterminal').disabled = ''; 
                            document.getElementById('Opt_Bradesco_ntransferencia').disabled = ''; 
                            document.getElementById('Opt_Bradesco_agencia_acolhedora').disabled = ''; 
                            document.getElementById('Opt_Bradesco_nsequencia').disabled = ''; 
                        } 
                        else 
                        {
                            document.getElementById('Opt_Bradesco').style.display = 'none';
                            document.getElementById('Opt_Bradesco_nterminal').disabled = 'disabled'; 
                            document.getElementById('Opt_Bradesco_ntransferencia').disabled = 'disabled'; 
                            document.getElementById('Opt_Bradesco_agencia_acolhedora').disabled = 'disabled'; 
                            document.getElementById('Opt_Bradesco_nsequencia').disabled = 'disabled';
                        }
                        if(name == "Opt_Itau") 
                        {
                            document.getElementById('Opt_Itau').style.display = 'block'; 
                            document.getElementById('Opt_Itau_ctr').disabled = ''; 
                            document.getElementById('Opt_Itau_caixa_eletronico').disabled = ''; 
                        } 
                        else 
                        {
                            document.getElementById('Opt_Itau').style.display = 'none';
                            document.getElementById('Opt_Itau_ctr').disabled = 'disabled'; 
                            document.getElementById('Opt_Itau_caixa_eletronico').disabled = 'disabled';
                        }
                        if(name == "Opt_BBrasil") 
                        {
                            document.getElementById('Opt_BBrasil').style.display = 'block'; 
                            document.getElementById('Opt_BBrasil_nenvelope').disabled = ''; 
                            document.getElementById('Opt_BBrasil_ndocumento').disabled = ''; 
                        } 
                        else 
                        {
                            document.getElementById('Opt_BBrasil').style.display = 'none';
                            document.getElementById('Opt_BBrasil_nenvelope').disabled = 'disabled'; 
                            document.getElementById('Opt_BBrasil_ndocumento').disabled = 'disabled';
                        }
                        if(name == "Opt_CXEcon") 
                        {
                            document.getElementById('Opt_CXEcon').style.display = 'block'; 
                            document.getElementById('Opt_CXEcon_nterminal').disabled = ''; 
                        } 
                        else 
                        {
                            document.getElementById('Opt_CXEcon').style.display = 'none';
                            document.getElementById('Opt_CXEcon_nterminal').disabled = 'disabled'; 
                        }
                        if(name == "Opt_Loterica") 
                        {
                            document.getElementById('Opt_Loterica').style.display = 'block'; 
                            document.getElementById('Opt_Loterica_ncontrole').disabled = ''; 
                            document.getElementById('Opt_Loterica_nterminal').disabled = ''; 
                        } 
                        else 
                        {
                            document.getElementById('Opt_Loterica').style.display = 'none';
                            document.getElementById('Opt_Loterica_ncontrole').disabled = 'disabled'; 
                            document.getElementById('Opt_Loterica_nterminal').disabled = 'disabled'; 
                        }
                        if(name == "Opt_CXAqui") 
                        {
                            document.getElementById('Opt_CXAqui').style.display = 'block'; 
                            document.getElementById('Opt_CXAqui_noperador').disabled = '';  
                        } 
                        else 
                        {
                            document.getElementById('Opt_CXAqui').style.display = 'none';
                            document.getElementById('Opt_CXAqui_noperador').disabled = 'disabled'; 
                        }   
                        if(name == "Opt_PGSeg")
                        {                                                                 
                            document.getElementById('comment').value = 'Digite aqui o nome e email de cadastro no pagseguro.';                             
                        }
                        else
                        {                                                                      
                            document.getElementById('comment').value = 'Máximo 200 caracters.';                           
                        }
                        return true;
                    }
                </script>
                <div class="quadros">
                   <strong>Atenção:</strong> <em>A má utilização deste serviço pode causar o bloqueio permanente de sua conta.</em>
                </div>
                <br />
                <form method="post" enctype="multipart/form-data" action="?cmd=ConfirmSystem&Write=true" id="FormConfirm">   
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="width:65%" valign="top">
                            Quantia de <?= GOLDNAME; ?><br /><input type="text" name="golds" value="0"  maxlength="10" /> <a href="javascript:void(0);" onclick="javascript:alert('Coloque a quantidade de <?= GOLDNAME; ?> aqui.');">[?]</a><br />
                            Qual banco você usou<br />
                                <input name="bank" type="radio" value="Banco Bradesco ou Banco Postal" onclick="javascript:show_hide_blocks('Opt_Bradesco');" /> Banco Bradesco ou Banco Postal<br />
                                <input name="bank" type="radio" value="Banco Itau" onclick="javascript:show_hide_blocks('Opt_Itau');" /> Banco Itaú<br />
                                <input name="bank" type="radio" value="Banco do Brasil" onclick="javascript:show_hide_blocks('Opt_BBrasil');" /> Banco do Brasil<br />
                                <input name="bank" type="radio" value="Caixa Economica Federal" onclick="javascript:show_hide_blocks('Opt_CXEcon');" /> Caixa Econômica Federal<br />
                                <input name="bank" type="radio" value="Loterica" onclick="javascript:show_hide_blocks('Opt_Loterica');" /> Lotérica<br />
                                <input name="bank" type="radio" value="Caixa Aqui" onclick="javascript:show_hide_blocks('Opt_CXAqui');" /> Caixa Aqui<br />
                                <input name="bank" type="radio" value="PagSeguro" onclick="javascript:show_hide_blocks('Opt_PGSeg');" /> PagSeguro<br />
                            Digite o codigo abaixo<br /><img src="modules/captcha.php?temp=<?=mktime();?>" /><br /><input name="captcha" type="text" maxlength="8" />
                        </td>
                        <td style="width:35%">
                            <div id="Opt_Bradesco" style="display:none;">
                                Número terminal<br /><input name="nterminal" id="Opt_Bradesco_nterminal" type="text" maxlength="15" /><br />
                                Número transferência<br /><input name="ntransferencia" id="Opt_Bradesco_ntransferencia" type="text" maxlength="15" /><br />
                                Agência acolhedora<br /><input name="agencia_acolhedora" id="Opt_Bradesco_agencia_acolhedora" type="text" maxlength="15" /><br />
                                Número Sequência<br /><input name="nsequencia" id="Opt_Bradesco_nsequencia" type="text" maxlength="15" /><br />
                            </div>
                            <div id="Opt_Itau" style="display:none;">
                                CTR<br /><input name="ctr" id="Opt_Itau_ctr" type="text" maxlength="15" /><br />
                                Caixa Eletrônico<br /><input name="caixa_eletronico" id="Opt_Itau_caixa_eletronico" type="text" maxlength="15" value="Ex: 123456/1234" /><br />
                            </div>
                            <div id="Opt_BBrasil" style="display:none;">
                                Número Envelope<br /><input name="nenvelope" id="Opt_BBrasil_nenvelope" type="text" maxlength="15" /><br />
                                Número Documento<br /><input name="ndocumento" id="Opt_BBrasil_ndocumento" type="text" maxlength="15" /><br />
                            </div>
                            <div id="Opt_CXEcon" style="display:none;">
                                Número do terminal<br /><input name="nterminal" id="Opt_CXEcon_nterminal" type="text" maxlength="15" /><br />
                            </div>
                            <div id="Opt_Loterica" style="display:none;">
                                Número de controle<br /><input name="ncontrole" id="Opt_Loterica_ncontrole" type="text" maxlength="15" /><br />
                                Número do terminal<br /><input name="nterminal" id="Opt_Loterica_nterminal" type="text" maxlength="15" /><br />
                            </div>
                            <div id="Opt_CXAqui" style="display:none;">
                                Número do operador<br /><input name="noperador" id="Opt_CXAqui_noperador" type="text" maxlength="15" /><br />
                            </div> 
                            
                            Data<br /><input name="data" type="text" maxlength="10" value="Ex: 01/01/2000" /><br />
                            Hora<br /><input name="hora" type="text" maxlength="8" value="Ex: 00:00:00" /><br />
                            Valor pago<br /><input name="valor" type="text" maxlength="10" value="R$ 0.00" /><br />
                            Pago em<br /><select name="pago_em" /><option></option><option value="Atendente">Atendente</option><option value="Auto Atendimento">Auto Atendimento</option><option value="Trans. Eletrônica">Trans. Eletrônica</option></select><br />
                            Anexo Comprovante<br /><input type="file" name="image" id="image" size="10" /> <a href="javascript:void(0);" onclick="javascript: document.getElementById('image').value = '';">[x]</a>&nbsp;<a href="javascript:void(0);" onclick="javascript:alert('Somente fotos com a extenssão JPG.');">[?]</a><br />   
                            Comentário<br /><textarea rows="5" style="width:200px" name="comment" id="comment">Máximo 200 caracters.</textarea>
                        </td>  
                    </tr>
                </table>
                <input type="submit" value="Enviar Confirmação" class="button" /> 
                </form>
                {#ResponseTpl}
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