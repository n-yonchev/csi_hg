<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

					# 01.05.2009 - начално състояние - еднократно 
					# ако за табл.cofrom няма подредба, тоест serial=0 за всички записи 
					# формираме подредба по id и създаваме кешираните масиви 
					# източници : изпълняват същата функция : 
					#     _cofromcache.php 
					#     _cofrom/cache.php 
					$myco= $DB->selectCell("select count(*) from cofrom where serial<>0");
					if ($myco==0){
						$query= "select id as ARRAY_KEY, name from cofrom order by id";
						# масива UTF-8 
						$ardata= $DB->selectCol($query);
						$ardata= array(0=>"") + $ardata;
						file_put_contents($filename.SUFFUTF8,serialize($ardata));
						# масива windows-1251 
						$ardata= dbconv($ardata);
						file_put_contents($filename,serialize($ardata));
						# промени в таблицата 
						$serial= -1;
						foreach($ardata as $arin=>$x2){
							$serial ++;
							$DB->query("update cofrom set serial=?d where id=?d" ,$serial,$arin);
						}
					}else{
					}

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

//print_r($_SESSION);
									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "cofromedit.ajax.php";
										exit;
									}else{
									}
									
									# разглеждане на избран запис 
									$view= $GETPARAM["view"];
									if (isset($view)){
										include_once "cofromview.ajax.php";
										exit;
									}else{
									}
									
$relurl= geturl("mode=".$mode."&page=".$page);
								# вземане на избран запис - за преместване 
								$get= $GETPARAM["get"];
								if (isset($get)){
//									include_once "cofromview.ajax.php";
//									exit;
									$arfrom= unserialize(file_get_contents(COFROMFILE));
			$_SESSION["getcofrom"]= $get;
			$_SESSION["getcofromname"]= $arfrom[$get];
//print_r($_SESSION);
# redirect 
reload("",$relurl);
								}else{
								}
									
								# спускане на избран запис - с цел преместване 
								$put= $GETPARAM["put"];
								if (isset($put)){
									$arfrom= unserialize(file_get_contents(COFROMFILE.SUFFUTF8));
									$getind= $_SESSION["getcofrom"];
											$ar2= array();
//print_r($_SESSION);
//print "getind=[$getind]put=[$put]";
									foreach($arfrom as $arin=>$arco){
										if (0){
										}elseif ($arin==$getind){
										}elseif ($arin==$put){
											$ar2[$getind]= $arfrom[$getind];
											$ar2[$arin]= $arco;
										}else{
											$ar2[$arin]= $arco;
										}
									}
//print_r($arfrom);
//print_r($ar2);
							//chmod(COFROMFILE.SUFFUTF8,0777);
							unlink(COFROMFILE.SUFFUTF8);
									file_put_contents(COFROMFILE.SUFFUTF8,serialize($ar2));
									$ar2= dbconv($ar2);
							//chmod(COFROMFILE,0777);
							unlink(COFROMFILE);
									file_put_contents(COFROMFILE,serialize($ar2));
							$serial= -1;
							foreach($ar2 as $arin=>$x2){
								$serial ++;
								$DB->query("update cofrom set serial=?d where id=?d" ,$serial,$arin);
							}
			unset($_SESSION["getcofrom"]);
			unset($_SESSION["getcofromname"]);
# redirect 
//reload("",$relurl);
								}else{
								}

# списъка 
//$mylist= $DB->select("select * from cofrom order by name");
		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
//		$query= "select * from cofrom order by name";
//		$query= "select * from cofrom order by id";
		$query= "select * from cofrom order by serial";
		$prefurl= "";
		$baseurl= "mode=".$mode;
		$obpagi= new paginator(18, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

# трансформираме го - параметри за иконите 
				$modeel= "mode=".$mode ."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["view"]= geturl($modeel."&view=".$idcurr);
	$mylist[$uskey]["get"]= geturl($modeel."&get=".$idcurr);
	$mylist[$uskey]["put"]= geturl($modeel."&put=".$idcurr);
}

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("cofrom.tpl","fetch");

?>
