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
<title>{#TITLE} - Administração</title>
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<!--header -->
		<div id="header"></div>
        
		<!-- menu -->	
		<div id="menu">
			<ul>
                <li id="current"><a href="?cmd=Default">Inicio</a></li>
              	<li><a href="?cmd=LogoutSystem">Logout</a></li>			   
			</ul>
		</div>					
			
		<!-- content-wrap starts here -->
		<div id="content-wrap">
				
			  <div id="sidebar">
						<h1>Sistema de administração</h1>
							<div class="left-box">
								<ul class="sidemenu">                                                             
                                    <li><a href="?cmd=Product::[Manager]">Produtos [Gerenciar]</a></li>
                                    <li><a href="?cmd=Coupons::[Manager]">Cupons [Gerenciar]</a></li>
                                    <li><a href="?cmd=Logs::[ItemsBuys]">Logs [Compra de itens]</a></li>
                                    <li><a href="?cmd=Logs::[KitsBuys]">Logs [Compra de kits]</a></li>
                                    <li><a href="?cmd=Payments::[InProgress]">Pagamentos [Andamento]</a></li>
                                    <li><a href="?cmd=Payments::[Completed]">Pagamentos [Concluidos]</a></li>
                                    <li><a href="?cmd=Payments::[Rejected]">Pagamentos [Rejeitados]</a></li>
                                    <li><a href="?cmd=Reports">Relatórios Financeiros</a></li>
                                    <li><a href="?cmd=Logins::[Manager]">Gerenciador de Logins</a></li>
                                    <li><a href="?cmd=ItemFind">Buscar Itens (Serial)</a></li> 
                                </ul>	
							</div>
					  </div>
				
			<div id="main">
                <h1>Relatórios</h1>
                <form action="?cmd=Reports&amp;Generate=true" method="post" class="quadros">
                    <em>Selecione uma data para gerar o relatório:</em><br />
                    <strong>Mês:</strong>  
                    <select name="months_one">
                        <option value="1">&nbsp;Janeiro</option>
                        <option value="2">&nbsp;Fevereiro</option>
                        <option value="3">&nbsp;Março</option>
                        <option value="4">&nbsp;Abril</option>
                        <option value="5">&nbsp;Maio</option>
                        <option value="6">&nbsp;Junho</option>
                        <option value="7">&nbsp;Julho</option>
                        <option value="8">&nbsp;Agosto</option>
                        <option value="9">&nbsp;Setembro</option>
                        <option value="10">&nbsp;Outubro</option>
                        <option value="11">&nbsp;Novembro</option>
                        <option value="12">&nbsp;Dezembro</option>
                    </select>
                    <select name="year_one">
                        <option value="2008">&nbsp;2008</option>
                        <option value="2009">&nbsp;2009</option>
                        <option value="2010">&nbsp;2010</option>
                        <option value="2011">&nbsp;2011</option> 
                        <option value="2012">&nbsp;2012</option>
                        <option value="2013">&nbsp;2013</option>
                        <option value="2014">&nbsp;2014</option>
                        <option value="2015">&nbsp;2015</option>
                        <option value="2016">&nbsp;2016</option>
                        <option value="2017">&nbsp;2017</option>
                        <option value="2018">&nbsp;2018</option>
                        <option value="2019">&nbsp;2019</option>
                    </select>
                    <strong>&nbsp; e:</strong>   
                    <select name="months_two">
                        <option value="1">&nbsp;Janeiro</option>
                        <option value="2">&nbsp;Fevereiro</option>
                        <option value="3">&nbsp;Março</option>
                        <option value="4">&nbsp;Abril</option>
                        <option value="5">&nbsp;Maio</option>
                        <option value="6">&nbsp;Junho</option>
                        <option value="7">&nbsp;Julho</option>
                        <option value="8">&nbsp;Agosto</option>
                        <option value="9">&nbsp;Setembro</option>
                        <option value="10">&nbsp;Outubro</option>
                        <option value="11">&nbsp;Novembro</option>
                        <option value="12">&nbsp;Dezembro</option>
                    </select>
                    <select name="year_two">
                        <option value="2008">&nbsp;2008</option>
                        <option value="2009">&nbsp;2009</option>
                        <option value="2010">&nbsp;2010</option>
                        <option value="2011">&nbsp;2011</option>
                        <option value="2012">&nbsp;2012</option>
                        <option value="2013">&nbsp;2013</option>
                        <option value="2014">&nbsp;2014</option>
                        <option value="2015">&nbsp;2015</option>
                        <option value="2016">&nbsp;2016</option>
                        <option value="2017">&nbsp;2017</option>
                        <option value="2018">&nbsp;2018</option>
                        <option value="2019">&nbsp;2019</option>
                    </select>
                    <input type="submit" value="Gerar relatório" class="button" />
                </form>
                {#RESULT_REPORTS}
            </div>
		
		<!-- content-wrap ends here -->	
		</div>
					
		<!--footer starts here-->
		<div id="footer">
        	<p>&copy; <? echo date("Y"); ?> <strong>{#TITLE}</strong> | Powered by Leandro Daldegam | Página gerada em: {#Time} secs. | <a href="../">[ClientSystem]</a></p>
        </div>	

<!-- wrap ends here -->
</div>


</body>
</html>