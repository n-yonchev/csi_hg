<?php
							
							#--------------------- специфични за сайта компоненти ------------------------
//print dirname(__FILE__);
//							include_once "commspec.php";
							include_once dirname(__FILE__)."/"."commspec.php";

#--------------------------- Smarty -----------------------------------
		# заради алтернативното извикване от поддир. /FCKlocal - fclgetpage.php 
		if (defined("SMARTY_DIR")){
		}else{
define("SMARTY_DIR","./smarty/");
		}
					# CAPITAL LETTER - not smarty.class.php
include SMARTY_DIR ."Smarty.class.php";
$smarty= new Smarty();

$lev_to_euro_multiplier = 0.511292;
$euro_to_lev_multiplier = 1.95583;
$euro_first_year = 2025;
$smarty->assign("EURO_FIRST_YEAR", $euro_first_year);

# оформлението 
$visuname= $_SESSION["visuname"];
$visuname= isset($visuname) ? $visuname : "blue-style.css";
//$visuname= isset($visuname) ? $visuname : "main.css";
$_SESSION["visuname"]= $visuname;
$smarty->assign("VISUNAME", $visuname);


# заместител на smarty->display с избор на вариант - 0=frontend 1=backend
function sdisplay($mode, $temp0, $temp1="", $fetch=""){
global $smarty;
	if ($mode==0){
		$smarty->template_dir= 'html/';
		$smarty->config_dir= 'html/';
# отделни директории - заради правилното изпълнение на smarty-include-file 
$smarty->compile_dir= 'smarty/templates_c/';
			$smarty->left_delimiter= "[[";
			$smarty->right_delimiter= "]]";
		$smarty->assign("CSSPATH","html/");
		$diname= $temp0;
	}elseif ($mode==1){
					if ($temp1==""){
die("sdisplay=empty");
					}else{
					}
		$smarty->template_dir= 'smtemp/';
		$smarty->config_dir= 'smtemp/';
# отделни директории - заради правилното изпълнение на smarty-include-file 
$smarty->compile_dir= 'smtemp/compiled/';
			$smarty->left_delimiter= "{";
			$smarty->right_delimiter= "}";
//		$smarty->assign("CSSPATH","smtemp/");
							# 04.02.2010 - рожден ден на тате 
							# ЛЕПЕНКА. оправена важна грешка 
							# INCPAT е заради хедър/футер в шаблоните на Дервиш 
							if (isset($GLOBALS["smartyleft"])){
			$smarty->left_delimiter= $GLOBALS["smartyleft"];
			$smarty->right_delimiter= $GLOBALS["smartyright"];
							}else{
							}
							# 07.12.2010 заради шаблона BILL.HTML 
							if (isset($GLOBALS["smartytempdir"])){
			$smarty->template_dir= $GLOBALS["smartytempdir"];
							}else{
							}
		$smarty->assign("CSSPATH","css/");
		$diname= $temp1;
	}else{
die("sdisplay=mode=$mode");
	}
			if ($fetch=="fetch"){
return $smarty->fetch($diname);
			#---- октомври-2008 ---- 
			# заради jQuery-ajax съдържанието 
			}elseif ($fetch=="iconv"){
//return iconv("windows-1251","UTF-8",$smarty->fetch($diname));
# и заради кавичките в адреса и др.стрингове 
return iconv("windows-1251","UTF-8", stripslashes($smarty->fetch($diname)));
			}else{
$smarty->display($diname);
			}
}

# същото, но само за backend 
function smdisp($temp, $fetch=""){
return sdisplay(1,"",$temp,$fetch);
}



#--------------------------- криптиране/декриптиране чрез библиотеката "mcrypt" -------------------------------

#---- константи 
# масив с ключове за криптиране/декриптиране 
//$CRYKEY["a"]= "tridsjty56wkglyuoegds";
//$CRYKEY["b"]= "iymgher47698hv54ndotj";
//$CRYKEY["c"]= "ld7nf5k4h4epqmgeu43mf";
$CRYKEY["a"]= "qswcw64hrus0htlci6gnv";
$CRYKEY["b"]= "zpms6chg9fj7h9kchwhr1";
$CRYKEY["c"]= "wshusvqihrncwershgtoc";
$CRYKEY["d"]= "zhr7h9k19fjchwpms6chg";
$CRYKEY["e"]= "qi6gncw64sw0htlchrusv";
# първи символ в криптирания низ - само уникални символи 
define (FIRCHA, "yrlzewxpbcskfdtvnqoghmau");
# на всеки първи символ отговаря индекс от масива с ключове - само възможните индекси 
define (CHAKEY, "babcabcddabcdeceabcdeade");

//# криптиране/декриптиране на стринг - с готов ключ 
//function mycrypt($dire,$data,$key){
# криптиране/декриптиране на стринг - според 1вия символ 
# get : ДЕкриптиране 
# put : криптиране 
function mycrypt($dire,$data){
global $CRYKEY;
									# за криптиране/декриптиране - инициализиращ вектор 
									$initvector= "74020963864023419675605638693419";
									//$initvector= "86406934192341796756040209635638";
/*
	# името на сборното поле от данните 
	$dataname= "ccdata";
	# името на шифъра от данните 
	$stamname= "stamp";
	# имената на полетата от формата 
	# ВНИМАНИЕ. 
	# трябва да съвпадат с тези от шаблона aduser3.tpl 
	$arfiel= array("ccnumber","cctype","ccexmo","ccexye","cccode");
*/
	# действие 
	if (0){
	}elseif ($dire=="get"){
			# вземаме криптирания стринг 
#---- май-2008 rame18 ------------------------------------
# извеждаше грешка : Warning: mdecrypt_generic()... 
# причина : празен стринг $data 
# причина : стари дефектни данни от неправилно отчитане на плащането 
# заобикаляме го 
if (empty($data)){
	$decrypted= "";
}else{
			$encrypted= $data;
			# премахваме заграждащите [] от стринга 
			$encrypted= substr($encrypted,1,strlen($encrypted)-2);
	# определяме ключа по 1вия символ 
	$fircha= substr($encrypted,0,1);
	$infircha= strpos(FIRCHA,$fircha);
	if ($infircha===false){
die("GPcred=1st=$mychar");
	}else{
	}
	$indkey= substr(CHAKEY,$infircha,1);
	$key= $CRYKEY[$indkey];
//print "mychar=[$fircha][$indkey]";
	# премахваме 1вия символ 
	$encrypted= substr($encrypted,1);
			# декодираме от символното представяне 
			$encrypted= base64_decode($encrypted);
									# декриптираме стринга 
									$cipher = mcrypt_module_open('rijndael-256', '', 'ofb', '');
//						$initvector= mcrypt_create_iv(mcrypt_enc_get_iv_size($cipher), MCRYPT_DEV_RANDOM);
//						$initvector= mcrypt_create_iv(mcrypt_enc_get_iv_size($cipher), MCRYPT_RAND);
									mcrypt_generic_init($cipher, $key, $initvector);
									$decrypted = mdecrypt_generic($cipher,$encrypted);
									mcrypt_generic_deinit($cipher);
# if (empty($data)){
}
return $decrypted;

	}elseif ($dire=="put"){
		# определяме случаен ключ и 1вия символ 
		$infircha= rand(0,strlen(FIRCHA)-1);
		$fircha= substr(FIRCHA,$infircha,1);
		$indkey= substr(CHAKEY,$infircha,1);
		$key= $CRYKEY[$indkey];
//print "mychar=[$fircha][$indkey]";
		
									# криптираме входния стринг 
								//	$cipher = mcrypt_module_open(MCRYPT_BLOWFISH,'','cbc','');
									$cipher = mcrypt_module_open('rijndael-256', '', 'ofb', '');
									mcrypt_generic_init($cipher, $key, $initvector);
									$encrypted = mcrypt_generic($cipher,$data);
									mcrypt_generic_deinit($cipher);
			# само символи - за MySQL 
			$encrypted= base64_encode($encrypted);
			# ако в началото или в края на стринга има space, MySQL ще ги премахне 
//			# затова заграждаме стринга в символите [] 
//			$encrypted= "[".$encrypted."]";
			# затова заграждаме стринга в символите qm 
			# добавяме и 1вия символ 
			$encrypted= "q" .$fircha .$encrypted ."m";
return $encrypted;

	}else{
die("GPcred=dire=$dire");
	}
}


#---------------------- dklab/dbsimple ---------------------------
		# определяме префикса за пътя 
		# rame9 - заради алтернативното извикване от поддир. /FCKlocal - fclgetpage.php 
		if (defined("DKLAB_PREFIX")){
$dkpref= DKLAB_PREFIX;
		}else{
$dkpref= "";
		}
require_once $dkpref."dklab/dbsimple/Generic.php";

/*
					#----------------- мои константи ------------------
					$htho= $_SERVER["HTTP_HOST"];
					if ($htho=="lh" or $htho=="localhost" or $htho=="and" or $htho==""){
						$dbconst= 'mysql://root:@localhost/ramekins';
					}elseif ($htho=="neno.devel.mochanin.com"){
						$dbconst= 'mysql://neno_ramenen:onen123@localhost/neno_ramekins';
					}elseif ($htho=="74.55.212.250" or strpos($htho,"ramekins.com")!==false){
						$dbconst= 'mysql://ramekin_rameson:rame29sono09kins53@localhost/ramekin_data';
					}else{
die("UNKNOWN-SERVER=$htho");
					}
*/
							# getdbconst - commspec.php 
							$dbconst= getdbconst();
// Подключаемся к БД.
$DB = DbSimple_Generic::connect($dbconst);
							# кирилица 
//							$DB->query("SET NAMES 'cp1251'");
//							$DB->query("SET CHARACTER SET 'cp1251'");
							$DB->query("SET NAMES 'utf8'");
//							$DB->query("SET CHARACTER SET 'utf8'");

// Устанавливаем обработчик ошибок.
$DB->setErrorHandler('databaseErrorHandler');
function databaseErrorHandler($message, $info)
{
	// Если использовалась @, ничего не делать.
	if (!error_reporting()) return;
	// Выводим подробную информацию об ошибке.
	echo "SQL Error: $message<br><pre>"; 
	print_r($info);
	echo "</pre>";
	exit();
}

#---------------------- dklab/formpersister ---------------------------
require_once $dkpref."dklab/formpers/FormPersister.php";

#---------------------- dklab/metaform ---------------------------
require_once $dkpref."dklab/metaform/MetaForm.php";
require_once $dkpref."dklab/metaform/MetaFormAction.php";

$mf =& new HTML_MetaForm('ExOffIcer_digital_signature_YS0lTgit_EXOF');
ob_start(array(&$mf, 'process'));
$mfac =& new HTML_MetaFormAction($mf);
ob_start(array('HTML_FormPersister', 'ob_formpersisterhandler'));



#--------------------------------- общи функции -------------------------------------

# reload 
function reload($p1,$p2){
			if ($p1==""){
	print "
<script>
document.location.href='$p2';
</script>
	";
			}else{
	print "
<script>
$p1.document.location.href='$p2';
</script>
	";
			}
}

# връща URL за линкове и reload 
function geturl($p1){
return "?" .rawurlencode(mycrypt("put",$p1));
}

# декриптира входния параметричен стринг 
# връща асоц.масив с параметрите 
function getparam(){
	$aget= array_keys($_GET);
	$aget= rawurldecode($aget[0]);
//var_dump($aget);
	if (empty($aget)){
	}else{
		$resupara= array();
		parse_str(mycrypt("get",$aget) ,$resupara);
	}
return $resupara;
}

# ако логнатия не е админ - redirect 
function adminonly(){
	$iduser= @$_SESSION["iduser"];
			$isadmin= true;
	if (isset($iduser)){
		$rouser= getrow("user",$iduser);
			$isadmin= ($rouser["type"]==ADMINTYPE);
			$isadmin= ($rouser["inactive"]==0);
	}else{
			$isadmin= false;
	}
			if ($isadmin){
			}else{
redirect("login.php");
exit;
			}
}
							
# redirect 
function redirect($newurl){
//	header('Location: http://www.example.com/');
	header("Location: $newurl");
}

# списък с текстове от таблица - за select/option 
function getselect($taname,$finame,$filter="",$emptyrow=true){
global $DB;
	if ($filter==""){
		$where= "";
	}else{
		$where= "where $filter";
	}
	$ardata= $DB->selectCol("select id as ARRAY_KEY, $finame from $taname $where order by $finame");
//	$ardata= dbconv($ardata);
	if ($emptyrow){
		# ВНИМАНИЕ. СТАНДАРТ. 
		# директна конкатенация на масиви без промяна - вместо array_merge 
		$ardata= array(0=>"") + $ardata;
	}else{
	}
//print_r($ardata);
//	$ardata= stripslashes($ardata);
	foreach($ardata as $arin=>$arel){
		$ardata[$arin]= stripslashes($arel);
	}
return $ardata;
}

# връща един запис от таблица като масив 
function getrow($taname,$paid){
global $DB;
	$row= $DB->selectRow("select * from $taname where id=?" ,$paid);
	$row= dbconv($row);
//			# 13.03.2009 ПЕТЪК - важно за извеждането в изх.документи 
//			$row= nl2br($row);
//			array_walk($row,"getrowbr");
return $row;
}
//			function getrowbr(&$p1){
//				$p1= nl2br($p1);
//			}

# корегира един запис от таблица 
function updrow($taname,$paid,$code){
global $DB;
	$DB->query("update $taname set $code where id=?" ,$paid);
//return $row;
}

#------------------------------------------------------------
# извежда (асоциативен) масив по редове
function printarr(&$parr,$ptxt="array"){
	print "<br>=============== $ptxt ===================";
	foreach($parr as $arna=>$arco){
		print "<br>$ptxt=$arna=$arco";
//		print "<br>$ptxt=$arna=" .htmlentities($arco,ENT_QUOTES);
	}
	print "<br>";
}

/******
# връща js код за изход от nyromodal-iframe след успешен събмит 
function getnyroexit($p1){
					if (is_array($p1)){
										$paresu= "";
						foreach($p1 as $p1elem){
										$paresu .= "parent.$('#".$p1elem."').click();";
						}
						return "
<script type=\"text/javascript\">
parent.$('#closeBut').click();
".$paresu."
</script>
						";
					}else{
	return "
<script type=\"text/javascript\">
parent.$('#closeBut').click();
parent.$('#".$p1."').click();
</script>
	";
					}
}
******/

	# 13.03.2009 ПЕТЪК - специално за новия дизайн 
	# и модалния вариант на nyroModal - modal:true - не се затваря при клик извън прозореца и чрез Esc 
	# вече НЕ съществува обекта с id="closeBut" 
$NYROREMOVE= "parent.$.nyroModalRemove();";
	# затова използваме универсалния метод nyroModalRemove 
# връща js код за изход от nyromodal-iframe след успешен събмит 
function getnyroexit($p1){
global $NYROREMOVE;
//	$mycode= "parent.$.nyroModalRemove();";
					if (is_array($p1)){
										$paresu= "";
						foreach($p1 as $p1elem){
										$paresu .= "parent.$('#".$p1elem."').click();";
						}
						return "
<script type=\"text/javascript\">
".$NYROREMOVE.$paresu."
</script>
						";
					}else{
	return "
<script type=\"text/javascript\">
$NYROREMOVE
parent.$('#".$p1."').click();
</script>
	";
					}
}

# връща js код за изход от nyromodal-iframe след успешен събмит 
# същото, но за текущия прозорец, не за родителския 
# и без масив 
# 15.01.2009 - неуспешно използване в cazo6.php, cazo6.tpl 
# след това не се използва 
function getnyroexitwindow($p1){
/*
					if (is_array($p1)){
										$paresu= "";
						foreach($p1 as $p1elem){
										$paresu .= "parent.$('#".$p1elem."').click();";
						}
						return "
<script type=\"text/javascript\">
parent.$('#closeBut').click();
".$paresu."
</script>
						";
					}else{
*/
	return "
<script type=\"text/javascript\">
//window.$('#closeBut').click();
window.$('#".$p1."').click();
</script>
	";
//					}
}

# конвертиране от/към UTF8 
function toutf8 ($p1){
	if (is_array($p1)){
		$resu= array();
		foreach($p1 as $indx=>$cont){
//			$resu[$indx]= toutf8($cont);
			# ВНИМАНИЕ. 24.04.2009 
			# конвертираме и индекса - заради текстовете за select-optgroup-option 
			# във FormPersister 
			$resu[toutf8($indx)]= toutf8($cont);
		}
return $resu;
	}else{
return iconv("windows-1251","UTF-8",$p1);
	}
}
function to1251 ($p1){
	if (is_array($p1)){
		$resu= array();
		foreach($p1 as $indx=>$cont){
			$resu[$indx]= toutf8($cont);
		}
return $resu;
	}else{
return iconv("UTF-8","windows-1251",$p1);
	}
}
function tran1251 ($p1){
	if (is_array($p1)){
		$resu= array();
		foreach($p1 as $indx=>$cont){
			$resu[$indx]= tran1251($cont);
		}
return $resu;
	}else{
return iconv("UTF-8","windows-1251",$p1);
	}
}


# създава и връща обекта за FCKeditor 
function getFCK($editname){
//	$sBasePath= "./FCK151/";
//	$sBasePath= "FCK151/";
	$sBasePath= "FCK2641/";
	include($sBasePath."fckeditor.php") ;
	$oFCKeditor = new FCKeditor($editname) ;
	$oFCKeditor->BasePath= $sBasePath;
#---- април-2008 rame14 ---------------------------------------
# пълния път - динамично ! 
							# определяме последния елемент на URL - директорията 
							# пример : rame14, ramekins 
							$htrefe= $_SERVER["HTTP_REFERER"];
							$arcp= explode("?",$htrefe);
							$ar2= explode("/",$arcp[0]);
/*
							$prefpath= $ar2[count($ar2)-2];
				# присвояваме пълния път 
				$oFCKeditor->myFullPath= "/".$prefpath."/".$sBasePath;
*/
				# присвояваме пълния път 
				$oFCKeditor->myFullPath= "/" .$sBasePath;
return $oFCKeditor;
}


/*
# вариант на print_r за масив 
function print_rr($p1){
	$resu= print_r($p1,true);
	$resu= str_replace("\r\n","<br>",$resu);
	$resu= str_replace("\n\r","<br>",$resu);
	$resu= str_replace("\n","<br>",$resu);
	$resu= str_replace("\r","<br>",$resu);
//	$resu= str_replace("\t","tab_",$resu);
	$resu= str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$resu);
//	$resu= str_replace("\t","____",$resu);
//	$resu= nl2br($resu);
	print "<div align=left>".$resu."</div>";
}
*/
function print_rr($p1){
	print "<pre>";
	$resu= print_r($p1);
	print "</pre>";
}
function print_rif($p1){
	$resu= print_r($p1,true);
	$wkname= "cache/" .md5(microtime());
	file_put_contents($wkname,$resu);
	print "<iframe src='$wkname'>".$resu."</iframe>";
}
# 09.02.2011 - извежда текстов файл 
function print_rr_file($parray,$pname){
	file_put_contents($pname,print_r($parray,true));
}

function nldelete($p1){
	$resu= $p1;
	$resu= str_replace("\r","",$resu);
	$resu= str_replace("\n","",$resu);
return $resu;
}

						#--------------------------- валидаторите ------------------------------- 
						# най-отзад заради константите за проверка на RegExp 
						include "commvali.php";







/************************************

									# класа за редактиране 
									include_once "edit.class.php";
#----------------- директно редактиране -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# основен входен параметър - 
									# $edit - $taname.id  

if (0){

#------ начало 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
							#---- полета с автоматично съдържание 
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
							#---- полета с автоматично съдържание 
	}

#------ submit без формални грешки 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# проверяваме за допълнителни грешки 
											$lister= array();

											# според дали има грешка 
											if (count($lister)<>0){
												#---- има ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- няма ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
	if ($edit==0){
							#---- полета с автоматично съдържание 
		# нов запис 
		$edit= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
							#---- полета с автоматично съдържание 
		# корекция на записа 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
											# край - според дали има грешка 
											}

#------ submit с формални грешки 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ автоматичен submit -----------------------------------------------------
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
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
}
************************************/







/****
# специфична функция за състояние INIT 
$obedit->funcinit= "funcinit";

# функция за INIT 
function funcinit($obje){
global $DB, $edit;
	if ($edit==0){
		$_POST["serial"]= "";
		$_POST["year"]= "";
		$_POST["created"]= "";
	}else{
		$row= $DB->selectRow("select * from $obje->taname where id=?" ,$obje->paid);
		$_POST["serial"]= $row["serial"];
		$_POST["year"]= $row["year"];
			list($e1,$e2)= explode(" ",$row["created"]);
			list($ye,$mo,$da)= explode("-",$e1);
		$_POST["created"]= "$da.$mo.$ye";
	}
}
****/


?>
