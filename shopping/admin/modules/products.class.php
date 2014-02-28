<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "products" ) == false ) {
	class products
    {
        public $memoryItems = array();
	    public function __construct()
        {                               
            switch($_GET['module'])
            {     
                case "alterProduct":
                    $this->loadItens();
                    $this->loadFormAlterProductSelect();
                    break;
                case "alterThisProduct":
                    if($_GET['alter'] == "true") return $this->loadFormAlterProductDb(); 
                    $this->loadFormAlterProductFrom($_GET['number']);
                    break;
                case "includeProduct":
                    if($_GET['include'] == "true") return $this->loadFormIncludeProductDb(); 
                    $this->loadFormIncludeProductFrom();
                    break;
                case "removeProduct":
                    $this->loadItens();
                    $this->loadFormDeleteProductSelect();
                    break;
                case "removeThisProduct":                                                  
                    $this->loadFormDeleteProductFrom($_GET['number']);
                    break;
                case "includeKits":
                    if($_GET['include'] == "true") return $this->loadIncludeKits(); 
                    $this->loadFormIncludeKits(); 
                    break;
                case "alterKits":
                    $this->loadKits();
                    $this->loadFormSelectAlterKits();
                    break;
                case "alterThisKit":
                    $this->loadFormAlterKitFrom($_GET['number']);
                    break;   
                case "removeKits":
                    $this->loadKits();
                    $this->loadFormSelectRemoveKits();
                    break;
                case "removeThisKit":
                    $this->loadFormSelectRemoveKitDb();
                    break;
                default: echo "Erro, modulo desconhecido.";  
            }                     
        }         
        private function loadItens()
        {
            global $ODBC;
            $memoryItemsQuery = $ODBC->query("SELECT Number, NAME, insertShop FROM Items ORDER BY NAME");
            while($memoryItems = odbc_fetch_object($memoryItemsQuery))
                $this->memoryItems[] = $memoryItems;
        }
        private function loadKits()
        {
            global $ODBC;
            $memoryKitsQuery = $ODBC->query("SELECT Number, kitName FROM Kits ORDER BY kitName");
            while($memoryKits = odbc_fetch_object($memoryKitsQuery))
                $this->memoryKits[] = $memoryKits;
        }
        private function loadOptionsExeNames($type)
        {
            switch($type) 
            {
                case 1:
                    $this->NomeOpExc1 = "Aumenta mana ap&oacute;s matar monstros +mana/8"; 
                    $this->NomeOpExc2 = "Aumenta vida ap&oacute;s matar monstros +vida/8"; 
                    $this->NomeOpExc3 = "Aumenta velocidade de ataque +7"; 
                    $this->NomeOpExc4 = "Adiciona dano +2%"; 
                    $this->NomeOpExc5 = "Aumenta danos +leve1/20"; 
                    $this->NomeOpExc6 = "Excelente dano ratio +10%";  
                    break;
                case 2:
                    $this->NomeOpExc1 = "Aumenta os zens que caem em +40%"; 
                    $this->NomeOpExc2 = "&Ecirc;xito rank defensivo +10%"; 
                    $this->NomeOpExc3 = "Devolve o golpe recebido +5%"; 
                    $this->NomeOpExc4 = "Golpe recebido reduzido +4%"; 
                    $this->NomeOpExc5 = "Aumenta mana em +4%"; 
                    $this->NomeOpExc6 = "Aumenta vida em +4%";   
                    break;
                case 3:
                    $this->NomeOpExc1 = "Aumenta hp"; 
                    $this->NomeOpExc2 = "Aumenta mana"; 
                    $this->NomeOpExc3 = "Poder defensivo contra oponentes de 3%"; 
                    $this->NomeOpExc4 = "Aumenta stamina"; 
                    $this->NomeOpExc5 = "Aumenta velocidade de ataque +7"; 
                    $this->NomeOpExc6 = "Sem Efeito";                      
                    break;
                case 4:
                    $this->NomeOpExc1 = "+ Ataque"; 
                    $this->NomeOpExc2 = "+ Defesa"; 
                    $this->NomeOpExc3 = "+ Illusion"; 
                    $this->NomeOpExc4 = "Sem efeito"; 
                    $this->NomeOpExc5 = "Sem efeito"; 
                    $this->NomeOpExc6 = "Sem efeito";
                    break;
                case 5:
                    $this->NomeOpExc1 = "Aumenta os zens que caem em +40%"; 
                    $this->NomeOpExc2 = "&Ecirc;xito rank defensivo +10%"; 
                    $this->NomeOpExc3 = "Devolve o golpe recebido +5%"; 
                    $this->NomeOpExc4 = "Golpe recebido reduzido +4%"; 
                    $this->NomeOpExc5 = "Aumenta mana em +4%"; 
                    $this->NomeOpExc6 = "Aumenta vida em +4%";
                    break;
                case 6:                                                                     
                    $this->NomeOpExc1 = "Aumenta mana ap&oacute;s matar monstros +mana/8"; 
                    $this->NomeOpExc2 = "Aumenta vida ap&oacute;s matar monstros +vida/8"; 
                    $this->NomeOpExc3 = "Aumenta velocidade de ataque +7"; 
                    $this->NomeOpExc4 = "Adiciona dano +2%"; 
                    $this->NomeOpExc5 = "Aumenta danos +leve1/20"; 
                    $this->NomeOpExc6 = "&Ecirc;xito rank defensivo +10%";
                    break;
                case 7:                              
                    $this->NomeOpExc1 = "Ignora o Poder Defensivo do Oponente 5%"; 
                    $this->NomeOpExc2 = "5% Chance de retornar o dano"; 
                    $this->NomeOpExc3 = "5% Chance de recuperar toda a vida"; 
                    $this->NomeOpExc4 = "5% Chance de recuperar toda a mana"; 
                    $this->NomeOpExc5 = "Sem efeito"; 
                    $this->NomeOpExc6 = "Sem efeito";
                    break;
                default:
                    $this->NomeOpExc1 = "Sem efeito"; 
                    $this->NomeOpExc2 = "Sem efeito"; 
                    $this->NomeOpExc3 = "Sem efeito"; 
                    $this->NomeOpExc4 = "Sem efeito"; 
                    $this->NomeOpExc5 = "Sem efeito"; 
                    $this->NomeOpExc6 = "Sem efeito";           
                    break;
            }
        }	
        private function loadFormAlterProductSelect()
        {
            echo "<strong>Selecione o item a ser alterado na lista abaixo:</strong><br /><select multiple style=\"width:500px; height:150px\" onchange=\"javascript: Verify('?AjaxFunctions=TRUE&Function=managerProducts&module=alterThisProduct&number='+this.options[this.selectedIndex].value, 'resultItemsAjax', 'get');\">";
            foreach($this->memoryItems as $item)
            {
                echo "<option value=\"{$item->Number}\">{$item->NAME} ". ($item->insertShop == 1 ? "[*]":"") ."</option>";    
            }   
            echo "</select><br />[*] = Dispon&iacute;vel para compras<br />";
            echo "<div id=\"resultItemsAjax\" class=\"quadros\"></div>";
        }
        private function loadFormAlterProductFrom($number)
        {
            global $ODBC;
            if(is_numeric($number) == false) exit("Erro: N&uacute;mero inv&aacute;lido");             
            
            $findDetailsItemQuery = $ODBC->query("SELECT * FROM Items WHERE Number = '{$number}'");    
            $findDetailsItem = odbc_fetch_object($findDetailsItemQuery);
            
            $findCategoriesQuery = $ODBC->query("SELECT Nombre FROM ItemsCategorias");    
            while($findCategories = odbc_fetch_object($findCategoriesQuery))
                $selectTagCategoria .= "<option value=\"{$findCategories->Nombre}\" ". ($findCategories->Nombre == $findDetailsItem->CATEGORIA ? "selected=\"selected\"":"") .">{$findCategories->Nombre}</option>";    
                                                                       
            $selectTagLevel .= "<option value=\"SN\" ". ($findDetailsItem->LVL == "SN" ? "selected=\"selected\"":"") .">N&atilde;o tem</option>";     
            $selectTagLevel .= "<option value=\"NO\" ". ($findDetailsItem->LVL == "NO" ? "selected=\"selected\"":"") .">N&atilde;o importa</option>";  
            $selectTagLevel .= "<option value=\"01\" ". ($findDetailsItem->LVL == "01" ? "selected=\"selected\"":"") .">Level +01 fixo</option>";
            $selectTagLevel .= "<option value=\"02\" ". ($findDetailsItem->LVL == "02" ? "selected=\"selected\"":"") .">Level +02 fixo</option>";
            $selectTagLevel .= "<option value=\"03\" ". ($findDetailsItem->LVL == "03" ? "selected=\"selected\"":"") .">Level +03 fixo</option>";
            $selectTagLevel .= "<option value=\"04\" ". ($findDetailsItem->LVL == "04" ? "selected=\"selected\"":"") .">Level +04 fixo</option>";
            $selectTagLevel .= "<option value=\"05\" ". ($findDetailsItem->LVL == "05" ? "selected=\"selected\"":"") .">Level +05 fixo</option>";
            $selectTagLevel .= "<option value=\"06\" ". ($findDetailsItem->LVL == "06" ? "selected=\"selected\"":"") .">Level +06 fixo</option>";
            $selectTagLevel .= "<option value=\"07\" ". ($findDetailsItem->LVL == "07" ? "selected=\"selected\"":"") .">Level +07 fixo</option>";
            $selectTagLevel .= "<option value=\"08\" ". ($findDetailsItem->LVL == "08" ? "selected=\"selected\"":"") .">Level +08 fixo</option>";
            $selectTagLevel .= "<option value=\"09\" ". ($findDetailsItem->LVL == "09" ? "selected=\"selected\"":"") .">Level +09 fixo</option>";
            $selectTagLevel .= "<option value=\"10\" ". ($findDetailsItem->LVL == "10" ? "selected=\"selected\"":"") .">Level +10 fixo</option>";
            $selectTagLevel .= "<option value=\"11\" ". ($findDetailsItem->LVL == "11" ? "selected=\"selected\"":"") .">Level +11 fixo</option>";
            $selectTagLevel .= "<option value=\"12\" ". ($findDetailsItem->LVL == "12" ? "selected=\"selected\"":"") .">Level +12 fixo</option>";
            $selectTagLevel .= "<option value=\"13\" ". ($findDetailsItem->LVL == "13" ? "selected=\"selected\"":"") .">Level +13 fixo</option>";
            $selectTagLevel .= "<option value=\"14\" ". ($findDetailsItem->LVL == "14" ? "selected=\"selected\"":"") .">Level +14 fixo</option>";
            $selectTagLevel .= "<option value=\"15\" ". ($findDetailsItem->LVL == "15" ? "selected=\"selected\"":"") .">Level +15 fixo</option>";
            
            $selectTagJh .= "<option value=\"0\" ". ($findDetailsItem->JH == 0 ? "selected=\"selected\"":"") .">N&atilde;o tem</option>";
            $selectTagJh .= "<option value=\"1\" ". ($findDetailsItem->JH == 1 ? "selected=\"selected\"":"") .">Weapons (Armas)</option>";
            $selectTagJh .= "<option value=\"2\" ". ($findDetailsItem->JH == 2 ? "selected=\"selected\"":"") .">Staffs</option>";
            $selectTagJh .= "<option value=\"3\" ". ($findDetailsItem->JH == 3 ? "selected=\"selected\"":"") .">Sets / Shields (Sets / Escudos)</option>";
                                                                                                                                           
            $selectTagExc .= "<option value=\"0\" ". ($findDetailsItem->EXE == 0 ? "selected=\"selected\"":"") .">N&atilde;o tem</option>";
            $selectTagExc .= "<option value=\"1\" ". ($findDetailsItem->EXE == 1 ? "selected=\"selected\"":"") .">Weapons (Armas)</option>";
            $selectTagExc .= "<option value=\"2\" ". ($findDetailsItem->EXE == 2 ? "selected=\"selected\"":"") .">Sets</option>";
            $selectTagExc .= "<option value=\"3\" ". ($findDetailsItem->EXE == 3 ? "selected=\"selected\"":"") .">Wings (Asas)</option>";
            $selectTagExc .= "<option value=\"4\" ". ($findDetailsItem->EXE == 4 ? "selected=\"selected\"":"") .">Fenrir</option>";
            $selectTagExc .= "<option value=\"5\" ". ($findDetailsItem->EXE == 5 ? "selected=\"selected\"":"") .">Rings (Aneis)</option>";
            $selectTagExc .= "<option value=\"6\" ". ($findDetailsItem->EXE == 6 ? "selected=\"selected\"":"") .">Pendants (Col&aacute;res)</option>";
            $selectTagExc .= "<option value=\"7\" ". ($findDetailsItem->EXE == 7 ? "selected=\"selected\"":"") .">Wings S4 (Asas Season 4)</option>";
            
            $findDetailsAncQuery = $ODBC->query("SELECT * FROM ItemsSetItems ORDER BY Nombre");
            while($findDetailsAnc = odbc_fetch_object($findDetailsAncQuery))
                $selectTagAnc .= "<option value=\"{$findDetailsAnc->Nombre}\" ". ($findDetailsItem->SetItem1 == $findDetailsAnc->Nombre ? "selected=\"selected\"":"") .">{$findDetailsAnc->Nombre}</option>";    
            
            echo "<form action=\"\" method=\"POST\" id=\"manager\" name=\"manager\">";                      
            echo "Id interno:<br />\n<input id=\"number\" name=\"number\" type=\"text\" value=\"{$findDetailsItem->Number}\" readonly=\"readonly\" /><br />\n"; 
            echo "Nome do item:<br />\n<input type=\"text\" value=\"{$findDetailsItem->NAME}\" id=\"name\" name=\"name\" /><br />\n";   
            echo "Index categoria:<br />\n<input type=\"text\" value=\"{$findDetailsItem->TP}\" id=\"tp\" name=\"tp\" /><br />\n";
            echo "Index item:<br />\n<input type=\"text\" value=\"{$findDetailsItem->ID}\" id=\"id\" name=\"id\" /><br />\n";
            echo "Nome da categoria:<br />\n<select id=\"categoria\" name=\"categoria\">{$selectTagCategoria}</select><br />\n";
            echo "Tamanho x:<br />\n<input type=\"text\" value=\"{$findDetailsItem->X}\" id=\"x\" name=\"x\" /><br />\n";
            echo "Tamanho y:<br />\n<input type=\"text\" value=\"{$findDetailsItem->Y}\" id=\"y\" name=\"y\" /><br />\n";
            echo "Durabilidade padr&atilde;o:<br />\n<input type=\"text\" value=\"{$findDetailsItem->DUR}\" id=\"dur\" name=\"dur\" /><br />\n";
            echo "Level:<br />\n<select id=\"lvl\" name=\"lvl\">{$selectTagLevel}\"</select><br />\n";
            echo "Op&ccedil;&atilde;o adicional:<br />\n<input type=\"checkbox\" value=\"1\" id=\"op\" name=\"op\" ". ($findDetailsItem->OP == 1 ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Luck:<br />\n<input type=\"checkbox\" value=\"1\" id=\"lk\" name=\"lk\" ". ($findDetailsItem->LK == 1 ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Skill:<br />\n<input type=\"checkbox\" value=\"1\" id=\"sk\" name=\"sk\" ". ($findDetailsItem->SK == 1 ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Ancient:<br />\n<input type=\"checkbox\" value=\"1\" id=\"anc\" name=\"anc\" ". ($findDetailsItem->ANC == 1 ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Op&ccedil;&atilde;o excelente:<br />\n<select id=\"exe\" name=\"exe\">{$selectTagExc}</select><br />\n";   
            echo "Maximo de op&ccedil;&otilde;es excelentes:<br />\n<input type=\"text\" value=\"{$findDetailsItem->maxOptExcSel}\" id=\"maxOptExcSel\" name=\"maxOptExcSel\" /><br />\n";
            echo "Op&ccedil;&atilde;o refine:<br />\n<input type=\"checkbox\" value=\"1\" id=\"rf\" name=\"rf\" ". ($findDetailsItem->RF == 1 ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Op&ccedil;&atilde;o harmony:<br />\n<select id=\"jh\" name=\"jh\">{$selectTagJh}\"</select><br />\n";
            echo "Op&ccedil;&atilde;o socket:<br />\n<input type=\"checkbox\" value=\"1\" id=\"socket\" name=\"socket\" ". ($findDetailsItem->Socket == 1 ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Nome do item quando ancient:<br />\n<select id=\"SetItem1\" name=\"SetItem1\">{$selectTagAnc}</select><br />\n"; 
            echo "Pre&ccedil;o do item normal:<br />\n<input type=\"text\" value=\"{$findDetailsItem->price}\" id=\"price\" name=\"price\" /><br />\n";
            echo "Pre&ccedil;o por level:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceLevel}\" id=\"priceLevel\" name=\"priceLevel\" /><br />\n";
            echo "Pre&ccedil;o por adcional:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceOption}\" id=\"priceOption\" name=\"priceOption\" /><br />\n";
            echo "Pre&ccedil;o do skill:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceSkill}\" id=\"priceSkill\" name=\"priceSkill\" /><br />\n";
            echo "Pre&ccedil;o do luck:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceLuck}\" id=\"priceLuck\" name=\"priceLuck\" /><br />\n";
            echo "Pre&ccedil;o por ancient:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceAncient}\" id=\"priceAncient\" name=\"priceAncient\" /><br />\n";
            echo "Pre&ccedil;o op&ccedil;&atilde;o harmony:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceJh}\" id=\"priceJh\" name=\"priceJh\" /><br />\n";
            echo "Pre&ccedil;o op&ccedil;&atilde;o refine:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceRefine}\" id=\"priceRefine\" name=\"priceRefine\" /><br />\n";
            echo "Pre&ccedil;o por op&ccedil;&atilde;o socket:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceSocket}\" id=\"priceSocket\" name=\"priceSocket\" /><br />\n";    
            echo "Pre&ccedil;o por op&ccedil;&atilde;o excelente:<br />\n<input type=\"text\" value=\"{$findDetailsItem->priceOptExc}\" id=\"priceOptExc\" name=\"priceOptExc\" /><br />\n";
            echo "Produto em oferta: <br />\n<input type=\"checkbox\" value=\"1\" id=\"ofert\" name=\"ofert\" ". ($findDetailsItem->ofert == 1 ? "checked=\"checked\"":"") ." /><br />\n";
            echo "Vendido N vezes: <br />\n<input type=\"text\" value=\"{$findDetailsItem->solds}\" id=\"solds\" name=\"solds\" /><br />\n";
            echo "Est&aacute; dispon&iacute;vel para compras: <br />\n<input type=\"checkbox\" value=\"1\" id=\"insertShop\" name=\"insertShop\" ". ($findDetailsItem->insertShop == 1 ? "checked=\"checked\"":"") ." /><br /><br />\n";
            echo "<strong>Classes que podem usar:</strong> <br />\n";                                                                                                  
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_0\" name=\"C_0\" ". ($findDetailsItem->C_0 == 1 ? "checked=\"checked\"":"") ." /> - <em>Dark Wizard</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_1\" name=\"C_1\" ". ($findDetailsItem->C_1 == 1 ? "checked=\"checked\"":"") ." /> - <em>Soul Master</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_2\" name=\"C_2\" ". ($findDetailsItem->C_2 == 1 ? "checked=\"checked\"":"") ." /> - <em>Grand Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_16\" name=\"C_16\" ". ($findDetailsItem->C_16 == 1 ? "checked=\"checked\"":"") ." /> - <em>Dark Knight</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_17\" name=\"C_17\" ". ($findDetailsItem->C_17 == 1 ? "checked=\"checked\"":"") ." /> - <em>Blade Knight</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_18\" name=\"C_18\" ". ($findDetailsItem->C_18 == 1 ? "checked=\"checked\"":"") ." /> - <em>Blade Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_32\" name=\"C_32\" ". ($findDetailsItem->C_32 == 1 ? "checked=\"checked\"":"") ." /> - <em>Fary Elf</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_33\" name=\"C_33\" ". ($findDetailsItem->C_33 == 1 ? "checked=\"checked\"":"") ." /> - <em>Muse Elf</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_34\" name=\"C_34\" ". ($findDetailsItem->C_34 == 1 ? "checked=\"checked\"":"") ." /> - <em>Hight Elf</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_48\" name=\"C_48\" ". ($findDetailsItem->C_48 == 1 ? "checked=\"checked\"":"") ." /> - <em>Magic Gladiator</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_49\" name=\"C_49\" ". ($findDetailsItem->C_49 == 1 ? "checked=\"checked\"":"") ." /> - <em>Duel Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_64\" name=\"C_64\" ". ($findDetailsItem->C_64 == 1 ? "checked=\"checked\"":"") ." /> - <em>Dark Lord</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_65\" name=\"C_65\" ". ($findDetailsItem->C_65 == 1 ? "checked=\"checked\"":"") ." /> - <em>Lord Emporer</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_80\" name=\"C_80\" ". ($findDetailsItem->C_80 == 1 ? "checked=\"checked\"":"") ." /> - <em>Sommoner</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_81\" name=\"C_81\" ". ($findDetailsItem->C_81 == 1 ? "checked=\"checked\"":"") ." /> - <em>Blood Summoner</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_82\" name=\"C_82\" ". ($findDetailsItem->C_82 == 1 ? "checked=\"checked\"":"") ." /> - <em>Dimension Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_96\" name=\"C_96\" ". ($findDetailsItem->C_96 == 1 ? "checked=\"checked\"":"") ." /> - <em>Rage Fighter</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_98\" name=\"C_98\" ". ($findDetailsItem->C_98 == 1 ? "checked=\"checked\"":"") ." /> - <em>Fist Master</em><br /><br />\n";
            
            echo "Endere&ccedil;o da foto normal:<br />\n<input type=\"text\" value=\"{$findDetailsItem->photoItem}\" id=\"photoItem\" name=\"photoItem\" /> <input type=\"button\" class=\"button\" value=\"Procurar / Enviar foto\" onclick=\"javascript: find_photo('?cmd=ManagerPhoto&type=common');\" /><br />\n";
            echo "Endere&ccedil;o da foto ancient:<br />\n<input type=\"text\" value=\"{$findDetailsItem->photoItemAnc}\" id=\"photoItemAnc\" name=\"photoItemAnc\" /> <input type=\"button\" class=\"button\" value=\"Procurar / Enviar foto\" onclick=\"javascript: find_photo('?cmd=ManagerPhoto&type=ancient');\" /><br />\n";
            
            echo "<input type=\"button\" class=\"button\" value=\"Salvar\" onclick=\"Verify('?AjaxFunctions=TRUE&Function=managerProducts&module=alterThisProduct&alter=true', 'resultAjax', 'POST', BuscaElementosForm('manager'));\" />";
            
            echo "</form>";
            echo "<div id=\"resultAjax\"></div>";             
        }
        private function loadFormAlterProductDb()
        {   
            //var_dump($_POST); 
            global $ODBC;               
            $this->Number       = (string)$_POST['number'];
            $this->name         = (string)$_POST['name'];
            $this->tp           = (int)$_POST['tp'];
            $this->id           = (int)$_POST['id'];
            $this->categoria    = (string)$_POST['categoria'];
            $this->x            = (int)$_POST['x'];
            $this->y            = (int)$_POST['y'];
            $this->dur          = (string)$_POST['dur'];
            $this->lvl          = (string)$_POST['lvl'];
            $this->op           = (int)$_POST['op'];
            $this->lk           = (int)$_POST['lk'];
            $this->sk           = (int)$_POST['sk'];   
            $this->anc          = (int)$_POST['anc'];
            $this->exe          = (int)$_POST['exe'];
            $this->maxOptExcSel = (int)$_POST['maxOptExcSel'];
            $this->rf           = (int)$_POST['rf'];
            $this->jh           = (int)$_POST['jh'];
            $this->socket       = (int)$_POST['socket'];
            $this->SetItem1     = (string)$_POST['SetItem1'];
            $this->price        = (int)$_POST['price'];
            $this->priceLevel   = (int)$_POST['priceLevel'];
            $this->priceOption  = (int)$_POST['priceOption'];
            $this->priceSkill   = (int)$_POST['priceSkill'];
            $this->priceLuck    = (int)$_POST['priceLuck'];
            $this->priceAncient = (int)$_POST['priceAncient'];
            $this->priceJh      = (int)$_POST['priceJh'];
            $this->priceRefine  = (int)$_POST['priceRefine'];
            $this->priceSocket  = (int)$_POST['priceSocket']; 
            $this->priceOptExc  = (int)$_POST['priceOptExc'];
            $this->ofert        = (int)$_POST['ofert'];
            $this->solds        = (int)$_POST['solds'];
            $this->insertShop   = (int)$_POST['insertShop'];
            $this->C_0          = (int)$_POST['C_0'];
            $this->C_1          = (int)$_POST['C_1'];
            $this->C_2          = (int)$_POST['C_2'];
            $this->C_16         = (int)$_POST['C_16'];
            $this->C_17         = (int)$_POST['C_17'];
            $this->C_18         = (int)$_POST['C_18'];
            $this->C_32         = (int)$_POST['C_32'];
            $this->C_33         = (int)$_POST['C_33'];
            $this->C_34         = (int)$_POST['C_34'];
            $this->C_48         = (int)$_POST['C_48'];
            $this->C_49         = (int)$_POST['C_49'];
            $this->C_64         = (int)$_POST['C_64'];
            $this->C_65         = (int)$_POST['C_65'];
            $this->C_80         = (int)$_POST['C_80'];
            $this->C_81         = (int)$_POST['C_81'];
            $this->C_82         = (int)$_POST['C_82'];
            $this->C_96         = (int)$_POST['C_96'];
            $this->C_98         = (int)$_POST['C_98'];
            $this->photoItem    = (string)$_POST['photoItem'];
            $this->photoItemAnc = (string)$_POST['photoItemAnc'];   
            
            /*
                @verificações? Nem sei ainda...
            */
            $ODBC->query("UPDATE Items SET 
                            NAME = '{$this->name}',
                            TP = {$this->tp},
                            ID = {$this->id}, 
                            CATEGORIA = '{$this->categoria}',
                            X = '{$this->x}',
                            Y = '{$this->y}',
                            DUR = '{$this->dur}',
                            LVL = '{$this->lvl}',
                            OP = {$this->op}, 
                            LK = {$this->lk},
                            SK = {$this->sk},
                            ANC = {$this->anc},
                            EXE = {$this->exe},                  
                            RF = {$this->rf},
                            JH = {$this->jh},
                            Socket = {$this->socket},
                            SetItem1 = '{$this->SetItem1}',
                            price = {$this->price},  
                            priceLevel = {$this->priceLevel},  
                            priceOption = {$this->priceOption},  
                            priceSkill = {$this->priceSkill},  
                            priceLuck = {$this->priceLuck},  
                            priceAncient = {$this->priceAncient},  
                            priceJh = {$this->priceJh},  
                            priceRefine = {$this->priceRefine},  
                            priceSocket = {$this->priceSocket},  
                            priceOptExc = {$this->priceOptExc},
                            maxOptExcSel = {$this->maxOptExcSel},  
                            ofert = {$this->ofert},  
                            solds = {$this->solds},  
                            insertShop = {$this->insertShop},  
                            C_0 = {$this->C_0},  
                            C_1 = {$this->C_1},  
                            C_2 = {$this->C_2},  
                            C_16 = {$this->C_16},  
                            C_17 = {$this->C_17},  
                            C_18 = {$this->C_18},  
                            C_32 = {$this->C_32},  
                            C_33 = {$this->C_33},  
                            C_34 = {$this->C_34},  
                            C_48 = {$this->C_48},  
                            C_49 = {$this->C_49},  
                            C_64 = {$this->C_64},  
                            C_65 = {$this->C_65},  
                            C_80 = {$this->C_80},  
                            C_81 = {$this->C_81},  
                            C_82 = {$this->C_82},  
                            C_96 = {$this->C_96},  
                            C_98 = {$this->C_98},  
                            photoItem = '{$this->photoItem}',  
                            photoItemAnc = '{$this->photoItemAnc}'
                            WHERE Number = '{$this->Number}';
                            ");
            echo "<ul><li>Produto alterado com sucesso!</li></ul>";
        }
        private function loadFormIncludeProductFrom()
        {
            global $ODBC;
            $findCategoriesQuery = $ODBC->query("SELECT Nombre FROM ItemsCategorias");    
            while($findCategories = odbc_fetch_object($findCategoriesQuery))
                $selectTagCategoria .= "<option value=\"{$findCategories->Nombre}\">{$findCategories->Nombre}</option>";    
                                                                       
            $selectTagLevel .= "<option value=\"SN\">N&atilde;o tem</option>";     
            $selectTagLevel .= "<option value=\"NO\">N&atilde;o importa</option>";  
            $selectTagLevel .= "<option value=\"01\">Level +01 fixo</option>";
            $selectTagLevel .= "<option value=\"02\">Level +02 fixo</option>";
            $selectTagLevel .= "<option value=\"03\">Level +03 fixo</option>";
            $selectTagLevel .= "<option value=\"04\">Level +04 fixo</option>";
            $selectTagLevel .= "<option value=\"05\">Level +05 fixo</option>";
            $selectTagLevel .= "<option value=\"06\">Level +06 fixo</option>";
            $selectTagLevel .= "<option value=\"07\">Level +07 fixo</option>";
            $selectTagLevel .= "<option value=\"08\">Level +08 fixo</option>";
            $selectTagLevel .= "<option value=\"09\">Level +09 fixo</option>";
            $selectTagLevel .= "<option value=\"10\">Level +10 fixo</option>";
            $selectTagLevel .= "<option value=\"11\">Level +11 fixo</option>";
            $selectTagLevel .= "<option value=\"12\">Level +12 fixo</option>";
            $selectTagLevel .= "<option value=\"13\">Level +13 fixo</option>";
            $selectTagLevel .= "<option value=\"14\">Level +14 fixo</option>";
            $selectTagLevel .= "<option value=\"15\">Level +15 fixo</option>";
            
            $selectTagJh .= "<option value=\"0\">N&atilde;o tem</option>";
            $selectTagJh .= "<option value=\"1\">Weapons (Armas)</option>";
            $selectTagJh .= "<option value=\"2\">Staffs</option>";
            $selectTagJh .= "<option value=\"3\">Sets / Shields (Sets / Escudos)</option>";
                                                                                                                                           
            $selectTagExc .= "<option value=\"0\">N&atilde;o tem</option>";
            $selectTagExc .= "<option value=\"1\">Weapons (Armas)</option>";
            $selectTagExc .= "<option value=\"2\">Sets</option>";
            $selectTagExc .= "<option value=\"3\">Wings (Asas)</option>";
            $selectTagExc .= "<option value=\"4\">Fenrir</option>";
            $selectTagExc .= "<option value=\"5\">Rings (Aneis)</option>";
            $selectTagExc .= "<option value=\"6\">Pendants (Col&aacute;res)</option>";
            $selectTagExc .= "<option value=\"7\">Wings S4 (Asas Season 4)</option>";
            
            $findDetailsAncQuery = $ODBC->query("SELECT * FROM ItemsSetItems ORDER BY Nombre");
            while($findDetailsAnc = odbc_fetch_object($findDetailsAncQuery))
                $selectTagAnc .= "<option value=\"{$findDetailsAnc->Nombre}\">{$findDetailsAnc->Nombre}</option>";    
            
            echo "<form action=\"\" method=\"POST\" id=\"manager\" name=\"manager\">";                      
            //echo "Id interno:<br />\n<input id=\"number\" name=\"number\" type=\"text\" value=\"{$findDetailsItem->Number}\" readonly=\"readonly\" /><br />\n"; 
            echo "Nome do item:<br />\n<input type=\"text\" value=\"\" id=\"name\" name=\"name\" /><br />\n";   
            echo "Index categoria:<br />\n<input type=\"text\" value=\"0\" id=\"tp\" name=\"tp\" /><br />\n";
            echo "Index item:<br />\n<input type=\"text\" value=\"0\" id=\"id\" name=\"id\" /><br />\n";
            echo "Nome da categoria:<br />\n<select id=\"categoria\" name=\"categoria\">{$selectTagCategoria}</select><br />\n";
            echo "Tamanho x:<br />\n<input type=\"text\" value=\"1\" id=\"x\" name=\"x\" /><br />\n";
            echo "Tamanho y:<br />\n<input type=\"text\" value=\"1\" id=\"y\" name=\"y\" /><br />\n";
            echo "Durabilidade padr&atilde;o:<br />\n<input type=\"text\" value=\"255\" id=\"dur\" name=\"dur\" /><br />\n";
            echo "Level:<br />\n<select id=\"lvl\" name=\"lvl\">{$selectTagLevel}\"</select><br />\n";
            echo "Op&ccedil;&atilde;o adicional:<br />\n<input type=\"checkbox\" value=\"1\" id=\"op\" name=\"op\" /><br />\n";
            echo "Luck:<br />\n<input type=\"checkbox\" value=\"1\" id=\"lk\" name=\"lk\" /><br />\n";
            echo "Skill:<br />\n<input type=\"checkbox\" value=\"1\" id=\"sk\" name=\"sk\" /><br />\n";
            echo "Ancient:<br />\n<input type=\"checkbox\" value=\"1\" id=\"anc\" name=\"anc\" /><br />\n";
            echo "Op&ccedil;&atilde;o excelente:<br />\n<select id=\"exe\" name=\"exe\">{$selectTagExc}</select><br />\n";   
            echo "Maximo de op&ccedil;&otilde;es excelentes:<br />\n<input type=\"text\" value=\"6\" id=\"maxOptExcSel\" name=\"maxOptExcSel\" /><br />\n";
            echo "Op&ccedil;&atilde;o refine:<br />\n<input type=\"checkbox\" value=\"1\" id=\"rf\" name=\"rf\" /><br />\n";
            echo "Op&ccedil;&atilde;o harmony:<br />\n<select id=\"jh\" name=\"jh\">{$selectTagJh}\"</select><br />\n";
            echo "Op&ccedil;&atilde;o socket:<br />\n<input type=\"checkbox\" value=\"1\" id=\"socket\" name=\"socket\" /><br />\n";
            echo "Nome do item quando ancient:<br />\n<select id=\"SetItem1\" name=\"SetItem1\">{$selectTagAnc}</select><br />\n"; 
            echo "Pre&ccedil;o do item normal:<br />\n<input type=\"text\" value=\"1\" id=\"price\" name=\"price\" /><br />\n";
            echo "Pre&ccedil;o por level:<br />\n<input type=\"text\" value=\"1\" id=\"priceLevel\" name=\"priceLevel\" /><br />\n";
            echo "Pre&ccedil;o por adcional:<br />\n<input type=\"text\" value=\"1\" id=\"priceOption\" name=\"priceOption\" /><br />\n";
            echo "Pre&ccedil;o do skill:<br />\n<input type=\"text\" value=\"1\" id=\"priceSkill\" name=\"priceSkill\" /><br />\n";
            echo "Pre&ccedil;o do luck:<br />\n<input type=\"text\" value=\"1\" id=\"priceLuck\" name=\"priceLuck\" /><br />\n";
            echo "Pre&ccedil;o por ancient:<br />\n<input type=\"text\" value=\"1\" id=\"priceAncient\" name=\"priceAncient\" /><br />\n";
            echo "Pre&ccedil;o op&ccedil;&atilde;o harmony:<br />\n<input type=\"text\" value=\"1\" id=\"priceJh\" name=\"priceJh\" /><br />\n";
            echo "Pre&ccedil;o op&ccedil;&atilde;o refine:<br />\n<input type=\"text\" value=\"1\" id=\"priceRefine\" name=\"priceRefine\" /><br />\n";
            echo "Pre&ccedil;o por op&ccedil;&atilde;o socket:<br />\n<input type=\"text\" value=\"1\" id=\"priceSocket\" name=\"priceSocket\" /><br />\n";    
            echo "Pre&ccedil;o por op&ccedil;&atilde;o excelente:<br />\n<input type=\"text\" value=\"1\" id=\"priceOptExc\" name=\"priceOptExc\" /><br />\n";
            echo "Produto em oferta: <br />\n<input type=\"checkbox\" value=\"1\" id=\"ofert\" name=\"ofert\" /><br />\n";
            echo "Vendido N vezes: <br />\n<input type=\"text\" value=\"0\" id=\"solds\" name=\"solds\" /><br />\n";
            echo "Est&aacute; dispon&iacute;vel para compras: <br />\n<input type=\"checkbox\" value=\"1\" id=\"insertShop\" name=\"insertShop\" /><br /><br />\n";
            echo "<strong>Classes que podem usar:</strong> <br />\n";                                                                                                  
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_0\" name=\"C_0\" /> - <em>Dark Wizard</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_1\" name=\"C_1\" /> - <em>Soul Master</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_2\" name=\"C_2\" /> - <em>Grand Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_16\" name=\"C_16\" /> - <em>Dark Knight</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_17\" name=\"C_17\" /> - <em>Blade Knight</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_18\" name=\"C_18\" /> - <em>Blade Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_32\" name=\"C_32\" /> - <em>Fary Elf</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_33\" name=\"C_33\" /> - <em>Muse Elf</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_34\" name=\"C_34\" /> - <em>Hight Elf</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_48\" name=\"C_48\" /> - <em>Magic Gladiator</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_49\" name=\"C_49\" /> - <em>Duel Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_64\" name=\"C_64\" /> - <em>Dark Lord</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_65\" name=\"C_65\" /> - <em>Lord Emporer</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_80\" name=\"C_80\" /> - <em>Sommoner</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_81\" name=\"C_81\" /> - <em>Blood Summoner</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_82\" name=\"C_82\" /> - <em>Dimension Master</em><br />\n";
            
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_96\" name=\"C_96\" /> - <em>Rage Fighter</em><br />\n";
            echo "<input type=\"checkbox\" value=\"1\" id=\"C_98\" name=\"C_98\" /> - <em>Fist Master</em><br /><br />\n";
            
            echo "Endere&ccedil;o da foto normal:<br />\n<input type=\"text\" value=\"{$findDetailsItem->photoItem}\" id=\"photoItem\" name=\"photoItem\" /> <input type=\"button\" class=\"button\" value=\"Procurar / Enviar foto\" onclick=\"javascript: find_photo('?cmd=ManagerPhoto&type=common');\" /><br />\n";
            echo "Endere&ccedil;o da foto ancient:<br />\n<input type=\"text\" value=\"{$findDetailsItem->photoItemAnc}\" id=\"photoItemAnc\" name=\"photoItemAnc\" /> <input type=\"button\" class=\"button\" value=\"Procurar / Enviar foto\" onclick=\"javascript: find_photo('?cmd=ManagerPhoto&type=ancient');\" /><br />\n";
            
            echo "<input type=\"button\" class=\"button\" value=\"Incluir\" onclick=\"Verify('?AjaxFunctions=TRUE&Function=managerProducts&module=includeProduct&include=true', 'resultAjax', 'POST', BuscaElementosForm('manager'));\" />";
            
            echo "</form>";
            echo "<div id=\"resultAjax\"></div>";             
        }
        private function loadFormIncludeProductDb()
        {
            //var_dump($_POST); 
            global $ODBC;               
            $this->name         = (string)$_POST['name'];
            $this->tp           = (int)$_POST['tp'];
            $this->id           = (int)$_POST['id'];
            $this->categoria    = (string)$_POST['categoria'];
            $this->x            = (int)$_POST['x'];
            $this->y            = (int)$_POST['y'];
            $this->dur          = (string)(strlen($_POST['dur']) == 3 ? $_POST['dur'] : (strlen($_POST['dur']) == 2 ? "0".$_POST['dur'] : (strlen($_POST['dur']) == 1 ? "00".$_POST['dur'] : "")));
            $this->lvl          = (string)$_POST['lvl'];
            $this->op           = (int)$_POST['op'];
            $this->lk           = (int)$_POST['lk'];
            $this->sk           = (int)$_POST['sk'];   
            $this->anc          = (int)$_POST['anc'];
            $this->exe          = (int)$_POST['exe'];
            $this->maxOptExcSel = (int)$_POST['maxOptExcSel'];
            $this->rf           = (int)$_POST['rf'];
            $this->jh           = (int)$_POST['jh'];
            $this->socket       = (int)$_POST['socket'];
            $this->SetItem1     = (string)$_POST['SetItem1'];
            $this->price        = (int)$_POST['price'];
            $this->priceLevel   = (int)$_POST['priceLevel'];
            $this->priceOption  = (int)$_POST['priceOption'];
            $this->priceSkill   = (int)$_POST['priceSkill'];
            $this->priceLuck    = (int)$_POST['priceLuck'];
            $this->priceAncient = (int)$_POST['priceAncient'];
            $this->priceJh      = (int)$_POST['priceJh'];
            $this->priceRefine  = (int)$_POST['priceRefine'];
            $this->priceSocket  = (int)$_POST['priceSocket']; 
            $this->priceOptExc  = (int)$_POST['priceOptExc'];
            $this->ofert        = (int)$_POST['ofert'];
            $this->solds        = (int)$_POST['solds'];
            $this->insertShop   = (int)$_POST['insertShop'];
            $this->C_0          = (int)$_POST['C_0'];
            $this->C_1          = (int)$_POST['C_1'];
            $this->C_2          = (int)$_POST['C_2'];
            $this->C_16         = (int)$_POST['C_16'];
            $this->C_17         = (int)$_POST['C_17'];
            $this->C_18         = (int)$_POST['C_18'];
            $this->C_32         = (int)$_POST['C_32'];
            $this->C_33         = (int)$_POST['C_33'];
            $this->C_34         = (int)$_POST['C_34'];
            $this->C_48         = (int)$_POST['C_48'];
            $this->C_49         = (int)$_POST['C_49'];
            $this->C_64         = (int)$_POST['C_64'];
            $this->C_65         = (int)$_POST['C_65'];
            $this->C_80         = (int)$_POST['C_80'];
            $this->C_81         = (int)$_POST['C_81'];
            $this->C_82         = (int)$_POST['C_82'];
            $this->C_96         = (int)$_POST['C_96'];
            $this->C_98         = (int)$_POST['C_98'];
            $this->photoItem    = (string)$_POST['photoItem'];
            $this->photoItemAnc = (string)$_POST['photoItemAnc'];  
            
            $this->Number       = (string)(strlen($this->tp) == 2 ? $this->tp : "0".$this->tp).(strlen($this->id) == 3 ? $this->id : (strlen($this->id) == 2 ? "0".$this->id : (strlen($this->id) == 1 ? "00".$this->id : ""))).(strlen((int)$_POST['lvl']) == 2 ? (int)$_POST['lvl'] : "0".(int)$_POST['lvl']);
                
            $searchProductQ = $ODBC->query("SELECT 1 as Result FROM Items WHERE Number = '{$this->Number}'");
            $searchProduct = odbc_fetch_array($searchProductQ);
            if($searchProduct['Result'] == "1") exit("<ul><li>Erro, esse produto j&aacute; foi cadastrado.</li></ul>");                            
            
            $ODBC->query("INSERT INTO Items 
                    (`Number`,
                    `TP`,
                    `ID`,
                    `NAME`,
                    `CATEGORIA`,
                    `X`,
                    `Y`,
                    `Z`,
                    `DUR`,
                    `LVL`,
                    `OP`,
                    `LK`,
                    `SK`,
                    `ANC`,
                    `EXE`,
                    `RF`,
                    `JH`,
                    `Socket`,
                    `SET`,
                    `SetItem1`,
                    `SetItem2`,
                    `price`,
                    `priceLevel`,
                    `priceOption`,
                    `priceSkill`,
                    `priceLuck`,
                    `priceAncient`,
                    `priceJh`,
                    `priceRefine`,
                    `priceSocket`,
                    `priceOptExc`,
                    `maxOptExcSel`,
                    `ofert`,
                    `solds`,
                    `insertShop`,
                    `C_0`,
                    `C_1`,
                    `C_2`,
                    `C_16`,
                    `C_17`,
                    `C_18`,
                    `C_32`,
                    `C_33`,
                    `C_34`,
                    `C_48`,
                    `C_49`,
                    `C_64`,
                    `C_65`,
                    `C_80`,
                    `C_81`,
                    `C_82`,
                    `C_96`,
                    `C_98`,
                    `photoItem`,
                    `photoItemAnc`
                    )
                    VALUES
                    (    
                    '{$this->Number}',
                    {$this->tp},
                    {$this->id},
                    '{$this->name}',
                    '{$this->categoria}',
                    '{$this->x}',
                    '{$this->y}',
                    0,
                    '{$this->dur}',
                    '{$this->lvl}',
                    {$this->op},
                    {$this->lk},
                    {$this->sk},
                    {$this->anc},
                    {$this->exe},
                    {$this->rf},
                    {$this->jh},
                    {$this->socket},
                    '0',
                    '{$this->SetItem1}',
                    'NO',
                    {$this->price},
                    {$this->priceLevel},
                    {$this->priceOption},
                    {$this->priceSkill},
                    {$this->priceLuck},
                    {$this->priceAncient},
                    {$this->priceJh},
                    {$this->priceRefine},
                    {$this->priceSocket},
                    {$this->priceOptExc},
                    {$this->maxOptExcSel},
                    {$this->ofert},
                    {$this->solds},
                    {$this->insertShop},
                    {$this->C_0},
                    {$this->C_1},
                    {$this->C_2},
                    {$this->C_16},
                    {$this->C_17},
                    {$this->C_18},
                    {$this->C_32},
                    {$this->C_33},
                    {$this->C_34},
                    {$this->C_48},
                    {$this->C_49},
                    {$this->C_64},
                    {$this->C_65},
                    {$this->C_80},
                    {$this->C_81},
                    {$this->C_82},
                    {$this->C_96},
                    {$this->C_98},
                    '{$this->photoItem}',
                    '{$this->photoItemAnc}'
                    );
                    "); 
            echo "<ul><li>Produto cadastrado com sucesso!</li></ul>";         
        }
        private function loadFormDeleteProductSelect()
        {
            echo "<strong>Selecione o item a ser <strong style=\"color: #FF0000;\">deletado</strong> na lista abaixo:</strong><br /><select multiple style=\"width:500px; height:150px\" id=\"productsList\">";
            foreach($this->memoryItems as $item)
            {
                echo "<option value=\"{$item->Number}\">{$item->NAME}</option>";    
            }   
            echo "</select>";
            echo "<div class=\"qdestaques\">Aten&ccedil;&atilde;o, ao remover um item do shopping, o hist&oacute;rico de compras dos players podem aprensentar problemas caso j&aacute; tenham realizado alguma compra.</div>";
            echo "<input type=\"button\" class=\"button\" value=\"Deletar item selecionado\" onclick=\"javascript: Verify('?AjaxFunctions=TRUE&Function=managerProducts&module=removeThisProduct&number='+document.getElementById('productsList').value, 'resultItemsAjax', 'get');\" />";
            echo "<div id=\"resultItemsAjax\" class=\"quadros\"></div>";
        }
        private function loadFormDeleteProductFrom()
        {
            global $ODBC;
            if($ODBC->query("DELETE FROM Items WHERE Number='{$_GET['number']}'") == false)
                echo "<ul><li>Erro ao deletar o item.</li></ul>";
            else
                echo "<ul><li>Item deletado com sucesso!</li></ul>";   
        } 
        private function loadFormIncludeKits()
        {
            echo "<form action=\"\" method=\"POST\" id=\"manager\" name=\"manager\">";                      
            echo "Nome do kit:<br />\n<input type=\"text\" value=\"\" id=\"kitName\" name=\"kitName\" /><br />\n";   
            echo "Pre&ccedil;o fixo:<br />\n<input type=\"text\" value=\"0\" id=\"priceFix\" name=\"priceFix\" /><br />\n";
            echo "Vendas iniciais:<br />\n<input type=\"text\" value=\"0\" id=\"solds\" name=\"solds\" /><br />\n";
            echo "Habilitar vendas:<br />\n<input type=\"checkbox\" value=\"1\" id=\"active\" name=\"active\" /><br />\n";
            echo "<input type=\"button\" class=\"button\" value=\"Incluir\" onclick=\"Verify('?AjaxFunctions=TRUE&Function=managerProducts&module=includeKits&include=true', 'resultAjax', 'POST', BuscaElementosForm('manager'));\" />";
            echo "</form>";
            echo "<div id=\"resultAjax\"></div>";
        }
        private function loadIncludeKits()
        {
            global $ODBC;                      
            $active = (int) $_POST['active'];
            $priceFix = (int) $_POST['priceFix'];
            $solds = (int) $_POST['solds'];
            if(empty($_POST['kitName']) == true) exit("<ul><li>Preencha o nome do kit.</li></ul>");
            
            $findLastNumberQuery = $ODBC->query("SELECT Number FROM Kits ORDER BY Number DESC");
            $findLastNumber = odbc_fetch_object($findLastNumberQuery);
            $this->lastKitNumber = (int)$findLastNumber->Number + 1;
            
            if($ODBC->query("INSERT INTO Kits (`Number`, `kitName`, `priceFix`, `solds`, `active`) VALUES ({$this->lastKitNumber}, '{$_POST['kitName']}', {$priceFix}, {$solds}, {$active});") == true)
                echo "<ul><li>Kit <strong>{$_POST['kitName']}</strong> cadastrado com sucesso.</li></ul>";    
            else
                echo "<ul><li>Erro ao cadastrar Kit.</li></ul>";    
        }
        private function loadFormSelectAlterKits()
        {
            echo "<strong>Selecione o kit a ser alterado na lista abaixo:</strong><br /><select multiple style=\"width:500px; height:150px\" onchange=\"javascript: Verify('?AjaxFunctions=TRUE&Function=managerProducts&module=alterThisKit&number='+this.options[this.selectedIndex].value, 'resultItemsAjax', 'get');\">";
            foreach($this->memoryKits as $kit)
            {
                echo "<option value=\"{$kit->Number}\">{$kit->kitName}</option>";    
            }   
            echo "</select>";
            echo "<div id=\"resultItemsAjax\" class=\"quadros\"></div>"; 
        }
        private function loadFormAlterKitFrom($number)
        {
            global $ODBC;
            if(is_numeric($number) == false) exit("Erro: N&uacute;mero inv&aacute;lido"); 
            if(isset($_GET['action']) == false)
            {
                echo "<input value=\"Adicionar item\" type=\"button\" class=\"button\" onclick=\"Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&number={$number}&action=includeItemSelect', 'resultItemsAjaxKitsResult', 'GET');\" />";
                echo "<input value=\"Alterar item\" type=\"button\" class=\"button\" onclick=\"Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&number={$number}&action=alterItemSelect', 'resultItemsAjaxKitsResult', 'GET');\" />";
                echo "<input value=\"Remover item\" type=\"button\" class=\"button\" onclick=\"Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&number={$number}&action=removeItemSelect', 'resultItemsAjaxKitsResult', 'GET');\" />";
                echo "<input value=\"Ativar / Desativar vendas\" type=\"button\" class=\"button\" onclick=\"Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&number={$number}&action=activeDesactiveSolds', 'resultItemsAjaxKitsResult', 'GET');\" />";
                echo "<div id=\"resultItemsAjaxKitsResult\"></div>";
            }
            else
            {
                $findKitDetailsQuery = $ODBC->query("SELECT kitName FROM Kits WHERE Number = ". $number);
                $findKitDetails = odbc_fetch_object($findKitDetailsQuery);
                
                switch($_GET['action'])
                {
                    case "includeItemSelect":
                        echo "Selecione o item a incluir no kit <strong>{$findKitDetails->kitName}</strong>";
                        $this->loadItens();
                        echo "<select multiple style=\"width:500px; height:150px\" onchange=\"javascript: Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&action=includeItemForm&number={$number}&itemNumber='+this.options[this.selectedIndex].value, 'resultItemsAjaxKitsResult', 'get');\">";
                            foreach($this->memoryItems as $item)
                            {
                                echo "<option value=\"{$item->Number}\">{$item->NAME}</option>";    
                            }   
                        echo "</select>";                          
                        break; 
                    case "includeItemForm":
                        $checkItemIncludeQuery = $ODBC->query("SELECT itemNumber FROM KitsItemsDetails WHERE kitNumber = {$number} AND itemNumber='{$_GET['itemNumber']}'");
                        $checkItemInclude = odbc_fetch_object($checkItemIncludeQuery);
                        if($checkItemInclude->itemNumber == $_GET['itemNumber']) exit("<ul><li>Erro, esse item j&aacute; foi cadastrado nesse kit.</li></ul>");
                        
                        $findItemDetailsQuery = $ODBC->query("SELECT * FROM Items WHERE Number = '{$_GET['itemNumber']}'");
                        $findItemDetails = odbc_fetch_object($findItemDetailsQuery);
                        
                        $this->loadOptionsExeNames($findItemDetails->EXE);     
                                                                                               
                        $selectTagLevel .= "<option value=\"00\">Level +00 Fixo</option>";  
                        $selectTagLevel .= "<option value=\"01\">Level +01 fixo</option>";
                        $selectTagLevel .= "<option value=\"02\">Level +02 fixo</option>";
                        $selectTagLevel .= "<option value=\"03\">Level +03 fixo</option>";
                        $selectTagLevel .= "<option value=\"04\">Level +04 fixo</option>";
                        $selectTagLevel .= "<option value=\"05\">Level +05 fixo</option>";
                        $selectTagLevel .= "<option value=\"06\">Level +06 fixo</option>";
                        $selectTagLevel .= "<option value=\"07\">Level +07 fixo</option>";
                        $selectTagLevel .= "<option value=\"08\">Level +08 fixo</option>";
                        $selectTagLevel .= "<option value=\"09\">Level +09 fixo</option>";
                        $selectTagLevel .= "<option value=\"10\">Level +10 fixo</option>";
                        $selectTagLevel .= "<option value=\"11\">Level +11 fixo</option>";
                        $selectTagLevel .= "<option value=\"12\">Level +12 fixo</option>";
                        $selectTagLevel .= "<option value=\"13\">Level +13 fixo</option>";
                        $selectTagLevel .= "<option value=\"14\">Level +14 fixo</option>";
                        $selectTagLevel .= "<option value=\"15\">Level +15 fixo</option>";
                        
                        $selectTagOpt .= "<option value=\"0\">Option +0 fixo</option>";
                        $selectTagOpt .= "<option value=\"1\">Option +4 fixo</option>";    
                        $selectTagOpt .= "<option value=\"2\">Option +8 fixo</option>";    
                        $selectTagOpt .= "<option value=\"3\">Option +12 fixo</option>";    
                        $selectTagOpt .= "<option value=\"4\">Option +16 fixo</option>";    
                        $selectTagOpt .= "<option value=\"5\">Option +20 fixo</option>";    
                        $selectTagOpt .= "<option value=\"6\">Option +24 fixo</option>";    
                        $selectTagOpt .= "<option value=\"7\">Option +28 fixo</option>";
                        
                        $selectTagAnc .= "<option value=\"0\">N&atilde;o tem</option>";
                        $selectTagAnc .= "<option value=\"1\">+5 Stamina</option>";
                        $selectTagAnc .= "<option value=\"2\">+10 Stamina</option>";
                        
                        if($findItemDetails->JH == 0)
                            $selectTagJh .= "<option value='00'>Nenhuma</option>";
                        else
                        {
                            $selectTagJh .= "<option value='00'>Nenhuma</option>";
                            $SelectOptionsJhQ = $ODBC->query("SELECT * FROM ItemsJewelOfHarmony WHERE TP = '{$findItemDetails->JH}' ORDER BY [Number]");
                            while($SelectOptionsJh = odbc_fetch_array($SelectOptionsJhQ))
                            {
                                if(substr($SelectOptionsJh['NM'],0 ,8) == "NONE JoH") continue;  
                                for($iJh = 0; $iJh < 15; $iJh++)
                                {         
                                    $indexJh = strtoupper(dechex($iJh)); 
                                    if($this->isZeroOptionJh == true && $SelectOptionsJh['prefx'.$indexJh] == 0) continue;             
                                    if($SelectOptionsJh['prefx'.$indexJh] == 0) $this->isZeroOptionJh = true;
                                    $selectTagJh .= "<option value='{$SelectOptionsJh['ID']}{$indexJh}'>{$SelectOptionsJh['NM']} ". $SelectOptionsJh['prefx'.$indexJh] ." </option>\n";
                                }                                                                          
                            } 
                        }
                        
                        if($findItemDetails->RF == 0)
                            $selectTagRefine .= "<option value=\"0\">Nenhuma</option>";   
                        else
                        {
                            $SelectOptionRefineQ = $ODBC->query("SELECT prefx1, prefx2 FROM ItemsRefinery WHERE ID={$findItemDetails->RF}");
                            $SelectOptionRefine = odbc_fetch_object($SelectOptionRefineQ);  
                            $selectTagRefine .= "<option value=\"0\">Nenhuma</option><option value=\"1\">{$SelectOptionRefine->prefx1}, {$SelectOptionRefine->prefx2}";    
                        }
                        require("../modules/sockets.lib.php");
                        if($findItemDetails->Socket == 0)
                        {                                                                                                
                            $selectTagSocket1 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket2 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket3 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket4 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket5 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                        }   
                        else
                        {
                            switch($findItemDetails->CATEGORIA)
                            {   //None: -1, Fire: 1, Water: 2, Ice: 3, Wind: 4, Lightning: 5, Ground/Earth: 6          
                                case "Amulets": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Armors": 
                                    $typesSockets = array("2", "4", "6"); 
                                    break;  
                                case "Axes":                         
                                    $typesSockets = array("1", "3", "5");
                                    break;  
                                case "Boots":                                       
                                    $typesSockets = array("2", "4", "6"); 
                                    break;  
                                case "Bows":                          
                                    $typesSockets = array("1", "3", "5");
                                    break;  
                                case "Castel Siege": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "CrossBows":                       
                                    $typesSockets = array("1", "3", "5");
                                    break;  
                                case "Events": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Events MIX": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Gifts/Boxs": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Gloves":                                        
                                    $typesSockets = array("2", "4", "6"); 
                                    break;  
                                case "Guards/Pets": 
                                    $typesSockets = array("-1");
                                    break;   
                                case "Helms":                                      
                                    $typesSockets = array("2", "4", "6"); 
                                    break;    
                                case "Jewels": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Jewels MIX": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Maces":                         
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Mix Items": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Mix Pets": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "New/Test": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Orbs": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Other Items": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Pants":                                       
                                    $typesSockets = array("2", "4", "6"); 
                                    break;    
                                case "Pendants": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Potions": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Quests": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Rings": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Scepters":                       
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Scrolls": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Shields":                                  
                                    $typesSockets = array("2", "4", "6"); 
                                    break;    
                                case "Spears":                         
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Staffs":                        
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Swords":                       
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Wings":                      
                                    $typesSockets = array("-1"); 
                                    break;  
                                default:
                                    $typesSockets = array("-1");                       
                            }
                            if($typesSockets[0] == "-1")   
                            {                                                                                  
                                $selectTagSocket1 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket2 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket3 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket4 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket5 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            }
                            else
                            {
                                for($iSocketCount = 0, $iSocketIncrement = count($typesSockets); $iSocketCount < $iSocketIncrement; $iSocketCount++)
                                {   
                                    foreach($socketLib['socketTypeNumber'][$typesSockets[$iSocketCount]] as $key => $socket)
                                    {
                                        $this->selectOptionsSocketItemTmp[0] .= "<option value=\"". (int)($key) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][1]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[1] .= "<option value=\"". (int)($key+50) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][2]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[2] .= "<option value=\"". (int)($key+100) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][3]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[3] .= "<option value=\"". (int)($key+150) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][5]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[4] .= "<option value=\"". (int)($key+200) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][5]})</option>\n";
                                    }
                                }
                    
                                /*for($iSocketCount = 0, $iSocketIncrement = count($typesSockets); $iSocketCount < $iSocketIncrement; $iSocketCount++)
                                {
                                    $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, ID, S1, S2, S3, S4, S5 FROM ItemsSocket WHERE TP = ".$typesSockets[$iSocketCount]);
                                    while($SelectOptionsSocket = odbc_fetch_array($SelectOptionsSocketQ))
                                    {                                                                      
                                        $this->selectOptionsSocketItemTmp[0] .= "<option value=\"". ($SelectOptionsSocket['ID']) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S1']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[1] .= "<option value=\"". ($SelectOptionsSocket['ID']+50) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S2']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[2] .= "<option value=\"". ($SelectOptionsSocket['ID']+100) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S3']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[3] .= "<option value=\"". ($SelectOptionsSocket['ID']+150) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S4']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[4] .= "<option value=\"". ($SelectOptionsSocket['ID']+200) ."\">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S5']})</option>\n";
                                    }
                                }*/                                                                                        
                                $selectTagSocket1 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[0]; 
                                $selectTagSocket2 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[1]; 
                                $selectTagSocket3 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[2]; 
                                $selectTagSocket4 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[3]; 
                                $selectTagSocket5 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[4]; 
                            }  
                        } 

                        echo "<form action=\"\" method=\"POST\" id=\"manager\" name=\"manager\">";                                                      
                        echo "Nome do item a incluir:<br />\n<strong>{$findItemDetails->NAME}</strong><br />\n";               
                        echo "Level fixo:<br />\n<select name=\"fixLevel\" id=\"fixLevel\">{$selectTagLevel}</select><br />\n";
                        echo "Option fixo:<br />\n<select name=\"fixOP\" id=\"fixOP\">{$selectTagOpt}</select><br />\n";
                        echo "Luck fixo:<br />\n<input type=\"checkbox\" value=\"1\" id=\"fixLuck\" name=\"fixLuck\" /><br />\n";
                        echo "Skill fixo:<br />\n<input type=\"checkbox\" value=\"1\" id=\"fixSkill\" name=\"fixSkill\" /><br />\n";
                        echo "Ancient fixo:<br />\n<select name=\"fixANC\" id=\"fixANC\">{$selectTagAnc}</select><br />\n";
                        
                        echo "<fieldset><legend>Op&ccedil;&otilde;es excelentes:</legend>";
                        echo "<input name=\"fixOpEx1\" id=\"fixOpEx1\" type=\"checkbox\" value=\"1\"> {$this->NomeOpExc1}<br />\n";
                        echo "<input name=\"fixOpEx2\" id=\"fixOpEx2\" type=\"checkbox\" value=\"1\"> {$this->NomeOpExc2}<br />\n";
                        echo "<input name=\"fixOpEx3\" id=\"fixOpEx3\" type=\"checkbox\" value=\"1\"> {$this->NomeOpExc3}<br />\n";
                        echo "<input name=\"fixOpEx4\" id=\"fixOpEx4\" type=\"checkbox\" value=\"1\"> {$this->NomeOpExc4}<br />\n";
                        echo "<input name=\"fixOpEx5\" id=\"fixOpEx5\" type=\"checkbox\" value=\"1\"> {$this->NomeOpExc5}<br />\n";
                        echo "<input name=\"fixOpEx6\" id=\"fixOpEx6\" type=\"checkbox\" value=\"1\"> {$this->NomeOpExc6}";
                        echo "</fieldset>";
                        
                        echo "Option harmony fixo:<br />\n<select name=\"fixJH\" id=\"fixJH\">{$selectTagJh}</select><br />\n";
                        echo "Option refine fixo:<br />\n<select name=\"fixRefine\" id=\"fixRefine\">{$selectTagRefine}</select><br />\n";
                        
                        echo "<fieldset><legend>Op&ccedil;&otilde;es sockets:</legend>";
                        echo "<select name=\"fixSocket1\" id=\"fixSocket1\"> {$selectTagSocket1}</select><br />\n";
                        echo "<select name=\"fixSocket2\" id=\"fixSocket2\"> {$selectTagSocket2}</select><br />\n";
                        echo "<select name=\"fixSocket3\" id=\"fixSocket3\"> {$selectTagSocket3}</select><br />\n";
                        echo "<select name=\"fixSocket4\" id=\"fixSocket4\"> {$selectTagSocket4}</select><br />\n";
                        echo "<select name=\"fixSocket5\" id=\"fixSocket5\"> {$selectTagSocket5}</select>";
                        echo "</fieldset>";
                        
                        echo "<input type=\"button\" class=\"button\" value=\"Incluir item no kit\" onclick=\"Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&action=includeItemDb&number={$number}&itemNumber={$_GET['itemNumber']}', 'resultItemsAjaxKitsSubResult', 'POST', BuscaElementosForm('manager'));\" />";
            
                        echo "</form>";
                        echo "<div id=\"resultItemsAjaxKitsSubResult\"></div>";                        
                        break;
                    case "includeItemDb":
                        $number =       (int)$_GET['number'];
                        $itemNumber =   (string)$_GET['itemNumber'];
                        $fixLevel =     (string)$_POST['fixLevel'];
                        $fixOP =        (int)$_POST['fixOP'];
                        $fixLuck =      (int)$_POST['fixLuck'];
                        $fixSkill =     (int)$_POST['fixSkill'];
                        $fixANC =       (int)$_POST['fixANC'];    
                        $fixOpEx1 =     (int)$_POST['fixOpEx1'];
                        $fixOpEx2 =     (int)$_POST['fixOpEx2'];
                        $fixOpEx3 =     (int)$_POST['fixOpEx3'];
                        $fixOpEx4 =     (int)$_POST['fixOpEx4'];
                        $fixOpEx5 =     (int)$_POST['fixOpEx5'];
                        $fixOpEx6 =     (int)$_POST['fixOpEx6'];
                        $fixJH =        (string)$_POST['fixJH'];
                        $fixRefine =    (int)$_POST['fixRefine'];  
                        $fixSocket1 =   (int)$_POST['fixSocket1'];
                        $fixSocket2 =   (int)$_POST['fixSocket2'];
                        $fixSocket3 =   (int)$_POST['fixSocket3'];
                        $fixSocket4 =   (int)$_POST['fixSocket4'];
                        $fixSocket5 =   (int)$_POST['fixSocket5'];
                        
                        if($ODBC->query("INSERT INTO KitsItemsDetails 
                                        (`kitNumber`,`itemNumber`,`fixLVL`,`fixOP`,`fixLuck`,`fixSkill`,`fixANC`,`fixOpEx1`,`fixOpEx2`,`fixOpEx3`,`fixOpEx4`,`fixOpEx5`,`fixOpEx6`,`fixJH`,`fixRefine`,`fixSocket1`,`fixSocket2`,`fixSocket3`,`fixSocket4`,`fixSocket5`) 
                                        VALUES ({$number}, '{$itemNumber}', {$fixLevel}, {$fixOP}, {$fixLuck}, {$fixSkill}, {$fixANC}, {$fixOpEx1}, {$fixOpEx2}, {$fixOpEx3}, {$fixOpEx4}, {$fixOpEx5}, {$fixOpEx6}, '{$fixJH}', {$fixRefine}, {$fixSocket1}, {$fixSocket2}, {$fixSocket3}, {$fixSocket4}, {$fixSocket5});
                                     ") == false) echo "<ul><li>Erro ao adicionar item. Favor tentar novamente.</li></ul>";
                        else echo "<ul><li>Item adicionado com sucesso!.</li></ul>";
                        break;
                    case "alterItemSelect":
                        echo "Selecione o item que deseja altera em <strong>{$findKitDetails->kitName}</strong>";
                        echo "<select multiple style=\"width:500px; height:150px\" onchange=\"javascript: Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&action=alterItemForm&number={$number}&itemNumber='+this.options[this.selectedIndex].value, 'resultItemsAjaxKitsResult', 'get');\">";
                        $findItensInKitQuery = $ODBC->query("SELECT itemNumber FROM KitsItemsDetails WHERE kitNumber = ". $number);
                        while($findItensInKit = odbc_fetch_object($findItensInKitQuery))
                        {
                                $findItemKitDetailsQuery = $ODBC->query("SELECT NAME FROM Items WHERE Number='{$findItensInKit->itemNumber}'");
                                $findItemKitDetails = odbc_fetch_object($findItemKitDetailsQuery);
                                echo "<option value=\"{$findItensInKit->itemNumber}\">{$findItemKitDetails->NAME}</option>";    
                        }   
                        echo "</select>";                          
                        break;
                    case "alterItemForm":
                        $checkItemDetailsKitQuery = $ODBC->query("SELECT * FROM KitsItemsDetails WHERE kitNumber = {$number} AND itemNumber='{$_GET['itemNumber']}'");
                        $checkItemDetailsKit = odbc_fetch_object($checkItemDetailsKitQuery);
                        if($checkItemDetailsKit->itemNumber != $_GET['itemNumber']) exit("<ul><li>Erro, esse item n&aatilde; foi cadastrado nesse kit.</li></ul>");
                        
                        $findItemDetailsQuery = $ODBC->query("SELECT * FROM Items WHERE Number = '{$_GET['itemNumber']}'");
                        $findItemDetails = odbc_fetch_object($findItemDetailsQuery);
                                                     
                        $this->loadOptionsExeNames($findItemDetails->EXE);     
                        
                        $selectTagLevel .= "<option value=\"00\" ". ($checkItemDetailsKit->fixLVL == "0" ? "selected = \"selected\"":"") .">Level +00 fixo</option>";  
                        $selectTagLevel .= "<option value=\"01\" ". ($checkItemDetailsKit->fixLVL == "1" ? "selected = \"selected\"":"") .">Level +01 fixo</option>";
                        $selectTagLevel .= "<option value=\"02\" ". ($checkItemDetailsKit->fixLVL == "2" ? "selected = \"selected\"":"") .">Level +02 fixo</option>";
                        $selectTagLevel .= "<option value=\"03\" ". ($checkItemDetailsKit->fixLVL == "3" ? "selected = \"selected\"":"") .">Level +03 fixo</option>";
                        $selectTagLevel .= "<option value=\"04\" ". ($checkItemDetailsKit->fixLVL == "4" ? "selected = \"selected\"":"") .">Level +04 fixo</option>";
                        $selectTagLevel .= "<option value=\"05\" ". ($checkItemDetailsKit->fixLVL == "5" ? "selected = \"selected\"":"") .">Level +05 fixo</option>";
                        $selectTagLevel .= "<option value=\"06\" ". ($checkItemDetailsKit->fixLVL == "6" ? "selected = \"selected\"":"") .">Level +06 fixo</option>";
                        $selectTagLevel .= "<option value=\"07\" ". ($checkItemDetailsKit->fixLVL == "7" ? "selected = \"selected\"":"") .">Level +07 fixo</option>";
                        $selectTagLevel .= "<option value=\"08\" ". ($checkItemDetailsKit->fixLVL == "8" ? "selected = \"selected\"":"") .">Level +08 fixo</option>";
                        $selectTagLevel .= "<option value=\"09\" ". ($checkItemDetailsKit->fixLVL == "9" ? "selected = \"selected\"":"") .">Level +09 fixo</option>";
                        $selectTagLevel .= "<option value=\"10\" ". ($checkItemDetailsKit->fixLVL == "10" ? "selected = \"selected\"":"") .">Level +10 fixo</option>";
                        $selectTagLevel .= "<option value=\"11\" ". ($checkItemDetailsKit->fixLVL == "11" ? "selected = \"selected\"":"") .">Level +11 fixo</option>";
                        $selectTagLevel .= "<option value=\"12\" ". ($checkItemDetailsKit->fixLVL == "12" ? "selected = \"selected\"":"") .">Level +12 fixo</option>";
                        $selectTagLevel .= "<option value=\"13\" ". ($checkItemDetailsKit->fixLVL == "13" ? "selected = \"selected\"":"") .">Level +13 fixo</option>";
                        $selectTagLevel .= "<option value=\"14\" ". ($checkItemDetailsKit->fixLVL == "14" ? "selected = \"selected\"":"") .">Level +14 fixo</option>";
                        $selectTagLevel .= "<option value=\"15\" ". ($checkItemDetailsKit->fixLVL == "15" ? "selected = \"selected\"":"") .">Level +15 fixo</option>";
                        
                        $selectTagOpt .= "<option value=\"0\" ". ($checkItemDetailsKit->fixOP == "0" ? "selected = \"selected\"":"") .">Option +0 fixo</option>";
                        $selectTagOpt .= "<option value=\"1\" ". ($checkItemDetailsKit->fixOP == "1" ? "selected = \"selected\"":"") .">Option +4 fixo</option>";    
                        $selectTagOpt .= "<option value=\"2\" ". ($checkItemDetailsKit->fixOP == "2" ? "selected = \"selected\"":"") .">Option +8 fixo</option>";    
                        $selectTagOpt .= "<option value=\"3\" ". ($checkItemDetailsKit->fixOP == "3" ? "selected = \"selected\"":"") .">Option +12 fixo</option>";    
                        $selectTagOpt .= "<option value=\"4\" ". ($checkItemDetailsKit->fixOP == "4" ? "selected = \"selected\"":"") .">Option +16 fixo</option>";    
                        $selectTagOpt .= "<option value=\"5\" ". ($checkItemDetailsKit->fixOP == "5" ? "selected = \"selected\"":"") .">Option +20 fixo</option>";    
                        $selectTagOpt .= "<option value=\"6\" ". ($checkItemDetailsKit->fixOP == "6" ? "selected = \"selected\"":"") .">Option +24 fixo</option>";    
                        $selectTagOpt .= "<option value=\"7\" ". ($checkItemDetailsKit->fixOP == "7" ? "selected = \"selected\"":"") .">Option +28 fixo</option>";
                        
                        $selectTagAnc .= "<option value=\"0\" ". ($checkItemDetailsKit->fixANC == "0" ? "selected = \"selected\"":"") .">N&atilde;o tem</option>";
                        $selectTagAnc .= "<option value=\"1\" ". ($checkItemDetailsKit->fixANC == "1" ? "selected = \"selected\"":"") .">+5 Stamina</option>";
                        $selectTagAnc .= "<option value=\"2\" ". ($checkItemDetailsKit->fixANC == "2" ? "selected = \"selected\"":"") .">+10 Stamina</option>";
                        
                        if($findItemDetails->JH == 0)
                            $selectTagJh .= "<option value='00'>Nenhuma</option>";
                        else
                        {
                            $selectTagJh .= "<option value='00'>Nenhuma</option>";
                            $SelectOptionsJhQ = $ODBC->query("SELECT * FROM ItemsJewelOfHarmony WHERE TP = '{$findItemDetails->JH}' ORDER BY [Number]");
                            while($SelectOptionsJh = odbc_fetch_array($SelectOptionsJhQ))
                            {
                                if(substr($SelectOptionsJh['NM'],0 ,8) == "NONE JoH") continue;  
                                for($iJh = 0; $iJh < 15; $iJh++)
                                {         
                                    $indexJh = strtoupper(dechex($iJh)); 
                                    if($this->isZeroOptionJh == true && $SelectOptionsJh['prefx'.$indexJh] == 0) continue;             
                                    if($SelectOptionsJh['prefx'.$indexJh] == 0) $this->isZeroOptionJh = true;
                                    $selectTagJh .= "<option value='{$SelectOptionsJh['ID']}{$indexJh}' ". ($checkItemDetailsKit->fixJH == $SelectOptionsJh['ID'].$indexJh ? "selected = \"selected\"":"") .">{$SelectOptionsJh['NM']} ". $SelectOptionsJh['prefx'.$indexJh] ." </option>\n";
                                }                                                                          
                            } 
                        }
                        
                        if($findItemDetails->RF == 0)
                            $selectTagRefine .= "<option value=\"0\">Nenhuma</option>";   
                        else
                        {
                            $SelectOptionRefineQ = $ODBC->query("SELECT prefx1, prefx2 FROM ItemsRefinery WHERE ID={$findItemDetails->RF}");
                            $SelectOptionRefine = odbc_fetch_object($SelectOptionRefineQ);  
                            $selectTagRefine .= "<option value=\"0\">Nenhuma</option><option value=\"1\" ". ($checkItemDetailsKit->fixRefine == "1" ? "selected = \"selected\"":"") .">{$SelectOptionRefine->prefx1}, {$SelectOptionRefine->prefx2}";    
                        }
                        
                        require("../modules/sockets.lib.php");
                        if($findItemDetails->Socket == 0)
                        {                                                                                                
                            $selectTagSocket1 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket2 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket3 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket4 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            $selectTagSocket5 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                        }   
                        else
                        {
                            switch($findItemDetails->CATEGORIA)
                            {   //None: -1, Fire: 1, Water: 2, Ice: 3, Wind: 4, Lightning: 5, Ground/Earth: 6          
                                case "Amulets": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Armors": 
                                    $typesSockets = array("2", "4", "6"); 
                                    break;  
                                case "Axes":                         
                                    $typesSockets = array("1", "3", "5");
                                    break;  
                                case "Boots":                                       
                                    $typesSockets = array("2", "4", "6"); 
                                    break;  
                                case "Bows":                          
                                    $typesSockets = array("1", "3", "5");
                                    break;  
                                case "Castel Siege": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "CrossBows":                       
                                    $typesSockets = array("1", "3", "5");
                                    break;  
                                case "Events": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Events MIX": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Gifts/Boxs": 
                                    $typesSockets = array("-1");
                                    break;  
                                case "Gloves":                                        
                                    $typesSockets = array("2", "4", "6"); 
                                    break;  
                                case "Guards/Pets": 
                                    $typesSockets = array("-1");
                                    break;   
                                case "Helms":                                      
                                    $typesSockets = array("2", "4", "6"); 
                                    break;    
                                case "Jewels": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Jewels MIX": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Maces":                         
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Mix Items": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Mix Pets": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "New/Test": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Orbs": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Other Items": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Pants":                                       
                                    $typesSockets = array("2", "4", "6"); 
                                    break;    
                                case "Pendants": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Potions": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Quests": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Rings": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Scepters":                       
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Scrolls": 
                                    $typesSockets = array("-1");
                                    break;    
                                case "Shields":                                  
                                    $typesSockets = array("2", "4", "6"); 
                                    break;    
                                case "Spears":                         
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Staffs":                        
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Swords":                       
                                    $typesSockets = array("1", "3", "5");
                                    break;    
                                case "Wings":                      
                                    $typesSockets = array("-1"); 
                                    break;  
                                default:
                                    $typesSockets = array("-1");                       
                            }
                            if($typesSockets[0] == "-1")   
                            {                                                                                  
                                $selectTagSocket1 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket2 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket3 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket4 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                                $selectTagSocket5 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>";   
                            }
                            else
                            {
                                for($iSocketCount = 0, $iSocketIncrement = count($typesSockets); $iSocketCount < $iSocketIncrement; $iSocketCount++)
                                {   
                                    foreach($socketLib['socketTypeNumber'][$typesSockets[$iSocketCount]] as $key => $socket)
                                    {
                                        $this->selectOptionsSocketItemTmp[0] .= "<option value=\"". (int)($key) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][1]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[1] .= "<option value=\"". (int)($key+50) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][2]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[2] .= "<option value=\"". (int)($key+100) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][3]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[3] .= "<option value=\"". (int)($key+150) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][5]})</option>\n";
                                        $this->selectOptionsSocketItemTmp[4] .= "<option value=\"". (int)($key+200) ."\">{$socket['socketTypeName']} ({$socket['socketName']} + {$socket['socketsArgs'][5]})</option>\n";
                                    }
                                }
                    
                                /*for($iSocketCount = 0, $iSocketIncrement = count($typesSockets); $iSocketCount < $iSocketIncrement; $iSocketCount++)
                                {
                                    $SelectOptionsSocketQ = $ODBC->query("SELECT ST, NM, ID, S1, S2, S3, S4, S5 FROM ItemsSocket WHERE TP = ".$typesSockets[$iSocketCount]);
                                    while($SelectOptionsSocket = odbc_fetch_array($SelectOptionsSocketQ))
                                    {                                                                      
                                        $this->selectOptionsSocketItemTmp[0] .= "<option value=\"". ($SelectOptionsSocket['ID']) ."\" ". ($checkItemDetailsKit->fixSocket1 == ($SelectOptionsSocket['ID']) ? "selected = \"selected\"":"") .">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S1']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[1] .= "<option value=\"". ($SelectOptionsSocket['ID']+50) ."\" ". ($checkItemDetailsKit->fixSocket2 == ($SelectOptionsSocket['ID']+50) ? "selected = \"selected\"":"") .">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S2']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[2] .= "<option value=\"". ($SelectOptionsSocket['ID']+100) ."\" ". ($checkItemDetailsKit->fixSocket3 == ($SelectOptionsSocket['ID']+100) ? "selected = \"selected\"":"") .">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S3']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[3] .= "<option value=\"". ($SelectOptionsSocket['ID']+150) ."\" ". ($checkItemDetailsKit->fixSocket4 == ($SelectOptionsSocket['ID']+150) ? "selected = \"selected\"":"") .">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S4']})</option>\n";
                                        $this->selectOptionsSocketItemTmp[4] .= "<option value=\"". ($SelectOptionsSocket['ID']+200) ."\" ". ($checkItemDetailsKit->fixSocket5 == ($SelectOptionsSocket['ID']+200) ? "selected = \"selected\"":"") .">{$SelectOptionsSocket['ST']} ({$SelectOptionsSocket['NM']} + {$SelectOptionsSocket['S5']})</option>\n";
                                    }
                                }*/                                                                                        
                                $selectTagSocket1 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[0]; 
                                $selectTagSocket2 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[1]; 
                                $selectTagSocket3 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[2]; 
                                $selectTagSocket4 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[3]; 
                                $selectTagSocket5 = "<option value=\"{$socketLib['notSocket']}\">Nenhuma ({$socketLib['notSocket']})</option><option value=\"{$socketLib['emptySocket']}\">Deixar o socket livre ({$socketLib['emptySocket']})</option>".$this->selectOptionsSocketItemTmp[4]; 
                            }  
                        } 

                        echo "<form action=\"\" method=\"POST\" id=\"manager\" name=\"manager\">";                                                      
                        echo "Nome do item a alterar:<br />\n<strong>{$findItemDetails->NAME}</strong><br />\n";               
                        echo "Level fixo:<br />\n<select name=\"fixLevel\" id=\"fixLevel\">{$selectTagLevel}</select><br />\n";
                        echo "Option fixo:<br />\n<select name=\"fixOP\" id=\"fixOP\">{$selectTagOpt}</select><br />\n";
                        echo "Luck fixo:<br />\n<input type=\"checkbox\" value=\"1\" id=\"fixLuck\" name=\"fixLuck\" ". ($checkItemDetailsKit->fixLuck == "1" ? "checked = \"checked\"":"") ." /><br />\n";
                        echo "Skill fixo:<br />\n<input type=\"checkbox\" value=\"1\" id=\"fixSkill\" name=\"fixSkill\" ". ($checkItemDetailsKit->fixSkill == "1" ? "checked = \"checked\"":"") ." /><br />\n";
                        echo "Ancient fixo:<br />\n<select name=\"fixANC\" id=\"fixANC\">{$selectTagAnc}</select><br />\n";
                        
                        echo "<fieldset><legend>Op&ccedil;&otilde;es excelentes:</legend>";
                        echo "<input name=\"fixOpEx1\" id=\"fixOpEx1\" type=\"checkbox\" value=\"1\" ". ($checkItemDetailsKit->fixOpEx1 == "1" ? "checked = \"checked\"":"") ." /> {$this->NomeOpExc1}<br />\n";
                        echo "<input name=\"fixOpEx2\" id=\"fixOpEx2\" type=\"checkbox\" value=\"1\" ". ($checkItemDetailsKit->fixOpEx2 == "1" ? "checked = \"checked\"":"") ." /> {$this->NomeOpExc2}<br />\n";
                        echo "<input name=\"fixOpEx3\" id=\"fixOpEx3\" type=\"checkbox\" value=\"1\" ". ($checkItemDetailsKit->fixOpEx3 == "1" ? "checked = \"checked\"":"") ." /> {$this->NomeOpExc3}<br />\n";
                        echo "<input name=\"fixOpEx4\" id=\"fixOpEx4\" type=\"checkbox\" value=\"1\" ". ($checkItemDetailsKit->fixOpEx4 == "1" ? "checked = \"checked\"":"") ." /> {$this->NomeOpExc4}<br />\n";
                        echo "<input name=\"fixOpEx5\" id=\"fixOpEx5\" type=\"checkbox\" value=\"1\" ". ($checkItemDetailsKit->fixOpEx5 == "1" ? "checked = \"checked\"":"") ." /> {$this->NomeOpExc5}<br />\n";
                        echo "<input name=\"fixOpEx6\" id=\"fixOpEx6\" type=\"checkbox\" value=\"1\" ". ($checkItemDetailsKit->fixOpEx6 == "1" ? "checked = \"checked\"":"") ." /> {$this->NomeOpExc6}";
                        echo "</fieldset>";
                        
                        echo "Option harmony fixo:<br />\n<select name=\"fixJH\" id=\"fixJH\">{$selectTagJh}</select><br />\n";
                        echo "Option refine fixo:<br />\n<select name=\"fixRefine\" id=\"fixRefine\">{$selectTagRefine}</select><br />\n";
                        
                        echo "<fieldset><legend>Op&ccedil;&otilde;es sockets:</legend>";
                        echo "<select name=\"fixSocket1\" id=\"fixSocket1\"> {$selectTagSocket1}</select><br />\n";
                        echo "<select name=\"fixSocket2\" id=\"fixSocket2\"> {$selectTagSocket2}</select><br />\n";
                        echo "<select name=\"fixSocket3\" id=\"fixSocket3\"> {$selectTagSocket3}</select><br />\n";
                        echo "<select name=\"fixSocket4\" id=\"fixSocket4\"> {$selectTagSocket4}</select><br />\n";
                        echo "<select name=\"fixSocket5\" id=\"fixSocket5\"> {$selectTagSocket5}</select>";
                        echo "</fieldset>";
                        
                        echo "<input type=\"button\" class=\"button\" value=\"Alterar item\" onclick=\"Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&action=alterItemDb&number={$number}&itemNumber={$_GET['itemNumber']}', 'resultItemsAjaxKitsSubResult', 'POST', BuscaElementosForm('manager'));\" />";
            
                        echo "</form>";
                        echo "<div id=\"resultItemsAjaxKitsSubResult\"></div>";                        
                        break;  
                    case "alterItemDb":
                        $number =       (int)$_GET['number'];
                        $itemNumber =   (string)$_GET['itemNumber'];
                        $fixLevel =     (string)$_POST['fixLevel'];
                        $fixOP =        (int)$_POST['fixOP'];
                        $fixLuck =      (int)$_POST['fixLuck'];
                        $fixSkill =     (int)$_POST['fixSkill'];
                        $fixANC =       (int)$_POST['fixANC'];    
                        $fixOpEx1 =     (int)$_POST['fixOpEx1'];
                        $fixOpEx2 =     (int)$_POST['fixOpEx2'];
                        $fixOpEx3 =     (int)$_POST['fixOpEx3'];
                        $fixOpEx4 =     (int)$_POST['fixOpEx4'];
                        $fixOpEx5 =     (int)$_POST['fixOpEx5'];
                        $fixOpEx6 =     (int)$_POST['fixOpEx6'];
                        $fixJH =        (string)$_POST['fixJH'];
                        $fixRefine =    (int)$_POST['fixRefine'];  
                        $fixSocket1 =   (int)$_POST['fixSocket1'];
                        $fixSocket2 =   (int)$_POST['fixSocket2'];
                        $fixSocket3 =   (int)$_POST['fixSocket3'];
                        $fixSocket4 =   (int)$_POST['fixSocket4'];
                        $fixSocket5 =   (int)$_POST['fixSocket5'];
                        
                        if($ODBC->query("UPDATE KitsItemsDetails SET              
                                        `fixLVL` = {$fixLevel},
                                        `fixOP` = {$fixOP},
                                        `fixLuck` = {$fixLuck},
                                        `fixSkill` = {$fixSkill},
                                        `fixANC` = {$fixANC},
                                        `fixOpEx1` = {$fixOpEx1},
                                        `fixOpEx2` = {$fixOpEx2},
                                        `fixOpEx3` = {$fixOpEx3},
                                        `fixOpEx4` = {$fixOpEx4},
                                        `fixOpEx5` = {$fixOpEx5},
                                        `fixOpEx6` = {$fixOpEx6},
                                        `fixJH` = '{$fixJH}',
                                        `fixRefine` = {$fixRefine},
                                        `fixSocket1` = {$fixSocket1},
                                        `fixSocket2` = {$fixSocket2},
                                        `fixSocket3` = {$fixSocket3},
                                        `fixSocket4` = {$fixSocket4},
                                        `fixSocket5` = {$fixSocket5}
                                        WHERE `kitNumber` = {$number} AND `itemNumber` = '{$itemNumber}'
                                     ") == false) echo "<ul><li>Erro ao alterar item. Favor tentar novamente.</li></ul>";
                        else echo "<ul><li>Item alterado com sucesso!</li></ul>";
                        break;
                    case "removeItemSelect":
                        echo "Selecione o item que deseja remover em <strong>{$findKitDetails->kitName}</strong>";
                        echo "<select multiple style=\"width:500px; height:150px\" id=\"productsList\">";
                        $findItensInKitQuery = $ODBC->query("SELECT itemNumber FROM KitsItemsDetails WHERE kitNumber = ". $number);
                        while($findItensInKit = odbc_fetch_object($findItensInKitQuery))
                        {
                                $findItemKitDetailsQuery = $ODBC->query("SELECT NAME FROM Items WHERE Number='{$findItensInKit->itemNumber}'");
                                $findItemKitDetails = odbc_fetch_object($findItemKitDetailsQuery);
                                echo "<option value=\"{$findItensInKit->itemNumber}\">{$findItemKitDetails->NAME}</option>";    
                        }   
                        echo "</select>";
                        echo "<div class=\"qdestaques\">Aten&ccedil;&atilde;o, ao remover um item do shopping, o hist&oacute;rico de compras dos players podem aprensentar problemas caso j&aacute; tenham realizado alguma compra.</div>";
                        echo "<input type=\"button\" class=\"button\" value=\"Deletar\" onclick=\"javascript: Verify('?AjaxFunctions=true&Function=managerProducts&module=alterThisKit&action=removeItemDb&number={$number}&itemNumber='+document.getElementById('productsList').value, 'resultItemsAjaxKitsResult', 'get');\" />";
                        break;
                    case "removeItemDb":
                        $number =       (int)$_GET['number'];
                        $itemNumber =   (string)$_GET['itemNumber'];  
                        
                        if($ODBC->query("DELETE FROM KitsItemsDetails WHERE `kitNumber` = {$number} AND `itemNumber` = '{$itemNumber}'") == false) 
                            echo "<ul><li>Erro ao remover item. Favor tentar novamente.</li></ul>";
                        else
                            echo "<ul><li>Item removido com sucesso!</li></ul>";
                        break;
                    case "activeDesactiveSolds":
                        $findKitDetailsQuery = $ODBC->query("SELECT active FROM Kits WHERE Number = ". $number);
                        $findKitDetails = odbc_fetch_object($findKitDetailsQuery);
                        if($findKitDetails->active == 0)
                        {
                            $ODBC->query("UPDATE Kits SET active = 1 WHERE Number = ". $number);
                            echo "<ul><li>As vendas desse kits foram <strong>ativadas</strong> nesse momento.</ul></li>";   
                        }
                        else
                        {
                            $ODBC->query("UPDATE Kits SET active = 0 WHERE Number = ". $number);
                            echo "<ul><li>As vendas desse kits foram <strong>desativadas</strong> nesse momento.</ul></li>"; 
                        }
                        break;
                    default: echo "A&ccedil;&atilde;o indefinida";   
                }                                                                                     
            }       
        }
        private function loadFormSelectRemoveKits()
        {
            echo "<strong>Selecione o kit a ser removido na lista abaixo:</strong><br /><select multiple style=\"width:500px; height:150px\" id=\"productsList\">";
            foreach($this->memoryKits as $kit)
            {
                echo "<option value=\"{$kit->Number}\">{$kit->kitName}</option>";    
            }   
            echo "</select>";
            echo "<div class=\"qdestaques\">Aten&ccedil;&atilde;o, ao remover um item do shopping, o hist&oacute;rico de compras dos players podem aprensentar problemas caso j&aacute; tenham realizado alguma compra.</div>";
            echo "<input type=\"button\" class=\"button\" value=\"Deletar\" onclick=\"javascript: Verify('?AjaxFunctions=true&Function=managerProducts&module=removeThisKit&action=removeItemDb&number='+document.getElementById('productsList').value, 'resultAjaxKitsResult', 'get');\" />";
            echo "<div id=\"resultAjaxKitsResult\" class=\"quadros\"></div>"; 
        }
        private function loadFormSelectRemoveKitDb()
        {
            global $ODBC;  
            if(is_numeric($_GET['number']) == false) echo "<ul><li>Erro, n&uacute;mero inv&aacute;lido</li></ul>"; 
            echo "<ul><li>Deletando itens do kit: ";
            if($ODBC->query("DELETE FROM KitsItemsDetails WHERE kitNumber = ". $_GET['number']) == true) echo "ok.</li></ul>"; else echo "erro.</li></ul>";
            echo "<ul><li>Deletando kit:";
            if($ODBC->query("DELETE FROM Kits WHERE Number = ". $_GET['number']) == true) echo "ok.</li></ul>"; else echo "erro.</li></ul>";  
        }
	}
}

?>