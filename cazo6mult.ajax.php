<?php
# зона-6 : отпечатване на група мултиплицирани документи 
# отгоре : 
#    $edit= case.id 
#    $zone= 6 
#    $func= view 
# $mult= груповия документ за отпечатване 


# четем данните за груповия документ 
$rodocu= getrow("docuout",$mult);
//$docont= $rodocu["content"];
//$docont= toutf8($docont);
# типа на шаблона 
# ANGEL REPLACE IN WORD FILE 
$rodoty= getrow("docutype", $rodocu["iddocutype"]);
$arelem= explode(".",$rodoty["filename"]);
$filesuff= $arelem[count($arelem)-1];
# дали шаблона на документа е на word 
$isword= ($filesuff<>"html");
//if ($isword){
//	$wordname= "docs/".$mult.".doc";
//	$docont= file_get_contents($wordname);
//}else{
//}

# определяме номера на групата 
$regigroup= $rodocu["regigroup"];
# четем всички документи от групата без самия групов 
$filt= "regigroup=$regigroup and id<>$mult";
if ($isword){
	$arid= $DB->selectCol("select id from docuout where $filt");
//print_rr($arid);
					$mylist= array();
	if (empty($arid)){
	}else{
//		$incode= implode(",",$arid);
//		$mylist= $DB->selectCol("select content from docuout where id in ($incode)");
//		$mylist= dbconv($mylist);
		foreach($arid as $cuid){
//print "<br>$cuid";
			$wordname= "docs/".$cuid.".doc";
			$docont= file_get_contents($wordname);
					$mylist[]= $docont;
		}
	}
}else{
		$mylist= $DB->selectCol("select content from docuout where $filt");
		$mylist= dbconv($mylist);
}
# обединяваме документите в един общ 
					$newpage= '<div style="page-break-before: always;">&nbsp;</div>';
if ($isword){
					$newpage= "";
	$tocont= implode($newpage,$mylist);
//	$tocont= $mylist[0];
//var_dump($tocont);

}else{
	$tocont= implode($newpage,$mylist);
		# подготвяме съдържанието 
		$tocont= stripslashes($tocont);
		# абсолютен адрес на логото <img= src="http://......"> 
		$tocont= logotran($tocont);
}
//print $tocont;
# общия документ - на изход 
/**/
ExcelHeader($mult.".doc");
	$outp= "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\" />
<body>
	$tocont
</body>
</html>
	";
print $outp;
/**/


function gettagcont($tagpat,&$tocont){
	$found= preg_match_all($tagpat, $tocont, $matches);
//print_rr($matches[0]);
return $matches[0][0];
}


?>
