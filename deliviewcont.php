<?php
# разглеждане съдържанието на изх.документ от списък връчване 
# отгоре : 
#     $viewcont - записа за изх.документ docuout.id 


$rodout= $DB->selectRow("select * from docuout where id=?d"  ,$viewcont);
$cont= $rodout["content"];
$idtype= $rodout["iddocutype"];

//var_dump($cont);
if (empty($cont)){
	$cont= file_get_contents("docs/".$viewcont.".doc");
	$text= $DB->selectCell("select text from docutype where id=?d"  ,$idtype);
							include "commdown.php";
	download($cont,'"'.$text.'.doc"');
}else{
	$cont= arstrip($cont);
			$str1= "charset=UTF-8";
			//$hea1= "<head>";
			//$hea2= '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
			$hea3= '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>';
	$pos1= strpos($cont,$str1);
	if ($pos1===false){
		$cont= $hea3 .$cont;
	}else{
	}
	print $cont;
}


?>