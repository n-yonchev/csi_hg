<?php
# download на външен файл като изх.документ за текущото дело 
# вика се в скрит вътрешен фрейм - виж шаблона cazo6.tpl 
//# отгоре : 
//#    $GETPARAM - масив с параметрите от GET 
//#    $mode - текущия режим 
//#    $page - текущата страница 
# $down - docuout.id 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

								include "commdown.php";

/*
# получаваме съдържанието на XML файла 
$xmlc= xmlcreate($down);
# името за download 
$name= "ubbpayment.xml";
# самия download 
download($xmlc,$name);
*/

# вътр.папка за съхраняване на файловете 
$filedire= "files/";
# данните за изх.документ 
//$rocont= getrow("docuout",$down);
$rocont= $DB->selectRow("select * from docuoutfile where iddocuout=?d" ,$down);
$rocont= dbconv($rocont);
//print_r($rocont);
# името на физич.файл 
//$servname= $filedire.$rocont["filenameserv"];
$servname= $filedire.$rocont["prefix"].$rocont["filename"];
//var_dump($servname);
//var_dump($rocont["filename"]);
# четем съдържанието му 
$servcont= file_get_contents($servname);
# името за download 
$downname= $rocont["filename"];
$downname= str_replace(" ","_",$downname);
//$downname= rawurlencode($downname);

# самия download 
download($servcont,$downname);


?>
