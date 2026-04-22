<?php
# само проба за въвеждане чрез copy/paste 

									$ok= $GETPARAM["ok"];
									if ($ok=="yes"){
				include_once "doredate.ajax.php";
exit;
									}else{
									}

# винаги въвеждане 
$edit= 0;

# таблицата 
$taname= "tranprobe";
# шаблона 
$tpname= "tranprobe.tpl";
# полетата 
$filist= array(
	"content"=> NULL
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&ok=yes");

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==-1){
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
	$pagecont= smdisp($tpname,"fetch");
}elseif ($reedit==0){
	$DB->query("update $taname set time=now() where id=?d"  ,$obedit->paid);
	# само текст 
	$smarty->assign("EDIT", 1);
//	$smarty->assign("FILIST", $filist);
//	print smdisp($tpname,"iconv");
	$pagecont= smdisp($tpname,"fetch");
}else{
}


?>
