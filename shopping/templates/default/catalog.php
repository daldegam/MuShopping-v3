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
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<!--header -->
		<div id="header"></div>
        
		<!-- menu -->	
		<div id="menu">
			<ul>
                <li><a href="?cmd=Default">Inicio</a></li>
              	<li id="current"><a href="?cmd=CatalogSystem">Produtos</a></li>
              	<li><a href="?cmd=HistorySystem">Histórico</a></li>
              	<li><a href="?cmd=LogoutSystem">Logout</a></li>
              	<li><a href="../">Voltar para o site</a></li>
			   
			</ul>
		</div>					
			
		<!-- content-wrap starts here -->
		<div id="content-wrap">
				
			  <div id="sidebar">
						<h1>Bem-Vindo {#memb_name}</h1>
							<div class="left-box">
								<ul class="sidemenu">
									<li>Saldo de <strong>{#Golds_Amount}</strong> <?= GOLDNAME; ?></li>
									<li><a href="?cmd=Default">Inicio</a></li>
									<li><a href="?cmd=CatalogSystem">Ver Produtos</a></li>
									<li><a href="?cmd=HistorySystem">Histórico de compras</a></li>
									<li><a href="?cmd=ConfirmSystem">Confirmar depósitos</a></li>
									<li><a href="?cmd=RecoverLostItemSystem">Recuperar item perdido</a></li>
									<li><a href="?cmd=RecoverBrokenItemSystem">Consertar item quebrado</a></li>
									<li><a href="?cmd=AboutSystem">Sobre o shopping</a></li>	
								</ul>	
							</div>
					  </div>
				
			<div id="main">
                <h1>Produtos do shopping</h1>
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