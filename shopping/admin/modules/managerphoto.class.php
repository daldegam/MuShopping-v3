<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if ( class_exists( "managerPhoto" ) == false ) {
	class managerPhoto
    {
        public $result;
        public function __construct()
        {   
            global $tpl;
            if($_GET['type'] == "common") $_SESSION['typeManagerPhoto'] = "Common";
            elseif($_GET['type'] == "ancient") $_SESSION['typeManagerPhoto'] = "Ancient"; 
            switch($_GET['action'])
            {             
                case "searchPhotos":
                    $this->searchPhotos();
                    $tpl->set("Results", $this->result); 
                    break;
                case "uploadPhotos":
                    $this->uploadPhotos();
                    $tpl->set("Results", $this->result); 
                    break;
                default: $tpl->set("Results", "");
            }                         
        }
        private function searchPhotos()
        {                                                         
            $this->photosCommon['gif']  = glob("../images/items/*.gif");
            $this->photosCommon['png']  = glob("../images/items/*.png");
            $this->photosCommon['jpg']  = glob("../images/items/*.jpg");
            $this->photosCommon['jpeg'] = glob("../images/items/*.jpeg");
            $this->photosCommon['bmp']  = glob("../images/items/*.bmp");
            //var_dump($this->photosCommon); 
            foreach($this->photosCommon['gif'] as $img)
            {
                ++$i;
                if($i % 3 == 0 ) $printResult .= "\n</tr>\n<tr>";
                else $printResult .= "<td align=\"center\" width=\"50%\"><a href=\"javascript: void(0);\" onclick=\"javascript: insertPhoto{$_SESSION['typeManagerPhoto']}('".substr($img, 3)."');\"><img src=\"{$img}\" style=\"border:none;\" /><br /><strong style=\"font-weight:normal; color:#727272;\">". substr($img, 3, 16) ."</strong><br /><strong>". substr($img, 16) ."</strong></a></td>\n"; 
            }
            foreach($this->photosCommon['png'] as $img)
            {
                ++$i;
                if($i % 3 == 0 ) $printResult .= "\n</tr>\n<tr>";
                else $printResult .= "<td align=\"center\" width=\"50%\"><a href=\"javascript: void(0);\" onclick=\"javascript: insertPhoto{$_SESSION['typeManagerPhoto']}('".substr($img, 3)."');\"><img src=\"{$img}\" style=\"border:none;\" /><br /><strong style=\"font-weight:normal; color:#727272;\">". substr($img, 3, 16) ."</strong><br /><strong>". substr($img, 16) ."</strong></a></td>\n"; 
            }
            foreach($this->photosCommon['jpg'] as $img)
            {
                ++$i;
                if($i % 3 == 0 ) $printResult .= "\n</tr>\n<tr>";
                else $printResult .= "<td align=\"center\" width=\"50%\"><a href=\"javascript: void(0);\" onclick=\"javascript: insertPhoto{$_SESSION['typeManagerPhoto']}('".substr($img, 3)."');\"><img src=\"{$img}\" style=\"border:none;\" /><br /><strong style=\"font-weight:normal; color:#727272;\">". substr($img, 3, 16) ."</strong><br /><strong>". substr($img, 16) ."</strong></a></td>\n"; 
            }
            foreach($this->photosCommon['jpeg'] as $img)
            {
                ++$i;
                if($i % 3 == 0 ) $printResult .= "\n</tr>\n<tr>";
                else $printResult .= "<td align=\"center\" width=\"50%\"><a href=\"javascript: void(0);\" onclick=\"javascript: insertPhoto{$_SESSION['typeManagerPhoto']}('".substr($img, 3)."');\"><img src=\"{$img}\" style=\"border:none;\" /><br /><strong style=\"font-weight:normal; color:#727272;\">". substr($img, 3, 16) ."</strong><br /><strong>". substr($img, 16) ."</strong></a></td>\n"; 
            }
            foreach($this->photosCommon['bmp'] as $img)
            {
                ++$i;
                if($i % 3 == 0 ) $printResult .= "\n</tr>\n<tr>";
                else $printResult .= "<td align=\"center\" width=\"50%\"><a href=\"javascript: void(0);\" onclick=\"javascript: insertPhoto{$_SESSION['typeManagerPhoto']}('".substr($img, 3)."');\"><img src=\"{$img}\" style=\"border:none;\" /><br /><strong style=\"font-weight:normal; color:#727272;\">". substr($img, 3, 16) ."</strong><br /><strong>". substr($img, 16) ."</strong></a></td>\n"; 
            }                 
            $this->result = "<div class=\"quadros\" style=\"width:455px; height:300px; overflow:scroll;\">\n<table width=\"100%\" border=\"1\">\n<tr>\n{$printResult}</table></div>"; 
        } 
        private function uploadPhotos()
        {
            $this->result .= "<form action=\"?cmd=ManagerPhoto&action=uploadPhotos&send=true\" method=\"post\" enctype=\"multipart/form-data\" class=\"quadros\" style=\"text-align:center; width:455px;\">"; 
            $this->result .= "<strong>Formatos aceitos: .jpg, .gif, .png<br />\nEscolha a foto abaixo e mande enviar.</strong><br />";
            $this->result .= "<input name=\"photo\" type=\"file\" /><br />";
            $this->result .= "<input type=\"submit\" value=\"Enviar\" class=\"button\" />";
            $this->result .= "</form>";  
            if($_GET['send'] == "true")
            {
                if(is_uploaded_file($_FILES['photo']['tmp_name']) == true)
                {               
                    if(!in_array($_FILES['photo']['type'], array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif')))
                        return $this->result .= "<div class=\"quadros\" style=\"text-align:center; width:455px;\">Formato inválido.</div>";
                    
                    $fileDestination = "../images/items/".time().$_FILES['photo']['name'];
                    if(move_uploaded_file($_FILES['photo']['tmp_name'], $fileDestination ) == false)
                        return $this->result .= "<div class=\"quadros\" style=\"text-align:center; width:455px;\">Erro ao mover arquivo temporário.</div>";
                                             
                    $this->result .= "<div class=\"quadros\" style=\"text-align:center; width:455px;\">Enviado com sucesso.<script type=\"text/javascript\">insertPhoto{$_SESSION['typeManagerPhoto']}('".substr($fileDestination, 3)."');</script></div>";
                }
                else
                    $this->result .= "<div class=\"quadros\" style=\"text-align:center; width:455px;\">Houve um erro ao enviar sua foto.</div>";
                //var_dump( $_FILES['photo'] );
            }  
        }
	}
}


?>