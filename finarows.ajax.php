<?php
# редовете на избрано извлечение 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
# $viewrows - извлечението - finabank.id 

# данните за извлечението 
$robank= getrow("finabank",$viewrows);
# файла с редовете 
$finame= "bankxml/" .$robank["filename"] .".ser";
# масив с редовете 
$arcont= unserialize(file_get_contents($finame));
			$arorig= $arcont;
$arcont= tran1251($arcont);
//print_rr($arcont);

# масив със статусите 
$arstat= array(0=>"разход", 1=>"дубл.постъп", 2=>"ново постъп");
$smarty->assign("ARSTAT", $arstat);

# извеждаме 
$smarty->assign("ROBANK", $robank);
$smarty->assign("LIST", $arcont);
//print_rr($arcont);
			$smarty->assign("LISTORIG", $arorig);
//print_rr($arorig);
//print smdisp("finarows.ajax.tpl","iconv");
			# определяме шаблона според формата на xml = банката 
								$codebank= $robank["codebank"];
								if (empty($codebank)){
			if (0){
			}elseif ($arcont[0]["bank"]=="pos"){
$tplname= "finarowspos.ajax.tpl";
			}elseif ($arcont[0]["bank"]=="dsk"){
$tplname= "finarowsdsk.ajax.tpl";
			}elseif ($arcont[0]["bank"]=="mub"){
$tplname= "finarowsmub.ajax.tpl";
			}elseif ($arcont[0]["bank"]=="ccb"){
$tplname= "finarowsccb.ajax.tpl";
			}elseif (isset($arcont[0]["dtkt"])){
$tplname= "finarowsali.ajax.tpl";
			}else{
$tplname= "finarowsubb.ajax.tpl";
//die("finarows=1");
			}
								}else{
					$tplname= "finarows".$codebank.".ajax.tpl";
								}
print smdisp($tplname,"iconv");


?>
