<?php
# локално изчисляване на лихва 

# шаблона 
$tpname= "calc.tpl";
# полетата 
$filist= array(
//	"amou"=>  array("validator"=>"notempty", "error"=>"въведи сумата")
	"amou"=>  array("validator"=>"amount", "error"=>"грешна сума")
				# 19.03.2009 
				# формата на датата вече е d.m.y 
//	,"dat1"=>  array("validator"=>"date_valid_notempty", "error"=>"грешна нач.дата")
//	,"dat2"=>  array("validator"=>"date_valid_notempty", "error"=>"грешна кр.дата")
	,"dat1"=>  array("validator"=>"bgdate_valid_notempty", "error"=>"грешна нач.дата")
	,"dat2"=>  array("validator"=>"bgdate_valid_notempty", "error"=>"грешна кр.дата")
# 08.06.2009 - добавяме още 3 валути и съответни лихвени нива 
,"type"=> NULL
);

# 08.06.2009 - добавяме още 3 валути и съответни лихвени нива 
# полето с лихв.процент - според валутата $type 
$arfiel= array();
$arfiel[0]= "bnb";
$arfiel[1]= "usd";
$arfiel[2]= "euro";
$arfiel[3]= "euribor";
# паралелно - заглавие за типа - според валутата $type 
$artypetext= array();
$artypetext[0]= "ОЛП";
$artypetext[1]= "3m.usd";
$artypetext[2]= "3m.euro";
$artypetext[3]= "euribor";

									# класа за редактиране 
									include_once "edit.class.php";
# форма 
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";
//var_dump($mfac->getErrors());

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
# 08.06.2009 - добавяме още 3 валути и съответни лихвени нива 
	$_POST["type"]= 0;							

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
				$lister= array();
		# проверяваме за доп.грешки 
		$dat1= $_POST["dat1"];
		$dat2= $_POST["dat2"];
				# 19.03.2009 
				# формата на датата вече е d.m.y 
//		if ($dat1<$dat2){
				list($da,$mo,$ye)= explode(".",$dat1);
				$stamp1= mktime(0,0,1, $mo,$da,$ye);
				list($da,$mo,$ye)= explode(".",$dat2);
				$stamp2= mktime(0,0,1, $mo,$da,$ye);
		if ($stamp1<$stamp2){
		}else{
				$lister["dat1"]= $lister["dat2"]= "грешен период";
		}
# 08.06.2009 - добавяме още 3 валути и съответни лихвени нива 
		$potype= $_POST["type"];
		if (isset($potype)){
		}else{
				$lister["type"]= "валутата е задължителна";
		}
				if (empty($lister)){
				}else{
							$retucode= 1;
		$smarty->assign("LISTER",$lister);
				}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit 
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ невъзможна грешка от библиотеката 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- край на директното редактиране -----------------------

													# 13.01.2011 - надбавката ОЛП 
													$_SESSION["extraint"]= 10;
//var_dump($_SESSION["extraint"]);
# изчисляваме 
//print_r($_POST);
				if ($retucode==0){
								include_once "subjpaymhist.inc.php";
# четем списъка с лихвените проценти по периоди 
		if ($potype==0){
//$arperc= $DB->select("select * from percent order by id");
$arperc= getpercent();
		}else{
# 08.06.2009 - добавяме още 3 валути и съответни лихвени нива 
$arperc= $DB->select("select * from percentlibor order by id");
		}
# полето с лихв.процент - според валутата $type 
$percname= $arfiel[$potype];
if (empty($percname)){
die("calc=1=percname");
}else{
}
# заглавие за типа - според валутата $type 
//var_dump($potype);
//print_rr($artypetext);
$perctext= $artypetext[$potype];
if (empty($perctext)){
die("calc=1=perctext");
}else{
}
$smarty->assign("PERCTEXT", $perctext);

# изчисляваме лихвата за периода 
$amou= $_POST["amou"];
				# 19.03.2009 
				# формата на датата вече е d.m.y 
				list($da,$mo,$ye)= explode(".",$_POST["dat1"]);
				$dat1= "$ye-$mo-$da";
				list($da,$mo,$ye)= explode(".",$_POST["dat2"]);
				$dat2= "$ye-$mo-$da";
									# 19.03.2009 
									# специално за лихвения калкулатор 
									# крайната дата не се трансформира с 1 ден назад 
									# допълнителен 4-ти параметър - флаг дали да се трансформира 
//$arinte= calcinte($dat1, $dat2, $amou);
									$arinte= calcinte($dat1, $dat2, $amou    ,false);
							/*
									# 02.09.2010 - Велева - крайната дата се трансформира 
									# иначе има разлика между глобал.изчислване с калкулатора 
									# и изчисляването по периоди в делото - без погасяване 
									$arinte= calcinte($dat1, $dat2, $amou);
							*/
//var_dump($arinte);
									# шунт заради началната дата 
									if (is_string($arinte)){
							$smarty->assign("ERRORTEXT", $arinte);
									}else{

#---- резултатите 
//print_r($arinte);
# общата лихва 
$intetota= $arinte["newinte"];
# общата сума дълг 
$amoutota= $intetota + $amou;
# списъка с периодите 
$intelist= $arinte["list"];
$smarty->assign("INTETOTA", $intetota);
$smarty->assign("AMOUTOTA", $amoutota);
$smarty->assign("INTELIST", $intelist);
									# край - шунт заради началната дата 
									}
				}else{
				}

# извеждаме 
//$smarty->assign("ADDNEW", $addnew);
$smarty->assign("FILIST", $filist);
$pagecont= smdisp($tpname,"fetch");

?>
