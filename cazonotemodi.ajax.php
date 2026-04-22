<?php
# отгоре : 
#    $iduser - логнатия потребител 
//#    $mode - текущия режим 
//#    $view - case.id за разглеждане 
//# отгоре : 
#    $edit= case.id за модифициране 
#    $zone= 1
#    $func= modi 
//print "correction [$iduser][$mode][$edit][$zone][$func]";

# таблицата 
$taname= "suit";
# шаблона 
$tpname= "cazonotemodi.ajax.tpl";
# полетата 
$filist= array(
	"notes"=> NULL
);


# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();

//# за линка - добави нов идва от 
//$addcofrom= geturl("mode=idva&edit=0&cazo1=yes");
//$smarty->assign("ADDCOFROM", $addcofrom);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
//# функция за допълнит.грешки 
//$obedit->errorfunc= "funcer";
//# 29.05.2009 Бъзински - да се корегира датата на образуване 
//# специфична функция за състояние INIT 
//$obedit->funcinit= "funcinit";
# действие 
$reedit= $obedit->action();
//var_dump($reedit);
//print_r($_POST);

# резултат 
if ($reedit==0){
#--------------------------------------------------------------------------------
/*
			# 17.12.2009 - оправена грешка 
			# корекцията на формата на датата НЕ се правеше при вземане на ново дело, само при корекция на съществуващо 
			# сега вече е ОК, специален скрипт за синхронизация на старите данни - _created.php 
		# 29.05.2009 Бъзински - да се корегира датата на образуване 
		# допълнителни корекции на записа - датата в MySQL формат 
		$crea= $_POST["created"];
		$creacano= bgdateto($crea);
			$aset= array();
			$aset["created"]= $creacano;
			$aset["lastdocu"]= $creacano;
		$DB->query("update suit set ?a where id=?d" ,$aset,$obedit->paid);
*/
	# redirect 
	$smarty->assign("EXITCODE", getnyroexit("tnotelink"));
	print smdisp($tpname,"iconv");
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");
}

?>