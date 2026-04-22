<?php
# корекция на филтъра - вика се в nyroModal прозорец 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $vari - вторично меню 
//#    $filt - има ли филтър 
//#    $page - текущата страница 
# още : 
#    $relu2 - линк за релоад 
//#    $tana - таблицата за тримесечието 
//#    $isinte - дали за вътрешните документи 
//print_rr($GETPARAM);
//print "DELIFILTEDIT";
//sleep(2);
//print_rr($_POST);


$smarty->assign("ISINTE", $isinte);

# действие 
$submit= $_POST["submit"];
if (isset($submit)){
	$resu= checklist();
//var_dump($resu);
//print_ru($resu);
	list($lister,$arcode,$arview)= $resu;
//var_dump($lister);
	if (empty($lister)){
								$retucode= 0;
	}else{
								$retucode= 2;
		$smarty->assign("LISTER",$lister);
	}
}else{
								$retucode= 1;
}

# край 
if ($retucode==0){
				# съхраняваме в сесията 
				$_SESSION[$sepostname]= $_POST;
				$_SESSION[$secodename]= $arcode;
				$_SESSION[$seviewname]= $arview;
	# приключване 
	reload("parent",$relu2);
}else{
	# извеждаме формата 
//	if (isset($_POST)){
	if (!empty($_POST)){
	}else{
		$filtse= $_SESSION[$sepostname];
//var_dump($filtse);
		if (isset($filtse)){
			$_POST= $filtse;
		}else{
		}
	}
//print_ru($_POST);
							# за избор на метод - масив с празен елемент 
							$listpoty= array(0=>"") + $listtypepost_utf8;
						/*+++
						$smarty->assign("ARPOSTTYPENAME", "listpoty");
							# за избор на призовкар 
							$aruserpost= getselect("postuser","name","1",true);
							//$aruserpost= dbconv($aruserpost);
						+++*/
						$smarty->assign("ARUSERPOST", "aruserpost");
							# за избор на статус 
							$arstatpost= getselect("poststat","name","1",true);
						$smarty->assign("ARSTATPOST", "arstatpost");
															if ($isinte){
							# за избор на тип изх.документ 
							$artypepost= $DB->selectCol("
								select docutype.id as ARRAY_KEY, docutype.text
								from post
								left join docuout on post.iddocuout=docuout.id
								left join docutype on docuout.iddocutype=docutype.id
								group by docutype.id
								order by docutype.text
								");
							$artypepost= array(0=>"") + $artypepost;
						$smarty->assign("ARTYPEPOST", "artypepost");
							# за избор на деловодител 
							$arusercase= getselect("user","name","inactive=0",true);
						$smarty->assign("ARUSERCASE", "arusercase");
															}else{
															}
	print smdisp("delifiltedit.ajax.tpl","iconv");
}


?>