<?php
# всичко за филтъра по делата 
# сесийна променлива : 
#     $_SESSION["filtco"] - масив с параметрите на текущия филтър 


# полетата 
$filterlist= array(
# изпълнително дело 
//	"exseri"=>  array("text"=>"номер",     "group"=>1,                          "type"=>"like",  "field"=>"suit.serial")
# 29.05.2009 - номер дело - или само един, или от-до 
"exseri"=>  array("text"=>"номер",     "group"=>1,                          "type"=>"serifromto")
	,"exyear"=>  array("text"=>"година",   "group"=>1,   "source"=>"listyear",  "type"=>"equal", "field"=>"suit.year")
	,"exafte"=>  array("text"=>"след",     "group"=>1, "source"=>"bgdatetran(\$mycont)", "type"=>">=",    "field"=>"suit.created")
	,"exbefo"=>  array("text"=>"преди",    "group"=>1, "source"=>"bgdatetran(\$mycont)", "type"=>"<=",    "field"=>"suit.created")
	,"extext"=>  array("text"=>"описание", "group"=>1,                          "type"=>"like",  "field"=>"suit.text")
# 17.04.2009 - добавяме и деловодителя 
# не може да се филтрират делата, които нямат деловодител 
	,"oruser"=>  array("text"=>"деловодител", "group"=>1,"source"=>"getuser()", "type"=>"equal", "field"=>"suit.iduser")
# 26.05.2009 - добавяме и ред за отчета, текущ статус и характер на изпълнението 
# не може да се филтрират делата, за които съответния указател е нулев 
	,"orrepo"=>  array("text"=>"ред за отчета", "group"=>1,"source"=>"listrepo", "type"=>"equal", "field"=>"suit.idrepo")
	,"orstat"=>  array("text"=>"текущ статус",  "group"=>1,"source"=>"listcasestat", "type"=>"equal", "field"=>"suit.idstat")
	,"orchar"=>  array("text"=>"характер на изпълнението", "group"=>1,"source"=>"listchartype", "type"=>"equal", "field"=>"suit.idchar")
# съдебно дело 
	,"orfrom"=>  array("text"=>"идва от", "group"=>2,   "source"=>"getcof()",   "type"=>"equal", "field"=>"suit.idcofrom")
	,"ortitu"=>  array("text"=>"титул",   "group"=>2,   "source"=>"listtitu",   "type"=>"equal", "field"=>"suit.idtitu")
	,"orsort"=>  array("text"=>"вид",     "group"=>2,   "source"=>"listsort",   "type"=>"equal", "field"=>"suit.idsort")
	,"oryear"=>  array("text"=>"година",  "group"=>2,                           "type"=>"like",  "field"=>"suit.coyear")
# 29.06.2010 - Софрониев 
	,"ornome"=>  array("text"=>"дело",  "group"=>2,                           "type"=>"equal",  "field"=>"suit.conome")
/*
# [страни] участници - взискател, длъжници 
	,"merang"=>  array("text"=>"обхват",  "group"=>3,"spec"=>true,"source"=>"listcaserang",  "type"=>"")
	,"metype"=>  array("text"=>"тип",     "group"=>3,  "source"=>"listmembtype",  "type"=>"equal", "field"=>"idtype")
	,"meiden"=>  array("text"=>"идентификация", "group"=>3,                       "type"=>"identi")
//	,"mename"=>  array("text"=>"име",           "group"=>3,                       "type"=>"like",  "field"=>"name")
//	,"meaddr"=>  array("text"=>"адрес",         "group"=>3,                       "type"=>"like",  "field"=>"address")
# 29.05.2009 Бъзински - има данни и за съпруг 
# за търсене в данните и на съпруга 
,"mename"=>  array("text"=>"име",           "group"=>3,   "type"=>"nameall")
,"meaddr"=>  array("text"=>"адрес",         "group"=>3,   "type"=>"addrall")
	,"meagen"=>  array("text"=>"представител",  "group"=>3,                       "type"=>"like",  "field"=>"agent")
*/
					# ВНИМАНИЕ. 06.04.2010 - Софрониев 
					# Вече има отделни полета за взискател и длъжник 
# взискател - група=3 
//	,"merangclai"=>  array("text"=>"обхват",  "group"=>3,"spec"=>true,"source"=>"listcaserang",  "type"=>"")
	,"metypeclai"=>  array("text"=>"тип",     "group"=>3,  "source"=>"listmembtype",  "type"=>"equal", "field"=>"idtype")
	,"meidenclai"=>  array("text"=>"идентификация", "group"=>3,                       "type"=>"identi")
# 29.05.2009 Бъзински - има данни и за съпруг 
# за търсене в данните и на съпруга 
	,"menameclai"=>  array("text"=>"име",           "group"=>3,   "type"=>"nameall")
	,"meaddrclai"=>  array("text"=>"адрес",         "group"=>3,   "type"=>"addrall")
	,"meagenclai"=>  array("text"=>"представител",  "group"=>3,                       "type"=>"like",  "field"=>"agent")
# длъжник - група=4 
//	,"merangdebt"=>  array("text"=>"обхват",  "group"=>4,"spec"=>true,"source"=>"listcaserang",  "type"=>"")
	,"metypedebt"=>  array("text"=>"тип",     "group"=>4,  "source"=>"listmembtype",  "type"=>"equal", "field"=>"idtype")
	,"meidendebt"=>  array("text"=>"идентификация", "group"=>4,                       "type"=>"identi")
# 29.05.2009 Бъзински - има данни и за съпруг 
# за търсене в данните и на съпруга 
	,"menamedebt"=>  array("text"=>"име",           "group"=>4,   "type"=>"nameall")
	,"meaddrdebt"=>  array("text"=>"адрес",         "group"=>4,   "type"=>"addrall")
	,"meagendebt"=>  array("text"=>"представител",  "group"=>4,                       "type"=>"like",  "field"=>"agent")
);
//$filterlist= toutf8($filterlist);


# визуализиране на текущия филтър 
function filtvisu(){
global $filterlist;
					$visufilt= array();
	# разделяме полетата от филтъра по групи 
	foreach ($filterlist as $lifi=>$lico){
		$mycont= $_SESSION["filtco"][$lifi];
		$mycont= to1251($mycont);
//print "<br>[$lifi][$mycont]";
		if (empty($mycont)){
		}else{
			$mytext= $lico["text"];
			$mygrou= $lico["group"];
			$mysour= $lico["source"];
			if (empty($mysour)){
			}else{
//				if (strpos($mysour,"()")===false){
				if (strpos($mysour,"(")===false){
					$mycont= $GLOBALS[$mysour][$mycont];
				}else{
					eval("\$myresu= $mysour;");
					$mycont= $myresu[$mycont];
				}
			}
//print "$mycont";
					$visufilt[$mygrou][$lifi]= array($mytext,$mycont);
		}
	}
return $visufilt;
}

function getcof(){
	# за извеждане на "идва от" - кеширания масив 
	$arfrom= unserialize(file_get_contents(COFROMFILE));
return $arfrom;
}

function getuser(){
	# за извеждане на "деловодител" - формираме масив 
//	$userlist= getselect("user","name","1",true);
	$userlist= getselect("user","name","inactive=0",true);
	$userlist= dbconv($userlist);
return $userlist;
}

function bgdatetran($p1){
	$resu= bgdatefrom($p1);
return array($p1=>$resu);
}

# формиране на кода за филтъра по дела [1] 
function filtcrea($ligr){
global $filterlist;
//	# списък на групите полета 
//	$ligr= array(1,2);
					$arfilt= array();
	# разделяме полетата от филтъра по групи 
	foreach ($filterlist as $lifi=>$lico){
		$mycont= $_SESSION["filtco"][$lifi];
//print "<br>[$lifi][$mycont]";
//		$mycont= to1251($mycont);
		if (empty($mycont)){
		}else{
			$mygrou= $lico["group"];
			$mytype= $lico["type"];
			$myfiel= $lico["field"];
			if (in_array($lico["group"],$ligr)){
				if (empty($mytype)){
				}elseif ($mytype=="equal"){
					$arfilt[]= "$myfiel='$mycont'";
				}elseif ($mytype==">="){
					$arfilt[]= "date($myfiel)>='$mycont'";
//					# за да се игнорират часовете и да участват празните дати 
//					$arfilt[]= "date_sub(date($myfiel), interval 1 days) >'$mycont'";
//					$arfilt[]= "($myfiel - interval 1 days) >'$mycont'";
//					$arfilt[]= "subdate(date($myfiel),1) >'$mycont'";
				}elseif ($mytype=="<="){
					$arfilt[]= "date($myfiel)<='$mycont'";
//					# за да се игнорират часовете и да участват празните дати 
//					$arfilt[]= "date_add(date($myfiel), interval 1 days) <'$mycont'";
//					$arfilt[]= "($myfiel + interval 1 days) <'$mycont'";
//					$arfilt[]= "adddate(date($myfiel),1) <'$mycont'";
				}elseif ($mytype=="like"){
/*****
					$myco2= "%" .$mycont ."%";
					$arfilt[]= "upper($myfiel) like upper('$myco2')";
*****/

#---- СТАНДАРТ -----------------------------------------------------------------------------------------------------------
								# ВНИМАНИЕ. 
								# стринговете в данните съдържат спец.символи - единични/двойни кавички, tab, newline и др. 
								# трябва да може да търсим в тях и ако стринга за критерия съдържа кавички 
								# при записа на стринга dbsimple е направила трансформация с mysql_real_escape_string 
								# трябва да направим подобна трансформация и за критерия 
							# ВАЖНО. 
							# 1. правим две, а не една трансформация - за MySQL-dbsimple и за like 
							# 2. заместваме с функцията sprintf - тя екранира коректно и двата вида кавички 
					$mycoreal= mysql_real_escape_string($mycont);
					$mycoreal= mysql_real_escape_string($mycoreal);
					$myco2= "%" .$mycoreal ."%";
//print "<br>mycoreal<br>";
//var_dump($mycoreal);
					$arfilt[]= sprintf("upper($myfiel) like upper('%s')"  ,$myco2);
#---------------------------------------------------------------------------------------------------------------

				}elseif ($mytype=="identi"){
					# специфичен подход за идентификационните полета 
					# - според типа юридическо/физическо/други 
					$myco2= "%" .$mycont ."%";
					# юридическо 
					$_bulstat= "upper(bulstat) like upper('$myco2')";
					$_regidocu= "upper(regidocu) like upper('$myco2')";
					$_regidate= "upper(regidate) like upper('$myco2')";
					$_regicase= "upper(regicase) like upper('$myco2')";
						# релацията е "or" - текста да се съдържа поне в едно от полетата 
						$elem1= "($_bulstat or $_regidocu or $_regidate or $_regicase)";
					# физическо 
//					$_egn= "upper(egn) like upper('$myco2')";
# 29.05.2009 Бъзински - има данни и за съпруг 
$_egn= "(upper(egn) like upper('$myco2') or upper(egn2) like upper('$myco2'))";
						# текста да се съдържа само в ЕГН-то 
						$elem2= $_egn;
					# филтъра - според дали е избран типа или не 
					$metype= $_SESSION["filtco"]["metype"];
					if (empty($metype)){
						# няма избран тип юридическо/физическо/други 
						# филтъра е за всички типове 
						# за тип "други" - директно отрицание 
						$arfilt[]= "case idtype when 1 then ($elem1) when 2 then ($elem2) when 3 then ($elem1) else 0 end";
					}else{
						# избран е един от типовете юридическо/физическо/други 
						# филтъра е само за избрания тип 
						if (0){
						}elseif ($metype==1){
							$arfilt[]= $elem1;
						}elseif ($metype==2){
							$arfilt[]= $elem2;
						}elseif ($metype==3){
							# за тип "други" - директно отрицание 
							$arfilt[]= "0";
						}else{
die("filtcrea=2=$metype");
						}
					}

# 29.05.2009 - номер дело - или само един, или от-до 
				}elseif ($mytype=="serifromto"){
					list($seri,$seri2)= explode("-",$mycont);
					$seri= $seri +0;
					$seri2= $seri2 +0;
					if ($seri2==0){
						$arfilt[]= "suit.serial='$seri'";
					}else{
						$arfilt[]= "(suit.serial>='$seri' and suit.serial<='$seri2')";
					}

# 29.05.2009 Бъзински - търсене в името, вкл. и на съпруга 
				}elseif ($mytype=="nameall"){
								# ВНИМАНИЕ. виж стандарта за тип "like" по-горе 
								$mycoreal= mysql_real_escape_string($mycont);
								$mycoreal= mysql_real_escape_string($mycoreal);
								$myco2= "%" .$mycoreal ."%";
					$elem1= "upper(name) like upper('$myco2')";
					$elem2= "(upper(name) like upper('$myco2') or upper(name2) like upper('$myco2'))";
					# избрания тип - физич/юрид 
					$metype= $_SESSION["filtco"]["metype"];
					# филтъра според типа 
					if (empty($metype)){
						# няма избран тип юридическо/физическо/други 
						# филтъра е за всички типове, за тип "други" - директно отрицание 
						$arfilt[]= "case idtype when 1 then ($elem1) when 2 then ($elem2) when 3 then 0 else 0 end";
					}else{
						if (0){
						}elseif ($metype==1){
							$arfilt[]= $elem1;
						}elseif ($metype==2){
							$arfilt[]= $elem2;
						}elseif ($metype==3){
							$arfilt[]= "0";
						}else{
die("filtcrea=3=$metype");
						}
					}

# 29.05.2009 Бъзински - търсене в адреса, вкл. и на съпруга 
				}elseif ($mytype=="addrall"){
								# ВНИМАНИЕ. виж стандарта за тип "like" по-горе 
								$mycoreal= mysql_real_escape_string($mycont);
								$mycoreal= mysql_real_escape_string($mycoreal);
								$myco2= "%" .$mycoreal ."%";
					$elem1= "upper(address) like upper('$myco2')";
					$elem2= "(upper(address) like upper('$myco2') or upper(address2) like upper('$myco2'))";
					# избрания тип - физич/юрид 
					$metype= $_SESSION["filtco"]["metype"];
					# филтъра според типа 
					if (empty($metype)){
						# няма избран тип юридическо/физическо/други 
						# филтъра е за всички типове, за тип "други" - директно отрицание 
						$arfilt[]= "case idtype when 1 then ($elem1) when 2 then ($elem2) when 3 then 0 else 0 end";
					}else{
						if (0){
						}elseif ($metype==1){
							$arfilt[]= $elem1;
						}elseif ($metype==2){
							$arfilt[]= $elem2;
						}elseif ($metype==3){
							$arfilt[]= "0";
						}else{
die("filtcrea=4=$metype");
						}
					}
				
				}else{
die("filtcrea=1=$mytype");
				}
			}else{
			}
		}
	}
					if (count($arfilt)==0){
return "";
					}else{
return " and " .implode(" and ",$arfilt);
					}
}


?>