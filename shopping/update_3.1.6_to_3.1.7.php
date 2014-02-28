<h1>Update MuShopping versão 3.1.6 para 3.1.7</h1>
<?php
    require("settings.php");
    require("modules/odbc.class.php");
    $objCon = new LD_ODBC(); 
    $err = 0;
    if(@$objCon->query("ALTER TABLE [Items] ADD COLUMN [C_96] BIT") == true)
        echo "<p>Criada a coluna da classe Rage Fighter</p><br />";
    else             
    {
        echo "<p>Erro ao criar a coluna da classe Rage Fighter (possivelmente j&aacute; criada)</p><br />";
        $err++;
    }
    if(@$objCon->query("ALTER TABLE [Items] ADD COLUMN [C_98] BIT") == true)
        echo "<p>Criada a coluna da classe Fist Master</p><br />";
    else             
    {
        echo "<p>Erro ao criar a coluna da classe Fist Master (possivelmente j&aacute; criada)</p><br />";
        $err++; 
    }
    if($err == 0) 
        if(@unlink(realpath(__FILE__)))
            echo "<p>Essa p&aacute;gina foi deletada automaticamente!</p>";
?>