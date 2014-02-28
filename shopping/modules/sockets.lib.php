<?php                          
if( defined("SOCKET_USE_LIB") == false ) Print_error("SOCKET_USE_LIB not defined.");
 
switch(SOCKET_USE_LIB)
{
    case 0:
        $socketLib = array(
            "notSocket" => 255,
            "emptySocket" => 254,
            "socketTypeNumber" => array(1 => 
                                        array(
                                                0 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Damage", 
                                                           "socketsArgs" => array(1 => "20", 2 => "400", 3 => "400", 4 => "400", 5 => "400")
                                                           ),
                                                1 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Attack Speed", 
                                                           "socketsArgs" => array(1 => "7", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                                2 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Max Damage/Skill Power", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                                3 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Min Damage/Skill Power", 
                                                           "socketsArgs" => array(1 => "20", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                                4 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Damage/Skill Power", 
                                                           "socketsArgs" => array(1 => "20", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ), 
                                                5 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Decrease AG consumption", 
                                                           "socketsArgs" => array(1 => "40", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),                                                                                                                                             
                                             ),
                                        2 => 
                                        array(
                                               10 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Defense Success Rate", 
                                                           "socketsArgs" => array(1 => "10", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               11 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Defense", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               12 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Shield Defense", 
                                                           "socketsArgs" => array(1 => "7", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               13 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Damage Reduction", 
                                                           "socketsArgs" => array(1 => "4", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               14 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Damage Reflect", 
                                                           "socketsArgs" => array(1 => "5", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        3 => 
                                        array(
                                               16 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increase Recover Life", 
                                                           "socketsArgs" => array(1 => "8", 2 => "49", 3 => "50", 4 => "51", 5 => "52")
                                                           ),
                                               17 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increase Recover Mana",                                  
                                                           "socketsArgs" => array(1 => "8", 2 => "49", 3 => "50", 4 => "51", 5 => "52")
                                                           ),
                                               18 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increase Skill Damage", 
                                                           "socketsArgs" => array(1 => "37", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               19 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increase Attack Success Rate", 
                                                           "socketsArgs" => array(1 => "25", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               20 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increase Item Durability", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        4 => 
                                        array(
                                               21 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase Life Autorecovery", 
                                                           "socketsArgs" => array(1 => "8", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               22 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase Max HP",                                  
                                                           "socketsArgs" => array(1 => "4", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               23 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase Max MP", 
                                                           "socketsArgs" => array(1 => "4", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               24 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase Mana Autorecovery", 
                                                           "socketsArgs" => array(1 => "7", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               25 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase Max AG", 
                                                           "socketsArgs" => array(1 => "25", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               26 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase AG Autorecovery", 
                                                           "socketsArgs" => array(1 => "3", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        5 => 
                                        array(
                                               29 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase Excellent Damage", 
                                                           "socketsArgs" => array(1 => "15", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               30 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase Excellent Damage Rate",                                  
                                                           "socketsArgs" => array(1 => "10", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               31 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase Critical Damage", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               32 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase Critical Damage Rate", 
                                                           "socketsArgs" => array(1 => "8", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        6 => 
                                        array(
                                               36 => array("socketTypeName" => "Ground", 
                                                           "socketName" => "Increase Strength", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        ) 
        );
        break;
    case 1:
        $socketLib = array(
            "notSocket" => 0,
            "emptySocket" => 255,
            "socketTypeNumber" => array(1 => 
                                        array(
                                                1 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase damage/skillpower (By Level)", 
                                                           "socketsArgs" => array(1 => "20", 2 => "400", 3 => "400", 4 => "400", 5 => "400")
                                                           ),
                                                2 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Attack Speed", 
                                                           "socketsArgs" => array(1 => "7", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                                3 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Max Damage/Skill Power", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                                4 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Min Damage/Skill Power", 
                                                           "socketsArgs" => array(1 => "20", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                                5 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Increase Damage/Skill Power", 
                                                           "socketsArgs" => array(1 => "20", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ), 
                                                6 => array("socketTypeName" => "Fire", 
                                                           "socketName" => "Decrease AG use", 
                                                           "socketsArgs" => array(1 => "40", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),                                                                                                                                             
                                             ),
                                        2 => 
                                        array(
                                               11 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Defense Success Rate", 
                                                           "socketsArgs" => array(1 => "10", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               12 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Defense", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               13 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Increase Shield Defense", 
                                                           "socketsArgs" => array(1 => "7", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               14 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Damage reduction", 
                                                           "socketsArgs" => array(1 => "4", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               15 => array("socketTypeName" => "Water", 
                                                           "socketName" => "Damage reflections", 
                                                           "socketsArgs" => array(1 => "5", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        3 => 
                                        array(
                                               17 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increases acquisition rate of Life after hunting monsters", 
                                                           "socketsArgs" => array(1 => "8", 2 => "49", 3 => "50", 4 => "51", 5 => "52")
                                                           ),
                                               18 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increases acquisition rate of Mana after hunting monsters",                                  
                                                           "socketsArgs" => array(1 => "8", 2 => "49", 3 => "50", 4 => "51", 5 => "52")
                                                           ),
                                               19 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increase skill attack power", 
                                                           "socketsArgs" => array(1 => "37", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               20 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Increase attack success rate", 
                                                           "socketsArgs" => array(1 => "25", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               21 => array("socketTypeName" => "Ice", 
                                                           "socketName" => "Item duarability reinforcement", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        4 => 
                                        array(
                                               22 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase Life autorecovery", 
                                                           "socketsArgs" => array(1 => "8", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               23 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase maximum life",                                  
                                                           "socketsArgs" => array(1 => "4", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               24 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase maximum mana", 
                                                           "socketsArgs" => array(1 => "4", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               25 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase mana autorecovery", 
                                                           "socketsArgs" => array(1 => "7", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               26 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase maximum AG", 
                                                           "socketsArgs" => array(1 => "25", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               27 => array("socketTypeName" => "Wind", 
                                                           "socketName" => "Increase AG amount", 
                                                           "socketsArgs" => array(1 => "3", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        5 => 
                                        array(
                                               30 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase Excellent Damage", 
                                                           "socketsArgs" => array(1 => "15", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               31 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase Excellent Damage success rate",                                  
                                                           "socketsArgs" => array(1 => "10", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               32 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase Critical Damage", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                               33 => array("socketTypeName" => "Lightning", 
                                                           "socketName" => "Increase critical damage success rate", 
                                                           "socketsArgs" => array(1 => "8", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        6 => 
                                        array(
                                               37 => array("socketTypeName" => "Ground", 
                                                           "socketName" => "Increase stamina", 
                                                           "socketsArgs" => array(1 => "30", 2 => "1", 3 => "1", 4 => "1", 5 => "1")
                                                           ),
                                             ),
                                        ) 
        );
        break;
}
//print_r( $socketLib );
//var_dump( $socketLib );
?>