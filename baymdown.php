<?php
# download на XML файла за изходящ банков пакет 
# вика се в скрит вътрешен фрейм - виж шаблона baym.tpl 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# $down - id на пакетa 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

								include "commdown.php";

# получаваме съдържанието на XML файла 
$xmlc= xmlcreate($down);
# името за download 
$name= "ubbpayment.xml";
# самия download 
download($xmlc,$name);


?>
