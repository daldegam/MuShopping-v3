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
                <h1>Pagamentos em andamento</h1>
                <div class="quadros">
                	<em>Total de Pedidos em andamento:</em> <strong>{#TOTAL_CONFIRMATIONS}</strong><br />
                    Paginação:
                    <input type="button" value="<<" onclick="javascript: window.location='?cmd=Payments::[InProgress]&begin=<?php echo is_numeric($_GET['begin']) && $_GET['begin'] >= 0 ? ($_GET['begin']-10) : 0; ?>';" />
                    <input type="button" value=">>" onclick="javascript: window.location='?cmd=Payments::[InProgress]&begin=<?php echo (int)($_GET['begin']+10); ?>';" />
                    <input type="button" value="Mostrar tudo" onclick="javascript: window.location='?cmd=Payments::[InProgress]&showAll=true';" />
                </div>
                {#BOX_RESULT}
                {#BOXES_CONFIRMATIONS}
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