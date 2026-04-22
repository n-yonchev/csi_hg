<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $edit - user.id за корекция 
# отгоре - параметри : 
//#    $TABLNAME, $HEADMAIN, $HEADEDIT 
#    $HEADMAIN, $HEADEDIT, $IDTYPE 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "poststat";
			if (isset($TABLNAME)){
$taname= $TABLNAME;
			}else{
			}
# шаблона 
$tpname= "delilistedit.ajax.tpl";
# полетата 
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
);
			if ($isdone){
$filist["isdone"]= array("transformer"=>"getputcbox");
			}else{
			}
# константни полета 
//$ficonst= array("iduser"=>$iduser);
//$ficonst= array();
			if (isset($IDTYPE)){
$ficonst= array("idtype"=>$IDTYPE);
			}else{
			}
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page);
//$relurl= geturl("mode=".$mode);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>