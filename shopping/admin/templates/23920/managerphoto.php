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
<title>{#TITLE}</title>
<script type="text/javascript"> 
function insertPhotoCommon(location)
{
    opener.document.forms['manager'].photoItem.value = location;
    self.close();
}
function insertPhotoAncient(location)
{
    opener.document.forms['manager'].photoItemAnc.value = location;
    self.close();
}
</script>
</head>

<body>   		                      
                                            
<div class="quadros" style="width:455px; text-align:center;">
<h1>Gerenciamento rápido de fotos</h1>                                                                     
<input value="Procurar foto no servidor" type="button" class="button" onclick="javascript: window.location='?cmd=ManagerPhoto&action=searchPhotos';" />
<input value="Enviar nova foto" type="button" class="button" onclick="javascript: window.location='?cmd=ManagerPhoto&action=uploadPhotos';" />
</div>
{#Results}                                             
        
</body>
</html>