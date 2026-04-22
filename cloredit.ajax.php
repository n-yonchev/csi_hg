<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - id за корекция 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "claimorigin";
# шаблона 
$tpname= "cloredit.ajax.tpl";
# полетата 
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"текста не може да е празен")
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
//$relurl= "?".rawurlencode(mycrypt("put","mode=".$mode));
$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
//# добавяме параметри за кеширане 
//$obedit->cachequery= "select id as ARRAY_KEY, name from claimorigin order by serial";

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
					# новия запис - най-отзад в подредбата 
					if ($edit==0){
													$DB->query("lock tables $taname write");
						$maxser= $DB->selectCell("select max(serial) from $taname");
//print "[$maxser][$obedit->paid]";
						$DB->query("update $taname set serial=?d where id=?d" ,$maxser+1,$obedit->paid);
													$DB->query("unlock tables");
					}else{
					}
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
}


?>