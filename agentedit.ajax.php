<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $mode - текущия режим 
#    $page - текущата страница 
#    $filt - текущия филтър 
# $edit - agent.id за корекция 
//print "correction [$mode][$edit]";
//print_r($GETPARAM);

# таблицата 
$taname= "agent";
# шаблона 
$tpname= "agentedit.ajax.tpl";
# полетата 
$filist= array(
	"name"=>  array("validator"=>"notempty", "error"=>"името не може да е празно")
);
# константни полета 
//$ficonst= array("iduser"=>$iduser);
$ficonst= array();
# reload - след успешен събмит 
$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
$obedit= new edit($taname,$edit,$filist,$ficonst);
/*
# добавяме параметри за кеширане 
//$obedit->cachequery= "select id as ARRAY_KEY, name from cofrom order by name";
$obedit->cachequery= "select id as ARRAY_KEY, name from cofrom order by serial";
//$obedit->cachefile= "_cofrom";
$obedit->cachefile= COFROMFILE;
*/
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