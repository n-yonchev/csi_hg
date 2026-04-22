<?php
							
							#--------------------- ���������� �� ����� ���������� ------------------------
//print dirname(__FILE__);
//							include_once "commspec.php";
							include_once dirname(__FILE__)."/"."commspec.php";

#--------------------------- Smarty -----------------------------------
// 		# ������ �������������� ��������� �� ������. /FCKlocal - fclgetpage.php 
// 		if (defined("SMARTY_DIR")){
// 		}else{
// define("SMARTY_DIR","./smarty/");
// 		}
// 					# CAPITAL LETTER - not smarty.class.php
// include SMARTY_DIR ."Smarty.class.php";
// $smarty= new Smarty();

										# 19.02.2019 ������ ������� �� ������ - �������� 
										//include_once "status.inc.php";

# ������������ 
// $visuname= $_SESSION["visuname"];
// $visuname= isset($visuname) ? $visuname : "blue-style.css";
// //$visuname= isset($visuname) ? $visuname : "main.css";
// $_SESSION["visuname"]= $visuname;
// $smarty->assign("VISUNAME", $visuname);


# ���������� �� smarty->display � ����� �� ������� - 0=frontend 1=backend
function sdisplay($mode, $temp0, $temp1="", $fetch=""){
global $smarty;
	if ($mode==0){
		$smarty->template_dir= 'html/';
		$smarty->config_dir= 'html/';
# ������� ���������� - ������ ���������� ���������� �� smarty-include-file 
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
# ������� ���������� - ������ ���������� ���������� �� smarty-include-file 
$smarty->compile_dir= 'smtemp/compiled/';
			$smarty->left_delimiter= "{";
			$smarty->right_delimiter= "}";
//		$smarty->assign("CSSPATH","smtemp/");
							# 04.02.2010 - ������ ��� �� ���� 
							# �������. �������� ����� ������ 
							# INCPAT � ������ �����/����� � ��������� �� ������ 
							if (isset($GLOBALS["smartyleft"])){
			$smarty->left_delimiter= $GLOBALS["smartyleft"];
			$smarty->right_delimiter= $GLOBALS["smartyright"];
							}else{
							}
							# 07.12.2010 ������ ������� BILL.HTML 
							if (isset($GLOBALS["smartytempdir"])){
			$smarty->template_dir= $GLOBALS["smartytempdir"];
							}else{
							}
		//$smarty->assign("CSSPATH","css/");
		$diname= $temp1;
	}else{
die("sdisplay=mode=$mode");
	}
			if ($fetch=="fetch"){
return $smarty->fetch($diname);
			#---- ��������-2008 ---- 
			# ������ jQuery-ajax ������������ 
			}elseif ($fetch=="iconv"){
//return iconv("windows-1251","UTF-8",$smarty->fetch($diname));
# � ������ ��������� � ������ � ��.��������� 
return iconv("windows-1251","UTF-8", stripslashes($smarty->fetch($diname)));
			}else{
$smarty->display($diname);
			}
}

# ������, �� ���� �� backend 
function smdisp($temp, $fetch=""){
return sdisplay(1,"",$temp,$fetch);
}



#--------------------------- ����������/������������ ���� ������������ "mcrypt" -------------------------------

#---- ��������� 
# ����� � ������� �� ����������/������������ 
//$CRYKEY["a"]= "tridsjty56wkglyuoegds";
//$CRYKEY["b"]= "iymgher47698hv54ndotj";
//$CRYKEY["c"]= "ld7nf5k4h4epqmgeu43mf";
$CRYKEY["a"]= "qswcw64hrus0htlci6gnv";
$CRYKEY["b"]= "zpms6chg9fj7h9kchwhr1";
$CRYKEY["c"]= "wshusvqihrncwershgtoc";
$CRYKEY["d"]= "zhr7h9k19fjchwpms6chg";
$CRYKEY["e"]= "qi6gncw64sw0htlchrusv";
# ����� ������ � ����������� ��� - ���� �������� ������� 
define (FIRCHA, "yrlzewxpbcskfdtvnqoghmau");
# �� ����� ����� ������ �������� ������ �� ������ � ������� - ���� ���������� ������� 
define (CHAKEY, "babcabcddabcdeceabcdeade");

//# ����������/������������ �� ������ - � ����� ���� 
//function mycrypt($dire,$data,$key){
# ����������/������������ �� ������ - ������ 1��� ������ 
# get : ������������ 
# put : ���������� 
function mycrypt($dire,$data){
global $CRYKEY;
									# �� ����������/������������ - ������������� ������ 
									$initvector= "74020963864023419675605638693419";
									//$initvector= "86406934192341796756040209635638";
/*
	# ����� �� �������� ���� �� ������� 
	$dataname= "ccdata";
	# ����� �� ������ �� ������� 
	$stamname= "stamp";
	# ������� �� �������� �� ������� 
	# ��������. 
	# ������ �� �������� � ���� �� ������� aduser3.tpl 
	$arfiel= array("ccnumber","cctype","ccexmo","ccexye","cccode");
*/
	# �������� 
	if (0){
	}elseif ($dire=="get"){
			# ������� ����������� ������ 
#---- ���-2008 rame18 ------------------------------------
# ��������� ������ : Warning: mdecrypt_generic()... 
# ������� : ������ ������ $data 
# ������� : ����� �������� ����� �� ���������� �������� �� ��������� 
# ����������� �� 
if (empty($data)){
	$decrypted= "";
}else{
			$encrypted= $data;
			# ���������� ������������ [] �� ������� 
			$encrypted= substr($encrypted,1,strlen($encrypted)-2);
	# ���������� ����� �� 1��� ������ 
	$fircha= substr($encrypted,0,1);
	$infircha= strpos(FIRCHA,$fircha);
	if ($infircha===false){
die("GPcred=1st=$mychar");
	}else{
	}
	$indkey= substr(CHAKEY,$infircha,1);
	$key= $CRYKEY[$indkey];
//print "mychar=[$fircha][$indkey]";
	# ���������� 1��� ������ 
	$encrypted= substr($encrypted,1);
			# ���������� �� ���������� ����������� 
			$encrypted= base64_decode($encrypted);
									# ������������ ������� 
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
		# ���������� ������� ���� � 1��� ������ 
		$infircha= rand(0,strlen(FIRCHA)-1);
		$fircha= substr(FIRCHA,$infircha,1);
		$indkey= substr(CHAKEY,$infircha,1);
		$key= $CRYKEY[$indkey];
//print "mychar=[$fircha][$indkey]";
		
									# ���������� ������� ������ 
								//	$cipher = mcrypt_module_open(MCRYPT_BLOWFISH,'','cbc','');
									$cipher = mcrypt_module_open('rijndael-256', '', 'ofb', '');
									mcrypt_generic_init($cipher, $key, $initvector);
									$encrypted = mcrypt_generic($cipher,$data);
									mcrypt_generic_deinit($cipher);
			# ���� ������� - �� MySQL 
			$encrypted= base64_encode($encrypted);
			# ��� � �������� ��� � ���� �� ������� ��� space, MySQL �� �� �������� 
//			# ������ ���������� ������� � ��������� [] 
//			$encrypted= "[".$encrypted."]";
			# ������ ���������� ������� � ��������� qm 
			# �������� � 1��� ������ 
			$encrypted= "q" .$fircha .$encrypted ."m";
return $encrypted;

	}else{
die("GPcred=dire=$dire");
	}
}


#---------------------- dklab/dbsimple ---------------------------
		# ���������� �������� �� ���� 
		# rame9 - ������ �������������� ��������� �� ������. /FCKlocal - fclgetpage.php 
		if (defined("DKLAB_PREFIX")){
$dkpref= DKLAB_PREFIX;
		}else{
$dkpref= "";
		}
//$dkpref = __DIR__."/../";
require_once $dkpref."dklab/dbsimple/Generic.php";

/*
					#----------------- ��� ��������� ------------------
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
// ������������ � ��.
$DB = DbSimple_Generic::connect($dbconst);
							# �������� 
//							$DB->query("SET NAMES 'cp1251'");
//							$DB->query("SET CHARACTER SET 'cp1251'");
							$DB->query("SET NAMES 'utf8'");
//							$DB->query("SET CHARACTER SET 'utf8'");

// ������������� ���������� ������.
$DB->setErrorHandler('databaseErrorHandler');
function databaseErrorHandler($message, $info)
{
	// ���� �������������� @, ������ �� ������.
	if (!error_reporting()) return;
	// ������� ��������� ���������� �� ������.
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



#--------------------------------- ���� ������� -------------------------------------

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

# ����� URL �� ������� � reload 
function geturl($p1){
return "?" .rawurlencode($p1);
}

# ���������� ������� ������������ ������ 
# ����� ����.����� � ����������� 
function getparam(){
	$aget= array_keys($_GET);
	$aget= rawurldecode($aget[0]);
	if (empty($aget)){
	}else{
		$resupara= array();
		parse_str($aget ,$resupara);
	}
return $resupara;
}

# ��� �������� �� � ����� - redirect 
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

# ������ � �������� �� ������� - �� select/option 
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
		# ��������. ��������. 
		# �������� ������������ �� ������ ��� ������� - ������ array_merge 
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

# ����� ���� ����� �� ������� ���� ����� 
function getrow($taname,$paid){
global $DB;
	$row= $DB->selectRow("select * from $taname where id=?" ,$paid);
	$row= dbconv($row);
//			# 13.03.2009 ����� - ����� �� ����������� � ���.��������� 
//			$row= nl2br($row);
//			array_walk($row,"getrowbr");
return $row;
}
//			function getrowbr(&$p1){
//				$p1= nl2br($p1);
//			}

# �������� ���� ����� �� ������� 
function updrow($taname,$paid,$code){
global $DB;
	$DB->query("update $taname set $code where id=?" ,$paid);
//return $row;
}

#------------------------------------------------------------
# ������� (�����������) ����� �� ������
function printarr(&$parr,$ptxt="array"){
	print "<br>=============== $ptxt ===================";
	foreach($parr as $arna=>$arco){
		print "<br>$ptxt=$arna=$arco";
//		print "<br>$ptxt=$arna=" .htmlentities($arco,ENT_QUOTES);
	}
	print "<br>";
}

/******
# ����� js ��� �� ����� �� nyromodal-iframe ���� ������� ������ 
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

	# 13.03.2009 ����� - ��������� �� ����� ������ 
	# � �������� ������� �� nyroModal - modal:true - �� �� ������� ��� ���� ����� ��������� � ���� Esc 
	# ���� �� ���������� ������ � id="closeBut" 
$NYROREMOVE= "parent.$.nyroModalRemove();";
	# ������ ���������� ������������ ����� nyroModalRemove 
# ����� js ��� �� ����� �� nyromodal-iframe ���� ������� ������ 
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

# ����� js ��� �� ����� �� nyromodal-iframe ���� ������� ������ 
# ������, �� �� ������� ��������, �� �� ����������� 
# � ��� ����� 
# 15.01.2009 - ��������� ���������� � cazo6.php, cazo6.tpl 
# ���� ���� �� �� �������� 
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

# ������������ ��/��� UTF8 
function toutf8 ($p1){
	if (is_array($p1)){
		$resu= array();
		foreach($p1 as $indx=>$cont){
//			$resu[$indx]= toutf8($cont);
			# ��������. 24.04.2009 
			# ������������ � ������� - ������ ���������� �� select-optgroup-option 
			# ��� FormPersister 
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


# ������� � ����� ������ �� FCKeditor 
function getFCK($editname){
//	$sBasePath= "./FCK151/";
//	$sBasePath= "FCK151/";
	$sBasePath= "FCK2641/";
	include($sBasePath."fckeditor.php") ;
	$oFCKeditor = new FCKeditor($editname) ;
	$oFCKeditor->BasePath= $sBasePath;
#---- �����-2008 rame14 ---------------------------------------
# ������ ��� - ��������� ! 
							# ���������� ��������� ������� �� URL - ������������ 
							# ������ : rame14, ramekins 
							$htrefe= $_SERVER["HTTP_REFERER"];
							$arcp= explode("?",$htrefe);
							$ar2= explode("/",$arcp[0]);
/*
							$prefpath= $ar2[count($ar2)-2];
				# ����������� ������ ��� 
				$oFCKeditor->myFullPath= "/".$prefpath."/".$sBasePath;
*/
				# ����������� ������ ��� 
				$oFCKeditor->myFullPath= "/" .$sBasePath;
return $oFCKeditor;
}


/*
# ������� �� print_r �� ����� 
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
function print_ru($p1){
	$resu= print_rr(toutf8($p1));
}
function print_rif($p1){
	$resu= print_r($p1,true);
	$wkname= "cache/" .md5(microtime());
	file_put_contents($wkname,$resu);
	print "<iframe src='$wkname'>".$resu."</iframe>";
}
# 09.02.2011 - ������� ������� ���� 
function print_rr_file($parray,$pname){
	file_put_contents($pname,print_r($parray,true));
}

function nldelete($p1){
	$resu= $p1;
	$resu= str_replace("\r","",$resu);
	$resu= str_replace("\n","",$resu);
return $resu;
}

						#--------------------------- ������������ ------------------------------- 
						# ���-����� ������ ����������� �� �������� �� RegExp 
						include "commvali.php";







/************************************

									# ����� �� ����������� 
									include_once "edit.class.php";
#----------------- �������� ����������� -----------------------

				if (isset($mfacproc)){
				}else{
$mfacproc= $mfac->process();
				}
//print "MFACPROC=[$mfacproc]";

									# ������� ������ ��������� - 
									# $edit - $taname.id  

if (0){

#------ ������ 
}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	if ($edit==0){
							#---- ������ � ����������� ���������� 
	}else{
		$rocont= $DB->selectRow("select * from $taname where id=?" ,$edit);
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$_POST[$finame]= $rocont[$finame];
			}
		}
							#---- ������ � ����������� ���������� 
	}

#------ submit ��� �������� ������ 
}elseif ($mfacproc=="submit"){
							$retucode= 0;
											# ����������� �� ������������ ������ 
											$lister= array();

											# ������ ���� ��� ������ 
											if (count($lister)<>0){
												#---- ��� ---- 
	$smarty->assign("LISTER",$lister);
							$retucode= 1;
											}else{
												#---- ���� ---- 
							$retucode= 0;
		$aset= $ficonst;
		foreach($filist as $finame=>$ficont){
			if ($ficont["inactive"]){
			}else{
				$aset[$finame]= $_POST[$finame];
			}
		}
	if ($edit==0){
							#---- ������ � ����������� ���������� 
		# ��� ����� 
		$edit= $DB->query("insert into $taname set ?a" ,$aset);
	}else{
							#---- ������ � ����������� ���������� 
		# �������� �� ������ 
		$DB->query("update $taname set ?a where id=?d" ,$aset,$edit);
	}
											# ���� - ������ ���� ��� ������ 
											}

#------ submit � �������� ������ 
}elseif ($mfacproc==NULL){
							$retucode= 1;
	doerrors();

#------ ����������� submit -----------------------------------------------------
}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

#------ ���������� ������ �� ������������ 
}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

#----------------- ���� �� ���������� ����������� -----------------------

# �������� 
if ($retucode==0){
	# redirect 
	reload("parent",$relurl);
}else{
	# ��������� ������� 
	$smarty->assign("EDIT", $edit);
	$smarty->assign("FILIST", $filist);
//sdisplay(1, "eeee.html", $tpname);
//print "<xmp>".smdisp($tpname,"iconv")."</xmp>";
	print smdisp($tpname,"iconv");
}
************************************/







/****
# ���������� ������� �� ��������� INIT 
$obedit->funcinit= "funcinit";

# ������� �� INIT 
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
