<?
require("../settings.php");
session_save_path("../tmp"); 
session_name(SESSION_NAME_SHOP);
session_start();   

CreateImage(); 

function CreateImage()
{
    // cria o código
    $md5Hash = md5(rand(0, 999)); 
    $securityCode = substr($md5Hash, 0, 6); 

    // define a sessão
    $_SESSION["SecurityCode"] = $securityCode;

    // dimensões    
    $width  = 134;
    $height = 40; 

    // cria imagem
    $image = @imagecreate($width, $height);  

    // cores
    $white   = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
    $black   = imagecolorallocate($image, 0x00, 0x00, 0x00);
    $grey    = imagecolorallocate($image, 0x33, 0x33, 0x33);
    $blue    = imagecolorallocate($image, 0x00, 0x00, 0xFF);
    $red       = imagecolorallocate($image, 0xFF, 0x00, 0x00);
    $yellow  = imagecolorallocate($image, 0xFF, 0xFF, 0x00);
    $arrayColors = array($grey, $black, $red, $blue);
    imagefill($image, 0, 0, $white); 
    // escreve na imagem
    
    $arrayFonts = array("fonts/calibri.ttf", "fonts/berlin.ttf");
    
    for($i = 0, $y = strlen($securityCode); $i < $y; $i++)
        imagettftext($image, rand(13, 20), rand(-30,30), 10+(20*$i), 25, $arrayColors[array_rand($arrayColors)], $arrayFonts[array_rand($arrayFonts)], $securityCode{$i});
    // faz uma borda
    imagerectangle($image, 0, 0, $width - 1, $height - 1, $grey); 
    
    // fase final
    @header("Content-Type: image/jpeg"); 
    imagejpeg($image);
    imagedestroy($image);
}
?>