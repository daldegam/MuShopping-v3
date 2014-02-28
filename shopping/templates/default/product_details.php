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
                	<h1 id="ProductName">{#ProductName}</h1>
					<script>
						  function refresh_price(){ 
                            var preco_final = 0;
                            var preco_item = {#NormalPriceJS};
                            var preco_level = {#LevelPrice};
                            var preco_option = {#AdcionalPrice};
                            var preco_skill = {#SkillPrice};
                            var preco_luck = {#LuckPrice};        
                            var preco_ancient = {#AncientPrice};   
                            var preco_jh = {#JhPrice};               
                            var preco_refine = {#RefinePrice};
                            var preco_socket = {#SocketPrice};
                            var preco_optionexc = {#OpExcPrice};
                            var coupon_active = {#CouponActiveJS};
                            var coupon_amount = {#CouponAmount};
                            var level_fix = {#LevelFix};
                            var level = document.getElementById('Item_Level').value;
                            var option = document.getElementById('Item_Option').value;   
                            var ancient = document.getElementById('Item_Ancient').value;     
                            var Jh = document.getElementById('Item_JH').value;     
                            if(ancient > 0) {
                                document.getElementById('Item_OpExc_1').checked = false;
                                document.getElementById('Item_OpExc_2').checked = false;
                                document.getElementById('Item_OpExc_3').checked = false;
                                document.getElementById('Item_OpExc_4').checked = false;
                                document.getElementById('Item_OpExc_5').checked = false;
                                document.getElementById('Item_OpExc_6').checked = false;
                                document.getElementById('Item_OpExc_1').disabled = "disabled";
                                document.getElementById('Item_OpExc_2').disabled = "disabled";
                                document.getElementById('Item_OpExc_3').disabled = "disabled";
                                document.getElementById('Item_OpExc_4').disabled = "disabled";
                                document.getElementById('Item_OpExc_5').disabled = "disabled";
                                document.getElementById('Item_OpExc_6').disabled = "disabled";
                                if(ancient == 1)
                                    document.getElementById('ProductName').innerHTML = '{#SetItemAnc1}';  
                                else if(ancient == 2)
                                    document.getElementById('ProductName').innerHTML = '{#SetItemAnc2}';
                                        
                                document.getElementById('ProductPhoto').src = '{#ProductPhotoAnc}';    
                            } else {
                                document.getElementById('Item_OpExc_1').disabled = {#NomeOpExc1Disabled};
                                document.getElementById('Item_OpExc_2').disabled = {#NomeOpExc2Disabled};
                                document.getElementById('Item_OpExc_3').disabled = {#NomeOpExc3Disabled};
                                document.getElementById('Item_OpExc_4').disabled = {#NomeOpExc4Disabled};
                                document.getElementById('Item_OpExc_5').disabled = {#NomeOpExc5Disabled};
                                document.getElementById('Item_OpExc_6').disabled = {#NomeOpExc6Disabled};    
                                document.getElementById('ProductName').innerHTML = '{#ProductName}';
                                document.getElementById('ProductPhoto').src = '{#ProductPhoto}';        
                            }
                            var check_max = {#MaxOptionsBuy};
                            var check_exc = 0;
                            for(i=1; i<7; i++) { 
                                 if(document.getElementById('Item_OpExc_'+i).checked == true) { check_exc++; }
                                if(check_exc > check_max) {  document.getElementById('Item_OpExc_'+i).checked = false; }
                            }
                            
                            if(level < 0) level = 0;
                            preco_final = preco_item;
                            preco_final = preco_final+(level*preco_level);
                            preco_final = preco_final+(option*preco_option);    
                            preco_final = preco_final+(Jh != 0 ? preco_jh : 0);
                            preco_final = preco_final+(ancient*preco_ancient);
                            preco_final = preco_final+(document.getElementById('Item_Skill').checked == true ? preco_skill : 0);
                            preco_final = preco_final+(document.getElementById('Item_Luck').checked == true ? preco_luck : 0);
                            preco_final = preco_final+(document.getElementById('Item_OpExc_1').checked == true ? preco_optionexc : 0);
                            preco_final = preco_final+(document.getElementById('Item_OpExc_2').checked == true ? preco_optionexc : 0);
                            preco_final = preco_final+(document.getElementById('Item_OpExc_3').checked == true ? preco_optionexc : 0);
                            preco_final = preco_final+(document.getElementById('Item_OpExc_4').checked == true ? preco_optionexc : 0);
                            preco_final = preco_final+(document.getElementById('Item_OpExc_5').checked == true ? preco_optionexc : 0); 
                            preco_final = preco_final+(document.getElementById('Item_OpExc_6').checked == true ? preco_optionexc : 0);
                            preco_final = preco_final+(document.getElementById('Item_Refine').checked == true ? preco_refine : 0);
                            
                            if(document.getElementById('Item_Socket_Slot_1').checked == true)
                            {
                                document.getElementById('Item_Socket_Slot_1_Option').disabled = "";
                                preco_final = preco_final+preco_socket;
                            }
                            else 
                                document.getElementById('Item_Socket_Slot_1_Option').disabled = "disabled";  
                            
                            if(document.getElementById('Item_Socket_Slot_2').checked == true)
                            {
                                document.getElementById('Item_Socket_Slot_2_Option').disabled = ""; 
                                preco_final = preco_final+preco_socket;
                            }
                            else
                                document.getElementById('Item_Socket_Slot_2_Option').disabled = "disabled";   
                                
                            if(document.getElementById('Item_Socket_Slot_3').checked == true)
                            {
                                document.getElementById('Item_Socket_Slot_3_Option').disabled = "";
                                preco_final = preco_final+preco_socket; 
                            }
                            else
                                document.getElementById('Item_Socket_Slot_3_Option').disabled = "disabled";   
                                
                            if(document.getElementById('Item_Socket_Slot_4').checked == true)
                            {
                                document.getElementById('Item_Socket_Slot_4_Option').disabled = ""; 
                                preco_final = preco_final+preco_socket;
                            }
                            else
                                document.getElementById('Item_Socket_Slot_4_Option').disabled = "disabled";   
                                
                            if(document.getElementById('Item_Socket_Slot_5').checked == true)
                            {
                                document.getElementById('Item_Socket_Slot_5_Option').disabled = "";
                                preco_final = preco_final+preco_socket; 
                            }
                            else
                                document.getElementById('Item_Socket_Slot_5_Option').disabled = "disabled";   
                            
                            
                            if(coupon_active == true) preco_final = Math.ceil((( preco_final  / 100 ) * (100 - coupon_amount)));
                            document.getElementById('novo_preco').innerHTML = '<strong>'+ preco_final +'</strong>';
                          }                 	</script>
                    <div class="quadros">
                    <table border="0">
                    	<tr><td rowspan="9" valign="top"><img id="ProductPhoto" src="{#ProductPhoto}" style="border:none;" /></td></tr>
                    	<tr><td>
                            <fieldset><legend>Disponível nas classes:</legend>
                               {#ClassesName}
                            </fieldset>
                        </td></tr>
                        <tr><td>
                            <fieldset><legend>Op&ccedil;&otilde;es gerais:</legend>
                               <table border="0">
                                <tr>
                                 <td><label>Level: <select name="Item_Level" id="Item_Level" onchange="javascript: refresh_price();" {#DisabledLevel}>
                                                      <option value=0>+0</option>
                                                      <option value=1>+1</option>
                                                      <option value=2>+2</option>
                                                      <option value=3>+3</option>
                                                      <option value=4>+4</option>
                                                      <option value=5>+5</option>
                                                      <option value=6>+6</option>
                                                      <option value=7>+7</option>
                                                      <option value=8>+8</option>
                                                      <option value=9>+9</option>
                                                      <option value=10>+10</option>
                                                      <option value=11>+11</option>
                                                      <option value=12>+12</option>
                                                      <option value=13>+13</option>
                                                   </select></label>
                                 </td>
                                </tr> 
                                <tr>
                                 <td><label>Adicional: <select name="Item_Option" id="Item_Option"  onchange="javascript: refresh_price();" {#DisabledAdcional}>
                                                          <option value=0>+0</option>
                                                          <option value=1>+4</option>
                                                          <option value=2>+8</option>
                                                          <option value=3>+12</option>
                                                          <option value=4>+16</option>
                                                          <option value=5>+20</option>
                                                          <option value=6>+24</option>
                                                          <option value=7>+28</option>
                                                       </select></label>
                                 </td>
                                </tr> 
                                <tr>
                                 <td><label>Ancient: <select name="Item_Ancient" id="Item_Ancient" onchange="javascript: refresh_price();" {#DisabledAncient}>
                                                        {#OptionSelectAnc}
                                                     </select></label>
                                 </td>
                                </tr> 
                                <tr>
                                 <td><label><input name='Item_Skill' id='Item_Skill' type='checkbox' value=1 onchange="javascript: refresh_price();" {#DisabledSkill} /> Skill</label>
                                 </td>
                                </tr> 
                                <tr>
                                 <td><label><input name='Item_Luck' id='Item_Luck' type='checkbox' value=1 onchange="javascript: refresh_price();" {#DisabledLuck} /> Luck</label>
                                 </td>
                                </tr>
                               </table>
                            </fieldset>
                        </td></tr>                
                    	                                       
                    	<tr><td>
                        	<fieldset><legend>Op&ccedil;&otilde;es Excelentes:</legend>
                               <table border="0">
                                <tr>
                                 <td><label><input name='Item_OpExc_1' id='Item_OpExc_1' type='checkbox' value=1 {#DisabledOpExc} onchange="javascript: refresh_price();"> {#NomeOpExc1}</label></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_OpExc_2' id='Item_OpExc_2' type='checkbox' value=1 {#DisabledOpExc} onchange="javascript: refresh_price();"> {#NomeOpExc2}</label></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_OpExc_3' id='Item_OpExc_3' type='checkbox' value=1 {#DisabledOpExc} onchange="javascript: refresh_price();"> {#NomeOpExc3}</label></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_OpExc_4' id='Item_OpExc_4' type='checkbox' value=1 {#DisabledOpExc} onchange="javascript: refresh_price();"> {#NomeOpExc4}</label></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_OpExc_5' id='Item_OpExc_5' type='checkbox' value=1 {#DisabledOpExc} onchange="javascript: refresh_price();"> {#NomeOpExc5}</label></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_OpExc_6' id='Item_OpExc_6' type='checkbox' value=1 {#DisabledOpExc} onchange="javascript: refresh_price();"> {#NomeOpExc6}</label></td>
                                </tr>
                                <tr>
                                 <td align="right">{#MaxOptText}</td>
                                </tr>
                                <tr>
                                 <td><fieldset><legend>Obs:</legend> Para o item ficar excelente, voc&ecirc; deve marcar no m&iacute;nimo uma op&ccedil;&atilde;o excelente.</fieldset></td>
                                </tr> 
                               </table>
							</fieldset>
                        </td></tr>                                                                                         
                        <tr><td>
                            <fieldset><legend>Op&ccedil;&otilde;es Harmony:</legend>
                               <table border="0">
                                <tr>
                                 <td><label>Op&ccedil;&atilde;o: <select name="Item_JH" id="Item_JH" onchange="javascript: refresh_price();" {#DisabledJH}>{#OptionSelectJH}</select></label></td>
                                </tr>
                                <tr>
                                 <td><fieldset><legend>Atenção:</legend>Essa op&ccedil;&otilde;o depende do level do item!<br />N&atilde;o nos responsabilizamos por op&ccedil;&otilde;es incorretas.</fildset></td>
                                </tr> 
                               </table>
                            </fieldset>
                        </td></tr>
                        <tr><td>
                            <fieldset><legend>Op&ccedil;&otilde;es Level 380:</legend>
                               <table border="0">
                                <tr>
                                 <td><label><input name='Item_Refine' id='Item_Refine' type='checkbox' value=1 {#DisabledRefine} onchange="javascript: refresh_price();"> {#OptionRadioRF}</label></td>
                                </tr> 
                               </table>
                            </fieldset>
                        </td></tr> 
                        <tr><td>
                            <fieldset><legend>Op&ccedil;&otilde;es Sockets:</legend>
                               <table border="0"> 
                                <tr>
                                 <td><label><input name='Item_Socket_Slot_1' id='Item_Socket_Slot_1' type='checkbox' value=1 {#DisabledSocket} onchange="javascript: refresh_price();"> Liberar Slot Socket 1</label></td>
                                </tr>
                                <tr>
                                 <td style="padding-left: 25px;"><label><select name='Item_Socket_Slot_1_Option' id='Item_Socket_Slot_1_Option' onchange="javascript: refresh_price();" disabled="disabled"> {#OptionSocketSelect1}</select></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_Socket_Slot_2' id='Item_Socket_Slot_2' type='checkbox' value=1 {#DisabledSocket} onchange="javascript: refresh_price();"> Liberar Slot Socket 2</label></td>
                                </tr>
                                <tr>
                                 <td style="padding-left: 25px;"><label><select name='Item_Socket_Slot_2_Option' id='Item_Socket_Slot_2_Option' onchange="javascript: refresh_price();" disabled="disabled"> {#OptionSocketSelect2}</select></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_Socket_Slot_3' id='Item_Socket_Slot_3' type='checkbox' value=1 {#DisabledSocket} onchange="javascript: refresh_price();"> Liberar Slot Socket 3</label></td>
                                </tr>
                                <tr>
                                 <td style="padding-left: 25px;"><label><select name='Item_Socket_Slot_3_Option' id='Item_Socket_Slot_3_Option' onchange="javascript: refresh_price();" disabled="disabled"> {#OptionSocketSelect3}</select></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_Socket_Slot_4' id='Item_Socket_Slot_4' type='checkbox' value=1 {#DisabledSocket} onchange="javascript: refresh_price();"> Liberar Slot Socket 4</label></td>
                                </tr>
                                <tr>
                                 <td style="padding-left: 25px;"><label><select name='Item_Socket_Slot_4_Option' id='Item_Socket_Slot_4_Option' onchange="javascript: refresh_price();" disabled="disabled"> {#OptionSocketSelect4}</select></td>
                                </tr>
                                <tr>
                                 <td><label><input name='Item_Socket_Slot_5' id='Item_Socket_Slot_5' type='checkbox' value=1 {#DisabledSocket} onchange="javascript: refresh_price();"> Liberar Slot Socket 5</label></td>
                                </tr> 
                                <tr>
                                 <td style="padding-left: 25px;"><label><select name='Item_Socket_Slot_5_Option' id='Item_Socket_Slot_5_Option' onchange="javascript: refresh_price();" disabled="disabled"> {#OptionSocketSelect5}</select></td>
                                </tr>
                                <tr>
                                 <td><fieldset><legend>Atenção:</legend>S&oacute; selecione as op&ccedil;&otilde;es caso voc&ecirc; saiba exatamente o que está fazendo!<br />N&atilde;o nos responsabilizamos por op&ccedil;&otilde;es incorretas.</fildset></td>
                                </tr>
                               </table>
                            </fieldset>
                        </td></tr>  
                        <tr><td>
                            <fieldset><legend>Pre&ccedil;os:</legend>
                               <table border="0">    
                                <tr>
                                 <td>Preço do item normal: <strong>{#NormalPriceJS}</strong> <?=GOLDNAME; ?></td>
                                </tr>
                                <tr>
                                 <td>Novo preço: <span id='novo_preco'><strong>{#NormalPrice}</strong></span> <?=GOLDNAME; ?></td>
                                </tr> 
                               </table>
                            </fieldset>
                        </td></tr>
                        <tr><td>
                            <fieldset><legend>Cupom de desconto:</legend>
                               <table border="0">    
                                <tr>
                                 <td>C&oacute;digo: <input type="text" id="couponCode" value="{#CouponCode}" maxlength="10" /> <input type="button" class="button" value="Ativar cupom" onclick="javascript: document.getElementById('CouponCodeDIV').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=CouponActive&amp;couponCode='+ document.getElementById('couponCode').value, 'CouponCodeDIV', 'get');" /> <div id="CouponCodeDIV" style="display:none; text-align:center;" class="qdestaques"></div>{#CouponActiveDIV}</td>
                                </tr> 
                               </table>
                            </fieldset>
                        </td></tr>            
                        <tr><td colspan="2" align="right"><input type="button" class="button" value="Prosseguir" onclick="javascript: document.getElementById('FinishBuyTD').style.display = 'block'; " /></td></tr>
                        <tr><td colspan="2"><div id="FinishBuyTD" style="display:none; text-align:center;" class="qdestaques"> <strong>Você tem certeza que deseja comprar esse item?<br />Compras não podem ser desfeitas!</strong><br /><input type="button" class="button" value="Desejo comprar e declaro aceitar os termos de uso do servidor." onclick="javascript: document.getElementById('FinishBuyTD').style.display = 'none'; document.getElementById('Result_Ajax_FinishBuy').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=FinishBuy&amp;ProductID={#ProductID}&amp;Item_Level='+ document.getElementById('Item_Level').value +'&amp;Item_Option='+ document.getElementById('Item_Option').value +'&amp;Item_Ancient='+ document.getElementById('Item_Ancient').value +'&amp;Item_Skill='+ document.getElementById('Item_Skill').checked +'&amp;Item_Luck='+ document.getElementById('Item_Luck').checked +'&amp;Item_OpExc_1='+ document.getElementById('Item_OpExc_1').checked +'&amp;Item_OpExc_2='+ document.getElementById('Item_OpExc_2').checked +'&amp;Item_OpExc_3='+ document.getElementById('Item_OpExc_3').checked +'&amp;Item_OpExc_4='+ document.getElementById('Item_OpExc_4').checked +'&amp;Item_OpExc_5='+ document.getElementById('Item_OpExc_5').checked +'&amp;Item_OpExc_6='+ document.getElementById('Item_OpExc_6').checked +'&amp;Item_JH='+ document.getElementById('Item_JH').value +'&amp;Item_Refine='+ document.getElementById('Item_Refine').checked +'&amp;Item_Socket_Slot_1='+ document.getElementById('Item_Socket_Slot_1').checked +'&amp;Item_Socket_Slot_2='+ document.getElementById('Item_Socket_Slot_2').checked +'&amp;Item_Socket_Slot_3='+ document.getElementById('Item_Socket_Slot_3').checked +'&amp;Item_Socket_Slot_4='+ document.getElementById('Item_Socket_Slot_4').checked +'&amp;Item_Socket_Slot_5='+ document.getElementById('Item_Socket_Slot_5').checked +'&amp;Item_Socket_Slot_1_Option='+ document.getElementById('Item_Socket_Slot_1_Option').value +'&amp;Item_Socket_Slot_2_Option='+ document.getElementById('Item_Socket_Slot_2_Option').value +'&amp;Item_Socket_Slot_3_Option='+ document.getElementById('Item_Socket_Slot_3_Option').value +'&amp;Item_Socket_Slot_4_Option='+ document.getElementById('Item_Socket_Slot_4_Option').value +'&amp;Item_Socket_Slot_5_Option='+ document.getElementById('Item_Socket_Slot_5_Option').value, 'Result_Ajax_FinishBuy', 'get');" /></div></td></tr>
                    </table>
					<script type="text/javascript">
						function initPage()
					  	{
							document.getElementById('Item_Level').value = {#LevelFix};					
					  	}
					    initPage();
					    refresh_price();
					</script>
                    </div>
					<div class="quadros" id="Result_Ajax_FinishBuy" style="display:none;"></div>
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