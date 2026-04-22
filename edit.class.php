<?php

# самостоятелна функция за обработка на списъка с грешки 
function doerrors(){
global $mfac;
global $smarty;
//print_r($mfac->getErrors());
	$submer= $mfac->getErrors();
			$lister= array();
	foreach($submer as $erelem){
			$erid= $erelem["meta"]["id"];
			$erms= $erelem["message"];
			if (is_array($erms)){
				$erms= $erms[0];
			}else{
			}
//			$erms= "error-$erid";
//			$lister["$erid"]= $erms;
//			$lister["$erid"]= htmlentities($erms);
			$lister["$erid"]= htmlentities($erms,ENT_QUOTES,"cp1251");
	}
//print_r($lister);
								foreach($lister as $erin=>$erco){
									$lister[$erin]= iconv("windows-1251","UTF-8",$erco);
								}
//print_r($lister);
	$smarty->assign("LISTER",$lister);
//printarr($lister,"lister");
}


# класа за редактиране 
class edit {

	#------ задължителни 
	# таблицата 
	var $taname;
	# id на записа 
	var $paid;
//	# шаблона 
//	var $tpname;
	# масив с имената и доп.параметри на полетата 
	var $filist;
	# масив с имена и съдържание на полетата константи 
	var $ficonst;

	#------ НЕзадължителни 
	# име на функцията за допълнителни грешки 
	var $errorfunc;
	# заявка за кеширане на съдържанието 
	var $cachequery;
	# файл за запис на кешираното съдържание 
	var $cachefile;

//function edit ($taname,$paid,$tpname,$filist){
function edit ($taname,$paid,$filist,$ficonst){
	$this->taname= $taname;
	$this->paid= $paid;
//	$this->tpname= $tpname;
	$this->filist= $filist;
	$this->ficonst= $ficonst;
}

function action(){
global $smarty;
global $mfac;
global $DB;
				//if (isset($mfacproc)){
				//}else{
	$mfacproc= $mfac->process();
				//}
//print "MFACPROC=[$mfacproc]";

	if (0){

	#------ начало ---------------------------------------------------
	}elseif ($mfacproc=="INIT"){
		$retucode= -1;

										if (isset($this->funcinit)){
							call_user_func($this->funcinit,$this);
										}else{

		# четем записа от таблицата и записваме полетата в $_POST 
//		$row = getrow($this->taname, $this->paid);
//		$row= dbconv($row);
		$row= $DB->selectRow("select * from $this->taname where id=?" ,$this->paid);
# 30.03.2017 
$row= arstrip($row);
		foreach($this->filist as $finame=>$ficont){
			$_POST[$finame]= $row[$finame];
							# евентуална трансформация "get" 
//print "<br>$finame=".$ficont["transformer"];
							if (isset($ficont["transformer"])){
								$resufunc= call_user_func($ficont["transformer"],"get",$this->paid,$finame,$row);
			$_POST[$finame]= $resufunc;
							}else{
							}
										# if (isset($this->funcinit)){
										}
	}
	#------ submit без формални грешки ---------------------------------------------
	}elseif ($mfacproc=="submit"){
		$retucode= 0;
										
										# евентуална функция за допълнителни грешки 
										if (isset($this->errorfunc)){
											$flagok= call_user_func($this->errorfunc);
										}else{
											$flagok= true;
										}
										# според наличието на грешки 
										if ($flagok===true){
											# няма грешки 
	# съхраняваме в таблицата 
//printarr($_POST,"post");
//		$aset= array();
		$aset= $this->ficonst;
	foreach($this->filist as $finame=>$ficont){
		$aset[$finame]= $_POST[$finame];
							# евентуална трансформация "put" 
							if (isset($ficont["transformer"])){
								$resufunc= call_user_func($ficont["transformer"],"put",$this->paid,$finame,$_POST);
								if ($resufunc===false){
		# ВНИМАНИЕ. 
		# унищожаваме елемента от масива - заради паролата 
		unset($aset[$finame]);
								}else{
		$aset[$finame]= $resufunc;
								}
							}else{
							}
	}
/******
											# ако има $queryreplace 
											# - функция заместител на заявките за корекция на таблицата 
											# - връща заместител на $reload [javascript] 
											if (isset($queryreplace)){
												$retu= call_user_func($queryreplace);
												$reload= ($retu===NULL) ? $reload : $retu ;
//print "<h1>$reload</h1>";
											}else{
******/
				#---- rame11 cpanel - заради class cover image - единствено поле в списъка 
				# ако няма списък, не записваме 
				if (empty($aset)){
				}else{
//print "paid=$this->paid";
//print_r($aset);
	if ($this->paid==0){
		# ВНИМАНИЕ. 
		# $paid вече съдържа id на новия запис 
		$this->paid= $DB->query("insert into $this->taname set ?a" ,$aset);
	}else{
		$DB->query("update $this->taname set ?a where id=?d" ,$aset,$this->paid);
	}
				# if (empty($aset)){
				}
/******
											# if (isset($queryreplace)){
											}
******/

	# евентуално кешираме за бъдещи select-option 
	if (isset($this->cachequery) and isset($this->cachefile)){
		$ardata= $DB->selectCol($this->cachequery);
		$ardata= array(0=>"") + $ardata;
					# кеширане директно в UTF-8 
					# SUFFUTF8 - отгоре - commspec.php 
					file_put_contents($this->cachefile.SUFFUTF8,serialize($ardata));
		# кешираме и в windows-1251 
		$ardata= dbconv($ardata);
		file_put_contents($this->cachefile,serialize($ardata));
	}else{
	}
										}else{
											# има грешки 
								//foreach($flagok as $erin=>$erco){
								//	$flagok[$erin]= iconv("windows-1251","UTF-8",$erco);
								//}
											$smarty->assign("LISTER",$flagok);
		$retucode= 1;
										}

	#------ submit с формални грешки -----------------------------------------------
	}elseif ($mfacproc==NULL){
		$retucode= 1;

	# извеждаме грешките и отново формата  
	doerrors();
/******
//print_r($mfac->getErrors());
	$submer= $mfac->getErrors();
			$lister= array();
	foreach($submer as $erelem){
			$erid= $erelem["meta"]["id"];
			$erms= $erelem["message"];
			if (is_array($erms)){
				$erms= $erms[0];
			}else{
			}
//			$erms= "error-$erid";
//			$lister["$erid"]= $erms;
//			$lister["$erid"]= htmlentities($erms);
			$lister["$erid"]= htmlentities($erms,ENT_QUOTES,"cp1251");
	}
//print_r($lister);
								foreach($lister as $erin=>$erco){
									$lister[$erin]= iconv("windows-1251","UTF-8",$erco);
								}
//print_r($lister);
	$smarty->assign("LISTER",$lister);
//printarr($lister,"lister");
******/

	#------ автоматичен submit -----------------------------------------------------
	}elseif ($mfacproc=="UNKNOWN"){
		$retucode= 2;

	#------ невъзможна грешка от библиотеката 
	}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
	}

return $retucode;
# action end 
}

# class end 
}

?>