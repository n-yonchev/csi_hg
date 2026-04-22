<?php
# зона-6 : корекция на съществуващ изходящ документ по делото 
# отгоре : 
#    $edit= case.id 
#    $zone= 6 
#    $func= view 
#  $docu= документа за корекция 
//print_r($GETPARAM);

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];


# таблицата 
$taname= "docuout";
# шаблона 
$tpname= "cazo6edit.ajax.tpl";
//# reload - след успешен събмит 
//$relurl= geturl("mode=".$mode."&page=".$page."&bapaelem=".$bapaelem."&pageelem=".$pageelem);

# полетата 
$filist= array(
	"content"=>  NULL
);
# константни полета 
$ficonst= array();

#---- съкратено редактиране -------------------------------------------

									# класа за редактиране 
									include_once "edit.class.php";
							# основен входен параметър - $docu <> 0
							# в случая не може да е = 0 

# редактиране 
$obedit= new edit($taname,$docu,$filist,$ficonst);

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

#---- край на съкратеното редактиране -------------------------------------------


# резултат 
/****
if ($reedit==0){
//	# redirect 
//	reload("parent",$relurl);
	# линк за redirect 
//	$redilink= array("t4link","t2link");
	$redilink= "t6link";
	# redirect 
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
****/
# ВНИМАНИЕ. 
# При нормално използване обекта връща $reedit= -1 и грешка : 
#    erlist["content"]= "Field &quot;%s&quot; (%s) contains invalid value: expected %s, got %s!";
# за да я избегнем, проверяваме директно за submit 
if (isset($_POST["submit"])){
			# записваме съдържанието 
			$aset= array();
			$aset["content"]= @$_POST["content"];
			$DB->query("update $taname set ?a where id=?" ,$aset,$docu);
	# линк за redirect 
	$redilink= "t6link";
	# redirect 
	$smarty->assign("EXITCODE", getnyroexit($redilink));
	print smdisp($tpname,"iconv");
}else{

# FCKeditor - подготовка 
# име на FCKeditor инстанцията = POST името със съдържанието
$editname= "content";
$oFCKeditor = getFCK($editname) ;
$oFCKeditor->Width= "840";
//$oFCKeditor->Height= "700";
$oFCKeditor->Height= "1000";
//$oFCKeditor->Config["StylesXmlPath"]= $oFCKeditor->myFullPath ."../FCKlocal/fckmain.xml";
//$oFCKeditor->Config["EditorAreaCSS"]= $oFCKeditor->myFullPath ."../FCKlocal/fckmain.css";
$oFCKeditor->ToolbarSet= "InternalPages";

# FCKeditor - действие 
$oFCKeditor->Value= to1251($_POST["content"]);
$htmlcont= $oFCKeditor->CreateHtml();
	$smarty->assign("HTMLCONT",$htmlcont);
//printarr($oFCKeditor->Config,"fckconf");

						# допълнителни js линкове за секцията head 
						$smarty->assign("HEADJS", array("_cazo6edit.js"));

	# извеждаме формата 
//	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
sleep(2);
	print smdisp($tpname,"iconv");

}


?>
