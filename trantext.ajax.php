<?php
# разпределение : корекция на основание 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - подрежим 
#    $page - текущата страница 
# основен : 
#    $edittext - finatran.id за корекция 
# още отгоре : 
#    $relurl - след успешен събмит 
//print_r($GETPARAM);

# таблицата 
$taname= "finatran";
# шаблона 
$tpname= "trantext.ajax.tpl";
# полетата 
$filist= array(
	"text"=>  array("validator"=>"notempty", "error"=>"не може да е празно")
	,"text1"=>  array("validator"=>"notempty", "error"=>"не може да е празно")
	,"text2"=>  array("validator"=>"notempty", "error"=>"не може да е празно")
);
# константни полета 
$ficonst= array();
# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&filt=".$filt);
//$relurl= geturl("mode=".$mode."&page=".$page);

# данните 
$rocont= $DB->selectRow("select * from $taname where id=?" ,$edittext);
$smarty->assign("ARDATA", $rocont);
$roclai= getrow("claimer",$rocont["idclaimer"]);
$smarty->assign("CLAINAME", $roclai["name"]);
$smarty->assign("CLAIIBAN", $roclai["iban"]);
		$ispostbank= $rocont["idbank"]==$indxbankpost;
$smarty->assign("ISPOSTBANK", $ispostbank);
//print_rr($roclai);

									# класа за редактиране 
									include_once "edit.class.php";

#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
									# основен параметър - 
									# $edittext = $taname.id 
if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
//	if ($edittext==0){
//	}else{
		//$rocont= $DB->selectRow("select * from $taname where id=?" ,$edittext);
		foreach($filist as $finame=>$ficont){
				$_POST[$finame]= $rocont[$finame];
		}
		if ($ispostbank){
			$_POST["text"]= $rocont["text"];
		}else{
			list($text1,$text2)= explode("|",$rocont["text"]);
			$_POST["text1"]= $text1;
			$_POST["text2"]= $text2;
		}
//	}
											# проверяваме за допълнителни грешки 
											$lister= array();
							include "trantexter.inc.php";
	$smarty->assign("LISTER",$lister);

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();
							include "trantexter.inc.php";
/***
							if ($ispostbank){
		$txslen= 70;
								$text= $_POST["text"];
//		$slen= mb_strlen($text,"UTF-8");
//var_dump($slen);
		$slen= strlen(tran1251($text));
//var_dump($slen);
								if ($slen<=$txslen){
								//if (flagtextlen($text,$txslen)){
								}else{
											$lister["text"]= "съдържа $slen вместо макс.$txslen символа";
								}
							}else{
		$txslen= 35;
								$text1= $_POST["text1"];
//		$slen= mb_strlen($text1,"UTF-8");
		$slen= strlen(tran1251($text1));
								if ($slen<=$txslen){
								//if (flagtextlen($text1,$txslen)){
								}else{
											$lister["text1"]= "съдържа $slen вместо макс.$txslen символа";
								}
								$text2= $_POST["text2"];
//		$slen= mb_strlen($text2,"UTF-8");
		$slen= strlen(tran1251($text2));
								if ($slen<=$txslen){
								//if (flagtextlen($text2,$txslen)){
								}else{
											$lister["text2"]= "съдържа $slen вместо макс.$txslen символа";
								}
							}
***/
											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
	# добавяне/корекция 
		$aset= array();
		//foreach($filist as $finame=>$ficont){
		//		$aset[$finame]= $_POST[$finame];
		//}
							if ($ispostbank){
		$aset["text"]= $text;
							}else{
		$aset["text"]= "$text1|$text2";
							}
//							#---- полета с автоматично съдържание 
//	if ($edittext==0){
//		# нов запис 
//		$edittext= $DB->query("insert into $taname set ?a" ,$aset);
//	}else{
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edittext);
//	}
											# край - според дали има грешка 
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
# - невъзможно в случая 
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------
# резултат 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("EDIT", $edittext);
	$smarty->assign("FILIST", $filist);
	print smdisp($tpname,"iconv");
}


?>
