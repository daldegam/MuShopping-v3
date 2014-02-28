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
                          }                     </script>
                    <div class="quadros">
                    <table border="0">
                        <tr><td rowspan="9" valign="top"><img id="ProductPhoto" src="{#ProductPhoto}" style="border:none;" /></td></tr>
                        <tr><td>
                            <fieldset><legend>Dispon&iacute;vel nas classes:</legend>
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
                                                      <option value=14>+14</option>
                                                      <option value=15>+15</option>
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
                                 <td><fieldset><legend>Aten&ccedil;&atilde;o:</legend>Essa op&ccedil;&otilde;o depende do level do item!<br />N&atilde;o nos responsabilizamos por op&ccedil;&otilde;es incorretas.</fildset></td>
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
                                 <td><fieldset><legend>Aten&ccedil;&atilde;o:</legend>S&oacute; selecione as op&ccedil;&otilde;es caso voc&ecirc; saiba exatamente o que est&aacute; fazendo!<br />N&atilde;o nos responsabilizamos por op&ccedil;&otilde;es incorretas.</fildset></td>
                                </tr>
                               </table>
                            </fieldset>
                        </td></tr>  
                        <tr><td>
                            <fieldset><legend>Pre&ccedil;os:</legend>
                               <table border="0">    
                                <tr>
                                 <td>Pre&ccedil;o do item normal: <strong>{#NormalPriceJS}</strong> <?=GOLDNAME; ?></td>
                                </tr>
                                <tr>
                                 <td>Novo pre&ccedil;o: <span id='novo_preco'><strong>{#NormalPrice}</strong></span> <?=GOLDNAME; ?></td>
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
                        <tr><td colspan="2"><div id="FinishBuyTD" style="display:none; text-align:center;" class="qdestaques"> <strong>Voc&ecirc; tem certeza que deseja comprar esse item?<br />Compras n&atilde;o podem ser desfeitas!</strong><br /><input type="button" class="button" value="Desejo comprar e declaro aceitar os termos de uso do servidor." onclick="javascript: document.getElementById('FinishBuyTD').style.display = 'none'; document.getElementById('Result_Ajax_FinishBuy').style.display = 'block'; Verify ('index.php?AjaxFunctions=TRUE&amp;Function=FinishBuy&amp;ProductID={#ProductID}&amp;Item_Level='+ document.getElementById('Item_Level').value +'&amp;Item_Option='+ document.getElementById('Item_Option').value +'&amp;Item_Ancient='+ document.getElementById('Item_Ancient').value +'&amp;Item_Skill='+ document.getElementById('Item_Skill').checked +'&amp;Item_Luck='+ document.getElementById('Item_Luck').checked +'&amp;Item_OpExc_1='+ document.getElementById('Item_OpExc_1').checked +'&amp;Item_OpExc_2='+ document.getElementById('Item_OpExc_2').checked +'&amp;Item_OpExc_3='+ document.getElementById('Item_OpExc_3').checked +'&amp;Item_OpExc_4='+ document.getElementById('Item_OpExc_4').checked +'&amp;Item_OpExc_5='+ document.getElementById('Item_OpExc_5').checked +'&amp;Item_OpExc_6='+ document.getElementById('Item_OpExc_6').checked +'&amp;Item_JH='+ document.getElementById('Item_JH').value +'&amp;Item_Refine='+ document.getElementById('Item_Refine').checked +'&amp;Item_Socket_Slot_1='+ document.getElementById('Item_Socket_Slot_1').checked +'&amp;Item_Socket_Slot_2='+ document.getElementById('Item_Socket_Slot_2').checked +'&amp;Item_Socket_Slot_3='+ document.getElementById('Item_Socket_Slot_3').checked +'&amp;Item_Socket_Slot_4='+ document.getElementById('Item_Socket_Slot_4').checked +'&amp;Item_Socket_Slot_5='+ document.getElementById('Item_Socket_Slot_5').checked +'&amp;Item_Socket_Slot_1_Option='+ document.getElementById('Item_Socket_Slot_1_Option').value +'&amp;Item_Socket_Slot_2_Option='+ document.getElementById('Item_Socket_Slot_2_Option').value +'&amp;Item_Socket_Slot_3_Option='+ document.getElementById('Item_Socket_Slot_3_Option').value +'&amp;Item_Socket_Slot_4_Option='+ document.getElementById('Item_Socket_Slot_4_Option').value +'&amp;Item_Socket_Slot_5_Option='+ document.getElementById('Item_Socket_Slot_5_Option').value, 'Result_Ajax_FinishBuy', 'get');" /></div></td></tr>
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