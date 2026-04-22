<?php
# 06.04.2016 - изх.документи - такси 


# типове действия 
$aractitype= array();
$aractitype[1]= "шаблон";
$aractitype[2]= "проучване";
$aractitype[3]= "такса";
$smarty->assign("ARACTITYPE", $aractitype);

# статуси за филтъра и подменю 
$artxvari= array();
$artxvari[1]= "активни";
$artxvari[2]= "игнорирани";
$artxvari[3]= "всички";
$smarty->assign("ARVARI", $artxvari);
		$artxvarifilt= array();
		$artxvarifilt[1]= "txordeelem.isigno=0";
		$artxvarifilt[2]= "txordeelem.isigno=1";
		$artxvarifilt[3]= "1";

# обхвати за филтъра 
$artxpoin= array();
$artxpoin[0]= "всички типове";
$artxpoin[90]= "";
$artxpoin[10]= "само шаблони - всички";
	$artxpoin[11]= "само шаблони - няма изх.док";
	$artxpoin[12]= "само шаблони - има неизходен изх.док";
	$artxpoin[13]= "само шаблони - има изходен изх.док";
					# 27.03.2018 флаг дали шаблона се изходява 
					# има формиран изходящ документ, който не подлежи на изходяване
					$artxpoin[14]= "само шаблони - има ИзхДок";
$artxpoin[91]= "";
$artxpoin[20]= "само проучвания - всички";
	$artxpoin[21]= "само проучвания - няма заявка";
	$artxpoin[22]= "само проучвания - има неизпълнена заявка";
	$artxpoin[23]= "само проучвания - изпълнена заявка";
$artxpoin[92]= "";
$artxpoin[30]= "само такси - всички";
	$artxpoin[31]= "само такси - без сума";
	$artxpoin[32]= "само такси - без предмет";
	$artxpoin[33]= "само такси - без фактура/сметка";
	$artxpoin[34]= "само такси - без аванс.вноска";
			# филтри за обхватите 
			# източник : шаблона cazop6.tpl 
			$artxpoinfilt= array();
			$artxpoinfilt[0]= "1";
			$artxpoinfilt[90]= "1";
			$artxpoinfilt[10]= "txordeelem.idtype=1";
				$artxpoinfilt[11]= "txordeelem.idtype=1 and txordeelem.p2poin=0";
# 26.03.2018 оправена грешка за групови шаблони 
$codeserial= "
if(t6dout.serial=0
	,if(t6dout.regigroup=0
		,''
		,concat(
			(select min(t7d.serial) from docuout as t7d where t7d.regigroup=t6dout.regigroup and t7d.serial<>0 group by t7d.regigroup)
			,'-',
			(select max(t7d.serial) from docuout as t7d where t7d.regigroup=t6dout.regigroup and t7d.serial<>0 group by t7d.regigroup)
			,'/',
			(select t7d.year from docuout as t7d where t7d.regigroup=t6dout.regigroup and t7d.serial<>0 limit 1)
		)
	)
	,concat(t6dout.serial,'/',t6dout.year)
)
";
//				$artxpoinfilt[12]= "txordeelem.idtype=1 and txordeelem.p2poin<>0 and t6dout.serial=0";
//				$artxpoinfilt[13]= "txordeelem.idtype=1 and txordeelem.p2poin<>0 and t6dout.serial<>0";
				//$artxpoinfilt[12]= "txordeelem.idtype=1 and txordeelem.p2poin<>0 and $codeserial=''";
				//$artxpoinfilt[13]= "txordeelem.idtype=1 and txordeelem.p2poin<>0 and $codeserial<>''";
				$artxpoinfilt[12]= "txordeelem.idtype=1 and txordeelem.p2poin<>0 and $codeserial='' and t6docutype.isnoregi=0";
				$artxpoinfilt[13]= "txordeelem.idtype=1 and txordeelem.p2poin<>0 and $codeserial<>''";
					# 27.03.2018 флаг дали шаблона се изходява 
					# има формиран изходящ документ, който не подлежи на изходяване
					$artxpoinfilt[14]= "txordeelem.idtype=1 and txordeelem.p2poin<>0 and $codeserial='' and t6docutype.isnoregi<>0";
#---------------------------------------------------------------------------------------------------------
			$artxpoinfilt[91]= "1";
			$artxpoinfilt[20]= "txordeelem.idtype=2";
				$artxpoinfilt[21]= "txordeelem.idtype=2 and t2info.id is null";
				$artxpoinfilt[22]= "txordeelem.idtype=2 and t2info.id is not null and t2info.attached=''";
				$artxpoinfilt[23]= "txordeelem.idtype=2 and t2info.id is not null and t2info.attached<>''";

			$artxpoinfilt[92]= "1";
			$artxpoinfilt[30]= "txordeelem.idtype=3";
				$artxpoinfilt[31]= "txordeelem.idtype=3 and txordeelem.txsuma+0=0";
				$artxpoinfilt[32]= "txordeelem.idtype=3 and txordeelem.txsuma+0<>0 and txordeelem.idsubj=0";
//				$artxpoinfilt[33]= "txordeelem.idtype=3 and txordeelem.txsuma+0<>0 and txordeelem.idsubj<>0 and txordeelem.idbill=0";
				$artxpoinfilt[33]= "txordeelem.idtype=3 and txordeelem.txsuma+0<>0 and txordeelem.idbill=0";
				$artxpoinfilt[34]= "txordeelem.idtype=3 and txordeelem.txsuma+0<>0 and txordeelem.idadva=0";

# 13.10.2016 - евент.планирана такса по т.26 
# код на таксата за т.26 - да съвпада със SMET.TXT 
$code26= "1^pt26";
$smarty->assign("CODE26", $code26);

# всички индекси на обхвати, които са за такси 
$arindxtaxe= array(30,31,32,33,34);

# всички индекси на обхвати, които са неизпълнени задачи 
$arindxnotdone= array(11,12,  21,22,  31,32,33,34);

# само такси - за формите с чекбоксове 
$taxeonly= "txordeelem.idtype=3 and txordeelem.txtota+0<>0";


														# проучване 
														include_once "debtinfo.inc.php";
# 24.04.2018 добавяме типове НАП и БНБ 
//global $arinfotype;
						$base2nap= 20;
	$smarty->assign("BASE2NAP",$base2nap);
						$name2nap= toutf8("НАП ");
						$base2bnb= 40;
						$name2bnb= toutf8("БНБ");
				$ar2nap= $DB->selectCol("select id+$base2nap as ARRAY_KEY, concat('$name2nap',name) from debtnapvari order by serial");
						$ar2naptype= dbconv($ar2nap);
				$GLOBALS["arinfotype"] += $ar2naptype;
				$GLOBALS["arinfotype"][$base2bnb+1]= tran1251($name2bnb);
//print_ru($arinfotype);
	$smarty->clear_assign("ARINFOTYPE");
	$smarty->assign("ARINFOTYPE", $arinfotype);
	
	$GLOBALS["arinfotype2"]= toutf8($arinfotype);
	unset($GLOBALS["arinfotype2"][0]);
				$GLOBALS["arinfotype2"] += $ar2nap;
				$GLOBALS["arinfotype2"][$base2bnb+1]= $name2bnb;
	$smarty->assign("ARINFOTYPENAME", "arinfotype2");
	$smarty->assign("ARINFOTYPE2", tran1251($arinfotype2));
//print_rr($arinfotype2);

# създаване заявка за проучване длъжник 
function putdebtqu($goinfo){
global $DB;
	$roelem= getrow("txordeelem",$goinfo);
		$aset= array();
		$aset["iddebtor"]= $roelem["idex"];
		$aset["idtype"]= $roelem["idpoin"];
		$aset["iduser"]= $_SESSION["iduser"];
	$idinfonew= $DB->query("insert into debtinfo set ?a, created=now()"  ,$aset);
	$DB->query("update txordeelem set p2poin=$idinfonew where id=$goinfo");
}



# записва общата сума за отделна планирана такса 
function updatxtota($idelem){
global $DB, $ardefi;
		$roelem= getrow("txordeelem",$idelem);
	$code= $roelem["code"];
	$txquan= $roelem["txquan"];
	$txsuma= $roelem["txsuma"];
		$isvat= ($ardefi[$code]["novat"]<>"1");
	$coefvat= ($isvat)?1.2:1;
	$txtota= round($txquan*$txsuma*$coefvat,2);
	$DB->query("update txordeelem set txtota='$txtota' where id=?d"  ,$idelem);
}

# връща общата сума за списък планирани такси 
# с/без ДДС - за всяка отделна такса 
# източник : txelinvo.ajax.php - формиране фактура/сметка 
# списъка е стринг txordeelem.id, разделени със запетая 
function getsumataxe($p1){
global $DB;
/*
		#-- списък такси 
		$ard2= $DB->select("
			select code, txquan, txsuma
			from txordeelem
			where txordeelem.id in ($p1)
			");
					$basevat= 0;
					$basenovat= 0;
		#-- изчисления 
		foreach($ard2 as $elem){
			$code= $elem["code"];
			$txquan= $elem["txquan"];
			$txsuma= $elem["txsuma"];
				$isvat= ($ardefi[$code]["novat"]<>"1");
			if ($isvat){
					$basevat += round($txquan*$txsuma,2);
			}else{
					$basenovat += round($txquan*$txsuma,2);
			}
		}
		#-- обща сума 
		$totasuma= round(1.2*$basevat,2) + $basenovat;
*/
		$tosuma= $DB->selectCell("
			select sum(txtota)
			from txordeelem
			where txordeelem.id in ($p1)
			");
		$totasuma= round($tosuma,2);
return $totasuma;
}



# шаблони изх.документи 
$ardocutype= getselect("docutype","text","ishidden=0",false);
$smarty->assign("ARDOCUTYPE", tran1251($ardocutype));
//print_rr($ardocutype);
														# дефиниции такси 
															include_once "invo.inc.php";
														list($argrou,$ardefi)= getbill();
//print_rr($ardefi);
														$smarty->assign("ARDEFI", tran1251($ardefi));
	$artaxe= array();
foreach($ardefi as $code=>$elem){
	$artaxe[$code]= $elem["txgrou"]." ".$elem["txdesc"];
}
//$smarty->assign("ARTAXE", $artaxe);
														# проучване 
														//include_once "debtinfo.inc.php";

# обобщена информация за списък такси от разпореждане 
function getinfotx($txcode){
global $DB, $ardefi;
	$arelem= $DB->select("select * from txordeelem where id in ($txcode)");
						$sum2= 0;
						$tex2= "";
						$cla2= "";
	foreach($arelem as $elem){
		$code= $elem["code"];
/*
		$tsum= $elem["txquan"]*$elem["txsuma"];
			$tsum= round($tsum,2);
		$isnovat= ($ardefi[$code]["novat"]=="1");
		$tsum= ($isnovat?1:1.2)*$tsum;
			$tsum= round($tsum,2);
*/
		$tsum= $elem["txtota"];
						$sum2 += $tsum;
//						$tex2 .= $ardefi[$code]["txgrou"]." ";
						$tex2 .= $ardefi[$code]["txgrou"] ." ".$elem["notes"];
							$idex= $elem["idex"]." ";
							if (strpos($cla2,$idex)===false){
						$cla2 .= $elem["idex"]." ";
							}else{
							}
#----- дв-86/17----- 
$x2idt2= $elem["idt2"];
	}
						$tex2= trim($tex2);
						$cla2= trim($cla2);
//return array($tex2,$sum2,$cla2);
return array($tex2,$sum2,$cla2  ,$x2idt2);
}

/***
# сесийни променливи за формиране предмет от няколко такси в разпореждане 
#-- създаване 
function creasubjsess_1($p1){
	$_SESSION["txplan_creasubj_list"]= $p1;
}
#-- унищожаване 
function creasubjsess_2(){
	unset($_SESSION["txplan_creasubj_list"]);
	unset($_SESSION["txplan_creasubj"]);
	unset($_SESSION["txplan_is1_subj"]);
}

# сесийни променливи за формиране фактура/сметка от няколко такси в разпореждане 
#-- създаване 
function creainvosess_1($p1,$p2){
	$_SESSION["txplan_creainvo_list"]= $p1;
	$_SESSION["txplan_creainvo_flag"]= $p2;
}
#-- унищожаване 
function creainvosess_2(){
	unset($_SESSION["txplan_creainvo_list"]);
	unset($_SESSION["txplan_creainvo_flag"]);
}
***/

# целия списък действия за щаблон - от таблицата в сесията 
function data2sess($idgr,$isorde){
global $DB;
										#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
										global $lnsessname;
					# всички длъжници 
					$ardebt= getardebt();
								# само за разпореждане - и 1вия взискател за платец 
								$id1clai= get1clai();
//print "<br>ARDEBT=";
//print_rr($ardebt);
//print "<br>IDCLAI=$id1clai";
		$arcont= $DB->select("select *, id as ARRAY_KEY from txactigrelem where idgr=? order by id" ,$idgr);
		//$arcont= dbconv($arcont);
//print "<br>=============arcont=";
//+++++print_rr($arcont);
//file_put_contents("SESS.TXT","\n"."===data2sess=arcont==="."\n".print_r($arcont,true),FILE_APPEND);
										#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
										$aridse= array();
												$arno5= array();
		foreach($arcont as $id5=>$elem){
					$aset= array();
					$aset["type"]= $elem["idtype"];
					$aset["notes"]= $elem["notes"];
			$txtype= $elem["idtype"];
//"""""""""""""""""""""""""""""print "-------$txtype--------";

			if ($txtype==1){
					$aset["idtemp"]= $elem["idpoin"];
$arsess[]= $aset;
$aridse[$id5][0]= $lnsessname + count($arsess)-1;
//""""""""""""""""""""""""""""print "<br>-----arsess-----";
//""""""""""""""""""""""""""""print_rr($arsess);
//										$aridse[$id3=$elem["id"]]= count($arsess)-1;
							# добавяме таксите, свързани с шаблона 
							# за текущия шаблон - всички записи с такси, свързани с него 
							//$arwork= multinit($arcont,$id5,&$arno5);
							//multtaxe($arwork,$id1clai,$id5,0  ,$arsess,$aridse);
/*
							foreach($arwork as $elwork){
								$asetwork["type"]= $elwork["idtype"];
								$asetwork["notes"]= $elwork["notes"];
								$asetwork["taxecode"]= $elwork["code"];
								$asetwork["idclai"]= $id1clai;
//								$asetwork["insess"]= $aridse[$id5][$iddebt];
								$asetwork["insess"]= $aridse[$id5][0];
$arsess[]= $asetwork;
							}
*/

			}elseif ($txtype==2){
					$aset["idinfo"]= $elem["idpoin"];
								# само за разпореждане - всички длъжници физ.лица 
								if ($isorde){
/***
//					$aset["ardebt"]= getardebt();
					$ardebt= getardebt();
					if (empty($ardebt)){
$arsess[]= $aset;
					}else{
						foreach($ardebt as $iddebt){
							$aset["iddebt"]= $iddebt;
$arsess[]= $aset;
						}
					}
***/
					//$ardebt= getardebt();
					if (empty($ardebt)){
$arsess[]= $aset;
$aridse[$id5][0]= $lnsessname + count($arsess)-1;
//"""""""""""""""""""""""""print "<br>-----arsess-orde=1-empty.ardebt-----";
//"""""""""""""""""""""""""print_rr($arsess);
//										$aridse[$id3=$elem["id"]]= count($arsess)-1;
							# добавяме таксите, свързани с проучването - даже ако няма длъжници 
							# за текущото проучване - всички записи с такси, свързани с него 
							//$arwork= multinit($arcont,$id5,&$arno5);
							//multtaxe($arwork,$id1clai,$id5,0  ,$arsess,$aridse);
/*
							foreach($arwork as $elwork){
								$asetwork["type"]= $elwork["idtype"];
								$asetwork["notes"]= $elwork["notes"];
								$asetwork["taxecode"]= $elwork["code"];
								$asetwork["idclai"]= $id1clai;
//								$asetwork["insess"]= $aridse[$id5][$iddebt];
								$asetwork["insess"]= $aridse[$id5][0];
$arsess[]= $asetwork;
							}
*/
					}else{
										# за текущото проучване - всички записи с такси, свързани с него 
										//@@@ $arwork= multinit($arcont,$id5,&$arno5);
										/**/
													$arwork= array();
										foreach($arcont as $i6=>$e6){
											if ($e6["p1poin"]==$id5){
													$arwork[]= $e6;
												$arno5[$i6]= 1;
											}else{
											}
										}
										/**/
						# текущото проучване - за всички длъжници 
						foreach($ardebt as $iddebt){
							$aset["iddebt"]= $iddebt;
$arsess[]= $aset;
# 23.04.2018 оправена ВАЖНА ГРЕШКА 
//@@@@@@@@@@@@@@@@@@@@@@@@@$aridse[$id5][0]= $lnsessname + count($arsess)-1;
$aridse[$id5][$iddebt]= $lnsessname + count($arsess)-1;
//"""""""""""""""""""""""print "<br>-----arsess-orde=1-IDdebt=$iddebt-----";
//"""""""""""""""""""""""print_rr($arsess);
//										$aridse[$id3=$elem["id"]]= count($arsess)-1;
							# за текущото проучване/длъжник - всички такси 
//print "<br>ARWORK=";
//print_ru($arwork);
							multtaxe($arwork,$id1clai,$id5,$iddebt  ,$arsess,$aridse);
/*
#---------------------------------------------
							foreach($arwork as $elwork){
								$asetwork["type"]= $elwork["idtype"];
								$asetwork["notes"]= $elwork["notes"];
								$asetwork["taxecode"]= $elwork["code"];
								$asetwork["idclai"]= $id1clai;
								$asetwork["insess"]= $aridse[$id5][$iddebt];
$arsess[]= $asetwork;
							}
#---------------------------------------------
*/
						}
					}
								}else{
$arsess[]= $aset;
$aridse[$id5][0]= $lnsessname + count($arsess)-1;
//""""""""""""""""""""print "<br>-----arsess------";
//""""""""""""""""""""print_rr($arsess);
								# if ($isorde){
								}

			}elseif ($txtype==3){
//+++++print "[txtype=3]";
//file_put_contents("SESS.TXT","\n"."===data2sess=txtype3=elem==="."\n".print_r($elem,true),FILE_APPEND);
//file_put_contents("SESS.TXT","\n"."===data2sess=txtype3=arno5==="."\n".print_r($arno5,true),FILE_APPEND);
//file_put_contents("SESS.TXT","\n"."===data2sess=txtype3=id5==="."\n".var_export($id5,true),FILE_APPEND);
												if (isset($arno5[$id5])){
//file_put_contents("SESS.TXT","\n"."===data2sess=txtype3===isset",FILE_APPEND);
												}else{
//file_put_contents("SESS.TXT","\n"."===data2sess=txtype3===NOTSET",FILE_APPEND);
									#----- дв-86/17----- 
									$aset["idt2"]= $elem["idt2"] +0;
									$aset["idgrelem"]= $id5;
					$aset["taxecode"]= $elem["code"];
					//$aset["taxec1"]= $elem["p1type"];
					//$aset["taxec2"]= $elem["p1poin"];
										$id3= $elem["p1poin"];
										$idse= $aridse[$id3][0];
//+++++mp($idse);
//print "<br>idse=";
//print_rr($aridse);
//print "<br>type=3=[$id5][$id3][$idse]";
										if (isset($idse)){
					$aset["insess"]= $idse;
										}else{
										}
								# само за разпореждане - и 1вия взискател за платец 
								if ($isorde){
//					$aset["idclai"]= get1clai();
					$aset["idclai"]= $id1clai;
								}else{
								}
$arsess[]= $aset;
//file_put_contents("SESS.TXT","\n"."===data2sess=aset==="."\n".print_r($aset,true),FILE_APPEND);
//"""""""""""""""""""""""""print "<br>-----arsess-----";
//"""""""""""""""""""""""""print_rr($arsess);
												}

			}else{
//file_put_contents("SESS.TXT","\n"."===data2sess=TXTYPE-ELSE==="."\n".var_export($txtype,true),FILE_APPEND);
			}
//$arsess[]= $aset;
//file_put_contents("SESS.TXT","\n"."===data2sess=COUNT=arsess==="."\n".count($arsess),FILE_APPEND);
//file_put_contents("SESS.TXT","\n"."===data2sess=ARSESS-END-CYCLE==="."\n".print_r($arsess,true),FILE_APPEND);
//"""""""""""""""""""""print "<br>-----aridse-after-----";
//"""""""""""""""""""""print_rr($aridse);
		}
//file_put_contents("SESS.TXT","\n"."===data2sess=arsess==="."\n".print_r($arsess,true),FILE_APPEND);
return $arsess;
}

function multinit($arcont,$id5,&$arno5){
								$arwork= array();
					foreach($arcont as $i6=>$e6){
						if ($e6["p1poin"]==$id5){
								$arwork[]= $e6;
							$arno5[$i6]= 1;
						}else{
						}
					}
//file_put_contents("SESS.TXT","\n"."===multinit=arwork==="."\n".print_r($arwork,true),FILE_APPEND);
return $arwork;
}

function multtaxe($arwork,$id1clai,$id5,$ind2  ,&$arsess,&$aridse){
										global $lnsessname;
//"""""""""""""""""print "<br>-----multtaxe[$id5][$ind2]------";
		foreach($arwork as $elwork){
				$asetwork= array();
			$asetwork["type"]= $elwork["idtype"];
			$asetwork["notes"]= $elwork["notes"];
			$asetwork["taxecode"]= $elwork["code"];
			$asetwork["idclai"]= $id1clai;
			$asetwork["insess"]= $aridse[$id5][$ind2];
//"""""""""""""""""print "<br>-----get.insess";
//"""""""""""""""""var_dump($asetwork["insess"]);
									#----- дв-86/17----- 
									$asetwork["idt2"]= $elwork["idt2"] +0;
									$asetwork["idgrelem"]= $id5;
$arsess[]= $asetwork;
# 23.04.2018 оправена ВАЖНА ГРЕШКА 
//@@@@@@@@@@@@@@@@@@aridse[$id5][$ind2]= $lnsessname + count($arsess)-1;
//""""""""""""""""""print "<br>-----aridse-after-MULT-----";
//""""""""""""""""""print_rr($aridse);
		}
}


# списък действия за щаблон/разпореждане - от сесията в таблицата 
function sess2data($ardata,$taname,$finame,$idgr){
global $DB, $ardefi;
							$arinsess= array();
//print_ru($ardata);
//file_put_contents("SESS.TXT","\n".print_r($ardata,true),FILE_APPEND );
		foreach($ardata as $insess=>$elem){
					$aset= array();
					$aset[$finame]= $idgr;
					$aset["notes"]= $elem["notes"];
					$aset["idtype"]= $elem["type"];
			$txtype= $elem["type"];
//print "[$txtype][$finame]";
			if ($txtype==1){
					$aset["idpoin"]= $elem["idtemp"];
//print_ru($aset);
$idnew= $DB->query("insert into $taname set ?a" ,$aset);
							$arinsess[$insess]= $idnew;
			}elseif ($txtype==2){
					$aset["idpoin"]= $elem["idinfo"];
						/*
						$arde2= $elem["ardebt"];
						if (isset($arde2)){
							foreach($arde2 as $idde2){
								$aset["idex"]= $idde2;
$DB->query("insert into $taname set ?a" ,$aset);
							}
						}else{
$DB->query("insert into $taname set ?a" ,$aset);
						}
						*/
								if ($finame=="idorde"){
									$aset["idex"]= $elem["iddebt"] +0;
								}else{
								}
//print_ru($aset);
$idnew= $DB->query("insert into $taname set ?a" ,$aset);
							$arinsess[$insess]= $idnew;
								if ($finame=="idorde"){
												# 24.04.2018 ДИРЕКТНО 
												# създаване заявка за проучване 
global $base2nap, $base2bnb;
												$idpo2= $aset["idpoin"];
//print "<br>[$txtype][$finame][$idpo2][$base2nap][$base2bnb]";
												if ($idpo2<$base2nap){
													# нормално 
//print "=regu";
//die;
													putdebtqu($idnew);
												}elseif ($idpo2<$base2bnb){
//print "=NAP";
//die;
													# НАП - в опашката 
													$idpo4= $idpo2 -$base2nap;
													$idde4= $aset["idex"];
# копирано от cazo34.inc.php 
$idnew4= $DB->query("insert into debtnap set iddebtor=?d, napdocu='?', idvari=?d, created=now(), iduser=?d"  ,$idde4,$idpo4,$_SESSION["iduser"]);
# линк към списъка планиране елементи 
$DB->query("update txordeelem set p2poin=?d where id=?d"  ,$idnew4,$idnew);
//print "<h2>[$idnew][$idnew4]</h2>";
//die;
												}else{
//print "=bnb";
//die;
													# БНБ - в опашката 
													//$idpo4= $idpo2 -$base2bnb;
													$idde4= $aset["idex"];
# копирано от cazo34.inc.php - debtinfo.inc.php 
$idnew4= putbnbqu($idde4);
# линк към списъка планиране елементи 
$DB->query("update txordeelem set p2poin=?d where id=?d"  ,$idnew4,$idnew);
												}
								}else{
								# if ($finame=="idorde"){
								}
			}elseif ($txtype==3){
					$aset["code"]= $elem["taxecode"];
								# сумата 
								$txel= $ardefi[$txco=$elem["taxecode"]];
								if ($txel["calc"]=="fixi"){
					$aset["txsuma"]= $txel["perc"];
								}else{
								}
					//$aset["p1type"]= $elem["taxec1"];
					//$aset["p1poin"]= $elem["taxec2"];
						$in2= $elem["insess"];
						$in4= $arinsess[$in2];
						if (isset($in4)){
					# таксата е обвързана 
					$aset["p1poin"]= $in4;
						}else{
					# таксата не е обвързана - директно статус за обработка 
					$aset["txstat"]= 1;
					# - и директно количество =1 
					$aset["txquan"]= 1;
						}
								if ($finame=="idorde"){
					$aset["idex"]= $elem["idclai"] +0;
								}else{
								}
									#----- дв-86/17----- 
									$aset["idt2"]= $elem["idt2"];
//print_ru($aset);
$id4= $DB->query("insert into $taname set ?a" ,$aset);
# записваме общата стойност за таксата 
updatxtota($id4);
			}else{
			}
		}
}

# за редактиране на действия - шаблон или разпореждане 
function txactiedit($mfacproc,$txsessname,$isorde){
global $DB, $smarty;
//+++++print "<br>---------------txactiedit----------------";
//+++++print "<br>mfac=".$mfacproc;
/*
				# 24.04.2018 добавяме типове НАП и БНБ 
global $arinfotype;
						$base2nap= 20;
						$name2nap= toutf8("НАП ");
						$base2bnb= 40;
						$name2bnb= toutf8("БНБ");
				$ar2nap= $DB->selectCol("select id+$base2nap as ARRAY_KEY, concat('$name2nap',name) from debtnapvari order by serial");
						$ar2naptype= dbconv($ar2nap);
				$GLOBALS["arinfotype"] += $ar2naptype;
				$GLOBALS["arinfotype"][$base2bnb+1]= tran1251($name2bnb);
//print_ru($arinfotype);
	$smarty->clear_assign("ARINFOTYPE");
	$smarty->assign("ARINFOTYPE", $arinfotype);
*/							
							$retucode= 99;

#------ отказ от заявка за добавяне 
if ($mfacproc=="cancel"){
							$retucode= 9;
							$smarty->assign("STATUS","list");
#------ заявка добави действие 
}elseif ($mfacproc=="addacti"){
							$retucode= 11;
							$smarty->assign("STATUS","addacti");
	# добави шаблон - във формата 
//	$ardocutype= getselect("docutype","text","ishidden=0",false);
global $ardocutype;
	$smarty->assign("ARDOCUTYPENAME", "ardocutype");
	# добави проучване - във формата 
global $arinfotype;
/*
	$GLOBALS["arinfotype2"]= toutf8($arinfotype);
	unset($GLOBALS["arinfotype2"][0]);
				$GLOBALS["arinfotype2"] += $ar2nap;
				$GLOBALS["arinfotype2"][$base2bnb+1]= $name2bnb;
	$smarty->assign("ARINFOTYPENAME", "arinfotype2");
*/
	# добави такса - във формата 
	//$artaxe2= toutf8($artaxe);
global $artaxe;
	$GLOBALS["artaxe2"]= $artaxe;
	//unset($arinfotype2[0]);
	$smarty->assign("ARTAXENAME", "artaxe2");
				$arco2= array(""=>"");
				if (empty($_SESSION[$txsessname])){
				}else{
	foreach($_SESSION[$txsessname] as $insess=>$elem){
		$txtype= $elem["type"];
		/*
		if ($txtype==1){
			$idtemp= $elem["idtemp"];
				$arco2[$txtype."^".$idtemp]= toutf8("шаблон ").$ardocutype[$idtemp];
		}elseif ($txtype==2){
			$idinfo= $elem["idinfo"];
				$arco2[$txtype."^".$idinfo]= toutf8("проучване ".$arinfotype[$idinfo]);
		}else{
		}
		*/
		if ($txtype==1){
			$idtemp= $elem["idtemp"];
				$arco2[$insess]= toutf8("шаблон ").$ardocutype[$idtemp];
		}elseif ($txtype==2){
			$idinfo= $elem["idinfo"];
				$arco2[$insess]= toutf8("проучване ".$arinfotype[$idinfo]);
						if ($isorde){
				$arco2[$insess] .= toutf8(" за ".$GLOBALS["ardebt2"][$id3=$elem["iddebt"]]);
						}else{
						}
		}else{
		}
	}
				}
//print_rr($arco2);
//	$arconn2= toutf8($arconn);
	$GLOBALS["arconn"]= $arco2;
//+++++print "<br>arconn=";
//+++++print_rr($GLOBALS["arconn"]);
//print "<br><br>====";
//var_dump($GLOBALS["arconn"]);
	$smarty->assign("ARCONNNAME", "arconn");

#------ добавяне шаблон 
}elseif ($mfacproc=="addtemp"){
							$retucode= 12;
							$smarty->assign("STATUS","list");
		$arelem= array();
		$arelem["type"]= 1;
		$arelem["notes"]= $_POST["notes1"];
		$arelem["idtemp"]= $_POST["idtemp"];
	$_SESSION[$txsessname][]= $arelem;

#------ добавяне проучване длъжник 
}elseif ($mfacproc=="addinfo"){
							$retucode= 22;
							$smarty->assign("STATUS","list");
		$arelem= array();
		$arelem["type"]= 2;
		$arelem["notes"]= $_POST["notes2"];
		$arelem["idinfo"]= $_POST["idinfo"];
					if ($isorde){
		$arelem["iddebt"]= $_POST["iddebtpost"];
					}else{
					}
					/*
					# само за разпореждане - всички длъжници физ.лица 
					if ($isorde){
						$idcase= $GLOBALS["edit"];
						$ardebt= $DB->selectCol("select id from debtor where idcase=?d and idtype=2 order by id"  ,$idcase);
		$arelem["ardebt"]= $ardebt;
					}else{
					}
					*/
					/***
					# само за разпореждане - всички длъжници физ.лица 
					if ($isorde){
		$arelem["ardebt"]= getardebt();
					}else{
					}
					***/
	$_SESSION[$txsessname][]= $arelem;

#------ добавяне такса 
}elseif ($mfacproc=="addtaxe"){
							$retucode= 32;
							$smarty->assign("STATUS","list");
		$arelem= array();
		$arelem["type"]= 3;
		$arelem["notes"]= $_POST["notes3"];
		$arelem["taxecode"]= $_POST["taxecode"];
		/*
			list($c1,$c2)= explode("^",$_POST["taxeconn"]);
		$arelem["taxec1"]= $c1;
		$arelem["taxec2"]= $c2;
		*/
				# 22.06.2018 ОПРАВЕНА ВАЖНА ГРЕШКА 
				$taxeconn= $_POST["taxeconn"];
				if ($taxeconn===""){
				}else{
		$arelem["insess"]= $_POST["taxeconn"];
				}
					/*
					# само за разпореждане - и 1вия взискател за платец 
					if ($isorde){
						$idcase= $GLOBALS["edit"];
						$idclai= $DB->selectCell("select id from claimer where idcase=?d order by id limit 1"  ,$idcase);
									//$_POST["idclai"]= array($idclai);
		$arelem["idclai"]= $idclai;
					}else{
					}
					*/
					# само за разпореждане - и 1вия взискател за платец 
					if ($isorde){
		$arelem["idclai"]= get1clai();
					}else{
					}
									#----- дв-86/17----- 
									$arelem["idt2"]= $_POST["idt2"];
//print_ru($arelem);
//die("WWWWWWWWWWWWWWWW");
	$_SESSION[$txsessname][]= $arelem;

#------ изтриване действие 
}elseif (substr($mfacproc,0,4)=="dele"){
							$retucode= 41;
	$seindx= substr($mfacproc,4) +0;
	unset($_SESSION[$txsessname][$seindx]);
							$smarty->assign("STATUS","list");

#------ корекция длъжник физ.лице за проучване - формата 
}elseif (substr($mfacproc,0,8)=="debtorde"){
							$retucode= 63;
	$seindx= substr($mfacproc,8) +0;
//	$_POST["ardebtpost"]= $_SESSION[$txsessname][$seindx]["ardebt"];
	$_POST["notes2"]= $_SESSION[$txsessname][$seindx]["notes"];
	$smarty->assign("SEINDX",$seindx);
							$smarty->assign("STATUS","debtorde");

#------ корекция длъжник физ.лице за проучване 
}elseif (substr($mfacproc,0,8)=="debtsubm"){
							$retucode= 64;
	$seindx= substr($mfacproc,8) +0;
//	$_SESSION[$txsessname][$seindx]["ardebt"]= $_POST["ardebtpost"];
	$_SESSION[$txsessname][$seindx]["iddebt"]= $_POST["iddebtpost"];
	$_SESSION[$txsessname][$seindx]["notes"]= trim($_POST["notes2"]);
							$smarty->assign("STATUS","list");

#------ корекция платец на такса - формата 
}elseif (substr($mfacproc,0,8)=="claiorde"){
							$retucode= 65;
	$seindx= substr($mfacproc,8) +0;
	$_POST["notes3"]= $_SESSION[$txsessname][$seindx]["notes"];
	$smarty->assign("SEINDX",$seindx);
							$smarty->assign("STATUS","claiorde");

#------ корекция платец на такса 
}elseif (substr($mfacproc,0,8)=="claisubm"){
							$retucode= 66;
	$seindx= substr($mfacproc,8) +0;
	$_SESSION[$txsessname][$seindx]["idclai"]= $_POST["idclaipost"];
	$_SESSION[$txsessname][$seindx]["notes"]= trim($_POST["notes3"]);
							$smarty->assign("STATUS","list");
}

return $retucode;
}

/***
# връща всички длъжници физ.лица за делото $edit 
function getardebt(){
global $DB;
	$idcase= $GLOBALS["edit"];
	$ardebt= $DB->selectCol("select id from debtor where idcase=?d and idtype=2 order by id"  ,$idcase);
return $ardebt;
}
***/
# 11.10.2018 - планиране 2 
# връща всички длъжници за делото $edit 
function getardebt(){
global $DB;
	$idcase= $GLOBALS["edit"];
	$ardebt= $DB->selectCol("select id from debtor where idcase=?d order by id"  ,$idcase);
return $ardebt;
}

# връща claimer.id на 1вия взискател за платец 
function get1clai(){
global $DB;
	$idcase= $GLOBALS["edit"];
	$idclai= $DB->selectCell("select id from claimer where idcase=?d order by id limit 1"  ,$idcase);
return $idclai;
}

# сръща код за предмет 
function getcodesubj($tana){
		$codeot= toutf8(" € от ");
		$codeza= toutf8(" за ");
	$codesubj= "concat($tana.amount,'$codeot',date_format($tana.fromdate,'%d.%m.%Y'),'$codeza',$tana.text)";
return $codesubj;
}

# базова заявка за списък действия 
function getplanqu($filt){
global $codeserial;
global $base2nap, $base2bnb;
	$codesubj= getcodesubj("t2subj");
	$quplan= "select
		txordeelem.id as ARRAY_KEY, txordeelem.*, txorde.created as ordecrea, txorde.idcase
				, txorde.idrang, txorde.created, txorde.iddout
								/* за тип 1 шаблон - име на шаблона */
				, t2temp.text as temptext
								/* за тип 2 проучване длъжник - име на длъжника */
				, t2debt.name as debtname
/*--- 24.04.2018 добавяме типове НАП и БНБ ---*/
/*** 
, if(t2info.id is null,0,1) as isinfo, t2info.attached as infoatta, t2info.isnodata as infonodata 
***/
		/* има-няма заявка */
, (case when txordeelem.idpoin<$base2nap then if(t2info.id is null,0,1) when txordeelem.idpoin<$base2bnb then if(t2nap.id is null,0,1) 
else if(t2bnb.id is null,0,1) end) as isinfo
		/* има : изпълнена-неизпълнена заявка */
/***
, (case when txordeelem.idpoin<$base2nap then t2info.attached when txordeelem.idpoin<$base2bnb then if(t2nap.napdocu='?' or t2nap.napdocu='','',t2nap.napdocu) 
else t2bnb.cont end) as infoatta
***/
					/*@@@@@@@@ 15.05.2019 ВАЖНО ДОПЪЛНЕНИЕ по мейл от Борислав Павлов @@@@@@@@*/
					, (case 
						when txordeelem.idpoin<$base2nap then t2info.attached 
						when txordeelem.idpoin<$base2bnb then if(t2nap.napdocu='?' or t2nap.napdocu='*' or t2nap.napdocu='','',t2nap.napdocu) 
						else t2bnb.cont 
					end) as infoatta
		/* има изпълнена заявка : има-няма информация */
, (case when txordeelem.idpoin<$base2nap then t2info.isnodata when txordeelem.idpoin<$base2bnb then if(t2nap.napdocu='',1,0) 
else if(t2bnb.cont='*',1,0) end) as infonodata
								/* за тип 3 такса - име на платеца взискател/длъжник */
				, t2clai.name as clainame
				, t26debt.name as debt26name
										/* текст разпореждане */
						, t4temp.text as textorde
										/* изх.док. от шаблон */
						, t6dout.serial as p2seri, t6dout.iddocutype as p2docutype
						, date_format(date(t6dout.created),'%d.%m.%Y') as p2crea
		/* 27.03.2018 флаг дали шаблона се изходява */
		, t6docutype.isnoregi as p2noregi
/***
, if(t6dout.serial=0,'',concat(t6dout.serial,'/',t6dout.year)) as p2seye
***/
										/* много адресати - много изх.номера */
/* -------------------------------------------------------------------------------------- */
, $codeserial as p2seye
/* -------------------------------------------------------------------------------------- */
										/* за свързан предмет */
/* 
, t2subj.amount as subjsuma, t2subj.fromdate as subjdate
, date_format(date(t2subj.fromdate),'%d.%m.%Y') as subjdate
*/
						, $codesubj as subjdesc, t2subj.amount as subjsuma
										/* за дело и деловодител */
						, concat(suit.serial,'/',suit.year) as caseye, user.name as username
										/* за свързана фактура/сметка */
/*
, t2bill.serial as billdesc, concat(t2bill.seriinvo,'/',date_format(t2bill.date,'%d.%m.%Y')) as invodesc
*/
						, txordeelem.idbill as idbillelem
						, t2bill.serial as seribill, t2bill.seriinvo ,date_format(t2bill.date,'%d.%m.%Y') as invodate
						, t2bill.paid as invopaid
						, t2bill.id as idbillorig
						, t2bill.name as billname
										/* ако свързаната фактура/сметка е проформа */
						, t2prof.seriprof
										/* за свързана фактура/сметка */
						, txordeelem.idadva as idadvaelem
						, t2adva.amount as advasuma ,date_format(t2adva.date,'%d.%m.%Y') as advadate
										/* за такса с т.26 - постъплението */
						, t2fina.id as finaid
						, t2fina.inco as finainco ,date_format(t2fina.dateinco,'%d.%m.%Y') as finad2inco
						, date_format(t2fina.timeclosed,'%d.%m.%Y') as finad2clos, date_format(t2fina.datebala,'%d.%m.%Y') as finad2bala
											/* 28.10.2016 за откриване на грешка - изх.документ от друго дело */
											, if(txorde.idcase=t6dout.idcase,'',concat(suit2dout.serial,'/',suit2dout.year)) as ercase
													/* 11.08.2017 за откриване на евент. грешка - АКТИВНА такса е свързана с ИГНОРИРАН шаблон */
													, if(txordeelem.idtype=3 and txordeelem.isigno=0 and t8elem.isigno=1,1,0) as isignotemp
													, t8temp.text as ignotemptext
		from txordeelem
			left join txorde on txordeelem.idorde=txorde.id
			left join docuout as t2orde on txorde.iddout=t2orde.id
								/* за тип 1 шаблон */
				left join docutype as t2temp on txordeelem.idpoin=t2temp.id
								/* за тип 2 проучване длъжник */
				left join debtor as t2debt on txordeelem.idex=t2debt.id
				left join debtinfo as t2info on txordeelem.p2poin=t2info.id
/*--- 24.04.2018 добавяме типове НАП и БНБ ---*/
left join debtnap as t2nap on txordeelem.p2poin=t2nap.id
left join debt_bnb as t2bnb on txordeelem.p2poin=t2bnb.id
								/* за тип 3 такса */
				left join claimer as t2clai on txordeelem.idex=t2clai.id
				left join debtor as t26debt on txordeelem.idex=t26debt.id
										/* за текст разпореждане */
						left join docuout as t4dout on txorde.iddout=t4dout.id
						left join docutype as t4temp on t4dout.iddocutype=t4temp.id
										/* за изх.док.от шаблон */
						left join docuout as t6dout on txordeelem.p2poin=t6dout.id
		/* 27.03.2018 флаг дали шаблона се изходява */
		left join docutype as t6docutype on t6dout.iddocutype=t6docutype.id
										/* за свързан предмет */
						left join subject as t2subj on txordeelem.idsubj=t2subj.id
										/* за дело и деловодител */
						left join suit on txorde.idcase=suit.id
						left join user on suit.iduser=user.id
										/* за свързана фактура/сметка */
						left join bill as t2bill on txordeelem.idbill=t2bill.id
										/* ако свързаната фактура/сметка е проформа */
						left join billprof as t2prof on t2prof.idbill=t2bill.id
										/* за свързана аванс.вноска */
						left join claimadva as t2adva on txordeelem.idadva=t2adva.id
										/* за такса с т.26 - постъплението */
						left join finance as t2fina on txordeelem.p2poin=t2fina.id
											/* 28.10.2016 за откриване на грешка - изх.документ от друго дело */
											left join suit as suit2dout on t6dout.idcase=suit2dout.id
													/* 11.08.2017 за откриване на евент. грешка - АКТИВНА такса е свързана с ИГНОРИРАН шаблон */
													left join txordeelem as t8elem on txordeelem.p1poin=t8elem.id
													left join docutype as t8temp on t8elem.idpoin=t8temp.id
		where $filt
		order by txordeelem.id desc
	";
return $quplan;
}

# дали се изходява определен шаблон $idtemp 
function getisregi($idtemp){
global $DB, $arregistration;
//print "<br>getisregi=[$idtemp]";
			if (empty($arregistration)){
//die("getisregi=0");
return getisregi2($idtemp);
			}else{
			}
	$rodoty= getrow("docutype", $idtemp);
	$fnam= OUTDIR.$rodoty["filename"];
//	if (file_exists($fnam)){
	if (!empty($rodoty["filename"]) and file_exists($fnam)){
		$cont= file_get_contents($fnam);
 	}else{
 		$cont= "";
 	}
						$flagisregi= false;
						foreach($arregistration as $reco){
							if (strpos($cont,$reco)!==false){
								$flagisregi= true;
								break;
							}else{
							}
						}
return $flagisregi;
}

# алтернатива - връща флаг за изх.шаблон - дали се изходява 
function getisregi2($idtype){
			$dirout2= "outgoing/";
			$tagout2= "IZHODQSHT_NOMER";
	$rotype= getrow("docutype",$idtype);
	$finame2= $dirout2.$rotype["filename"];
//var_dump($finame2);
//print "<br>[$idtype][$finame2]";
//	if (file_exists($finame2)){
	if (!empty($rotype["filename"]) and file_exists($finame2)){
 		$docont2= file_get_contents($finame2);
 	}else{
 		$docont2= "";
 	}
 //print "<br><br>$finame2=cont=".substr($docont2,0,100);
	$isregi= (strpos($docont2,$tagout2)!==false);
return $isregi;
}


# евент.промяна в статуса на свързаните с изх.документ такси 
# статуса става txstat=1 - таксата може да се обработва 
# записваме и количеството 
//function puttxstat($idcase,$idelem,$isafterregi){
function puttxstat($idelem,$quan,$isafterregi){
global $DB;
/*
	# данни за действието 
		$rotxel= getrow("txordeelem",$idelem);
	$idtype= $rotxel["idtype"];
	$idtemp= $rotxel["idpoin"];
	# свързаните с изх.документ такси - за същото дело 
	$aridtx= $DB->selectCol("
		select txordeelem.id 
		from txordeelem 
		left join txorde on txordeelem.idorde=txorde.id
		where txorde.idcase=?d and txordeelem.p1type=?d and txordeelem.p1poin=?d
			and txordeelem.idtype=3
		"  ,$edit,$idtype,$idtemp);
*/
	# изх.шаблон 
	$rotxel= getrow("txordeelem",$idelem);
	$idtemp= $rotxel["idpoin"];
	# свързаните с изх.документ такси 
	$aridtx= $DB->selectCol("
		select txordeelem.id 
		from txordeelem 
		where txordeelem.p1poin=?d and txordeelem.idtype=3
		"  ,$idelem);
//++++++print_rr($aridtx);
//die("bbbbbbbb");
	if (empty($aridtx)){
	}else{
		# изходява ли се изх.шаблон на документа 
		$isregi= getisregi($idtemp);
		# да правим ли промяна 
				$ischange= true;
		if ($isregi){
			if ($isafterregi){
			}else{
				$ischange= false;
			}
		}else{
		}
		# промяна 
		if ($ischange){
						$quan +=0;
						if ($quan==0){
							$quan= 1;
						}else{
						}
			foreach($aridtx as $id2){
				$DB->query("update txordeelem set txstat=1,txquan='$quan' where id=?d"  ,$id2);
# записваме общата стойност за таксата 
updatxtota($id2);
			}
		}else{
		}
	}
}

# евент.промяна в статуса на свързаните с ПРОУЧВАНЕ такси 
# статуса става txstat=1 - таксата може да се обработва 
# записваме и количеството =1 
/*
function puttxstatinfo($idinfo){
global $DB;
	# $idinfo = debtinfo.id 
	# записа за проучването в плана 
	$idelem= $DB->selectCell("select id from txordeelem where p2poin=?d"  ,$idinfo);
*/
							# 15.05.2019 ВАЖНО ДОПЪЛНЕНИЕ по мейл от Борислав Павлов 
							# таксите от проучване не получаваха статус=1 и колич=1 
function puttxstatinfo($idinfo,$iddebt,$codetype){
global $DB;
							# $idinfo = според вида проучване 
							#    = debtinfo.id - проучване длъжник 
							#    = debtnap.id  - пручване НАП 
							#    = debt_bnb.id - проучване БНБ 
							# $codetype = според вида проучване : "debt"=длъжник "nap"=НАП "bnb"=БНБ 
global $base2nap, $base2bnb;
							if (0){
							}elseif ($codetype=="debt"){
								$whcode= "idpoin<$base2nap";
							}elseif ($codetype=="nap"){
								$whcode= "idpoin>=$base2nap and idpoin<$base2bnb";
							}elseif ($codetype=="bnb"){
								$whcode= "idpoin>$base2bnb";
							}else{
var_dump($codetype);
die("puttxstatinfo=1");
							}
//fp("codetype=",$codetype);
	# намираме записа за проучването в плана 
	$idelem= $DB->selectCell("select id from txordeelem where p2poin=?d and idex=?d and $whcode"  ,$idinfo,$iddebt);
//fp("idelem=",$idelem);
	if ($idelem==0){
	}else{
		# свързаните с проучването такси 
		$aridtx= $DB->selectCol("
			select txordeelem.id 
			from txordeelem 
			where txordeelem.p1poin=?d and txordeelem.idtype=3
			"  ,$idelem);
//fp("aridtx=",$aridtx);
		if (empty($aridtx)){
		}else{
			# промяна 
			//if ($ischange){
							$quan= 1;
				foreach($aridtx as $id2){
					$DB->query("update txordeelem set txstat=1,txquan='$quan' where id=?d"  ,$id2);
# записваме общата стойност за таксата 
updatxtota($id2);
				}
			//}else{
			//}
		}
	}
}









#---------------------------------------------------------------------------------------------------------------
# СТАРИ ФУНКЦИИ ????????
#---------------------------------------------------------------------------------------------------------------

/*
# етапи за начисляване на таксите 
$artaxgene= array();
//$artaxgene[0]= "1) след разпореждането";
//$artaxgene[1]= "2) след генериране изх.док";
//$artaxgene[2]= "3) след изходяване";
$artaxgene[0]= "1)след разпорежд.";
$artaxgene[1]= "2)след генерир.ИД";
$artaxgene[2]= "3)след изходяв.ИД";
$smarty->assign("ARTAXGENE", $artaxgene);
*/

# брой такси за изх.шаблон или масив за всички изх.шаблони 
function gettaxcoun($p1type=0){
global $DB;
	if ($p1type==0){
		$arcountax= $DB->selectCol("select iddocutype as ARRAY_KEY, count(*) from docutypetax group by iddocutype");
return $arcountax;
	}else{
		$coun= $DB->selectCell("select count(*) from docutypetax where iddocutype=?d"  ,$p1type);
return $coun;
	}
}

# списък основания на таксите 
function gettaxlist($p1type=0){
global $DB;
	if ($p1type==0){
		$artax= $DB->selectCol("select iddocutype as ARRAY_KEY1, id as ARRAY_KEY2, codetype from docutypetax");
return $artax;
	}else{
		$artax= $DB->selectCol("select id as ARRAY_KEY, codetype from docutypetax where iddocutype=?d"  ,$p1type);
return $artax;
	}
}

# списък платци за дело 
function getmemb($idcase){
global $DB;
					$txcl= toutf8("взискател ");
					$txde= toutf8("длъжник ");
				$armemb= $DB->selectCol("
					select code as ARRAY_KEY, name
					from (
				(select concat('c',id) as code, concat('$txcl',name) as name from claimer where idcase=$idcase order by id)
					union all
				(select concat('d',id) as code, concat('$txde',name) as name from debtor where idcase=$idcase order by id)
					) as t2
					");
				$armemb= dbconv($armemb);
				$armemb= arstrip($armemb);
return $armemb;
}



# връща основна заявка 
function getbasequ($filt1="1",$filt2="1"){
	# спец.филтър за изтрити изх.документи 
	$filtdele= "docuout.id is not null";
	$qubase= "
	(
		select concat('tax_',docuouttax.id) as idcode
			, docuouttax.iddocuout as iddout
			, docuouttax.codetype, docuouttax.quan, docuouttax.suma, docuouttax.inte
			, docuout.idcase as idcase, docuout.created, docuout.codememb, docuout.idmemb
			, concat(docuout.codememb,docuout.idmemb) as c2memb
		from docuouttax
			left join docuout on docuouttax.iddocuout=docuout.id
			left join suit on docuout.idcase=suit.id
where $filt1
and $filtdele
	)union all(
		select concat('t2_',docuoutt2.id) as idcode
			, 0 as iddout
			, docuoutt2.codetype, docuoutt2.quan, docuoutt2.suma, docuoutt2.inte
			, docuoutt2.idcase as idcase, docuoutt2.created, docuoutt2.codememb, docuoutt2.idmemb
			, concat(docuoutt2.codememb,docuoutt2.idmemb) as c2memb
		from docuoutt2
			left join docuout on 0=docuout.id
			left join suit on docuoutt2.idcase=suit.id
where $filt2
	)
	";
return $qubase;
}

# връща всички такси за действие 
function gettaxacti($idacti){
global $DB;
	$roacti= getrow("acti",$idacti);
								$artota= array();
	$arelem= $DB->selectCol("
		select idtype as ARRAY_KEY1, id as ARRAY_KEY2, code
		from actielem 
		where idacti=?d
		order by idtype, id
		"  ,$idacti);
//print "<br>arelem=";
//print_rr($arelem);
	if ($roacti["isnotax"]==0){
		if (empty($arelem[0])){
			$arelem[0]= array();
		}else{
		}
		foreach($arelem[0] as $iddout){
//print "<br>$iddout";
			$artaxdout= $DB->select("
				select docutypetax.codetype as ARRAY_KEY1
					, docutypetax.iddocutype, docutype.text
				from docutypetax
				left join docutype on docutypetax.iddocutype=docutype.id
				where docutypetax.iddocutype=?d
				order by docutypetax.id
				"  ,$iddout);
			$artaxdout= dbconv($artaxdout);
//print_rr($artaxdout);
								foreach($artaxdout as $code=>$elem){
											# дали се изходява - етап на начисляване 
											$isregi= getisregi($elem["iddocutype"]);
											$idtaxgene= ($isregi) ? 2 : 1;
									//$artota[]= array($code,$elem["iddocutype"],$elem["text"]);
									//$artota[]= array($code,$elem["iddocutype"],$elem["text"]  ,$isregi);
									$artota[]= array($code,$elem["iddocutype"],$elem["text"]  ,$idtaxgene);
								}
		}
	}else{
	}
		if (empty($arelem[1])){
			$arelem[1]= array();
		}else{
		}
	foreach($arelem[1] as $code){
									//$artota[]= array($code,0,"");
									//$artota[]= array($code,0,""  ,false);
									$artota[]= array($code,0,""  ,0);
	}
//print_rr($artota);
return $artota;
}

?>