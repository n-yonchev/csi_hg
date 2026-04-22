<?php
# корекция на тип входен документ - за статистиката 
# източник : cofromedit.ajax.php 
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - aadocutype.id за корекция 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "aadocutype";
# шаблона 
$tpname= "aadocuedit.ajax.tpl";
# полетата 
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
	,"deadline_days"=>  array("validator"=>"integer_or_empty", "error"=>"дните са некоректно въведени")
//	"name"=>  array("validator"=>"notempty", "error"=>iconv("windows-1251","UTF-8","името не може да е празно"))
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
/*
# добавяме параметри за кеширане 
$obedit->cachequery= "select id as ARRAY_KEY, name from cofrom order by name";
//$obedit->cachefile= "_cofrom";
$obedit->cachefile= COFROMFILE;
*/

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
/*
								# ВНИМАНИЕ. ЛЕПЕНКА. 
								if ($GETPARAM["cazo1"]=="yes"){
									# изключение 
									# извикано е за динамично добавяне на елемент от cazo1 - основни данни за дело 
									# само рефрешваме select-option за избор 
									print "
								<script>
								parent.getcof($obedit->paid);
								//parent.$('#closeBut').click();
								$NYROREMOVE
								parent.getElementById('idcofrom').value= $obedit->paid;
								</script>
									";
								}else{
									# нормалния случай 
									# извикано е от елемента в главното меню 
*/
	# redirect 
	reload("parent",$relurl);
//								}
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
}


?>