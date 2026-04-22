<?php
# отгоре : 
#    $iduser - логнатия потребител 
#    $subj - текущия предмет на изпълнение 
#    $edit - payment.id за корекция на плащане 
//print "correction [$mode][$edit]";

# таблицата 
$taname= "payment";
# шаблона 
$tpname= "subjpaymmodi.ajax.tpl";
# полетата 
$filist= array(
//	"date"=>  array("validator"=>"notempty", "error"=>"датата е задължително поле")
	"date"=>  array("validator"=>"date_valid_notempty")
	,"tocapi"=> NULL
	,"tointe"=> NULL
);

# константни полета 
$ficonst= array("idsubj"=>$subj);
# reload - след успешен събмит 
$relurl= geturl("subj=".$subj);

									# класа за редактиране 
									include_once "edit.class.php";

# редактиране 
//$obedit= new edit($taname,$edit,$filist,$ficonst);
$obedit= new edit($taname,$edit,$filist,$ficonst);
# функция за допълнит.грешки 
$obedit->errorfunc= "funcer";
# добавяме параметри за кеширане 
//$obedit->cachequery= "select id as ARRAY_KEY, name from cofrom order by name";
//$obedit->cachefile= COFROMFILE;

# действие 
$reedit= $obedit->action();
//var_dump($reedit);

# резултат 
if ($reedit==0){
	# redirect 
//	reload("parent",$relurl);
	reload("",$relurl);
}else{
	# извеждаме формата 
	$smarty->assign("SUBJ", $subj);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
}


# функция за допълнит.грешки 
# - връща NULL или $lister 
# източник : cazo1modi.ajax.php 
function funcer(){
						$lister= array();
		# поне една от сумите трябва да е попълнена 
		if (empty($_POST["tocapi"]) and empty($_POST["tointe"])){
						$lister["tocapi"]= "попълни поне една от сумите";
						$lister["tointe"]= "попълни поне една от сумите";
		}else{
		}
		# дата трябва да е възможна и в допустимите граници 
		$date= $_POST["date"];
//		if (preg_match('/^\d{4}-\d{2}-\d{2}$/',$date)){
//			list($ye,$mo,$da)= explode("-",$date);
//			if (checkdate($mo+0,$da+0,$ye+0)){
				# мин.граница - датата от предмета на изпълнение
global $subj;
				$rosubj= getrow("subject",$subj);
				$mind= $rosubj["fromdate"];
				if ($date <= $mind){
					list($ye,$mo,$da)= explode("-",$mind);
					$vidate= "$da.$mo.$ye";
							$lister["date"]= "датата да е след $vidate";
				}else{
				}
				# абс.мин.граница - от таблицата за лихвите 
				$mind= "1989-01-01";
				if ($date < $mind){
							$lister["date"]= "датата да е след 01.01.1989";
				}else{
				}
				# макс.граница - днешната дата 
				$maxd= date("Y-m-d");
				if ($date > $maxd){
							$lister["date"]= "датата да не е след днешната";
				}else{
				}
//			}else{
//							$lister["date"]= "невъзможна дата";
//			}
//		}else{
//						$lister["date"]= "грешна дата";
//		}
						if (count($lister)==0){
return true;
						}else{
return $lister;
						}
}


?>