<?php
# справки от регистър на длъжниците 2 - дек.2012 
# искания, създадени от ЧСИ - със/без входящ номер 
# източник : certif.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page= текущата страница от списъка 

								# за обръщение към сървъра 
								include_once "regicert/nusoap.php";
									# всичко за справките 2 
									include_once "cer2.inc.php";

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
//print_rr($_POST);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

# reload - след успешен събмит 
$modeel= "mode=".$mode."&page=".$page;
$relurl= geturl("mode=".$mode."&page=".$page);

									# корекция на избран запис 
									$edit= $GETPARAM["edit"];
									if (isset($edit)){
										include_once "cer2edit.ajax.php";
										exit;
									}else{
									}
									# от сървъра - номер искане 
									$getcoderequ= $GETPARAM["getcoderequ"];
									if (isset($getcoderequ)){
										include_once "cer2coderequ.ajax.php";
										exit;
									}else{
									}
									# избрано локално искане 
									# към сървъра - номер искане за справка 
									$code= $GETPARAM["code"];
									if (isset($code)){
										include_once "cer2code.ajax.php";
										exit;
									}else{
									}
					# въведен номер-искане 
					$trancodeto= $GETPARAM["trancodeto"];
					if (isset($trancodeto)){
						$requ= $_POST["requ"];
//						if (isset($requ)){
							$requ= tran1251($requ);
							$rel3= geturl($modeel."&code=".$requ);
//						}else{
//						}
						print $rel3;
										exit;
					}else{
					}
									# резултата от справката 
									$resp= $GETPARAM["resp"];
									if (isset($resp)){
										include "cer2resp.ajax.php";
										exit;
									}else{
									}
							# извеждане на word файл за избрания запис - справката 
							$word= $GETPARAM["word"];
							if (isset($word)){
								include "cer2word.ajax.php";
								exit;
							}else{
							}
							# извеждане на pdf файл за избрания запис - фактурата 
							$pdfview= $GETPARAM["pdfview"];
							if (isset($pdfview)){
								include "cer2pdfv.ajax.php";
								exit;
							}else{
							}

# списъка 
$myquery= getcertqu() ."order by aadocuc2.id desc";

		# странициране заедно с dbsimple [dklab] 
					include "pagi.class.php";
		$query= $myquery;
		$prefurl= "";
		$baseurl= "mode=".$mode;
//		$obpagi= new paginator(18, 8, $query);
		$obpagi= new paginator(20, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);
//print_rr(toutf8($mylist));

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
				$modeel= "mode=".$mode."&page=".$page;
foreach ($mylist as $uskey=>$uscont){
				$idcurr= $uscont["id"];
	$mylist[$uskey]["edit"]= geturl($modeel."&edit=".$idcurr);
	$mylist[$uskey]["getcoderequ"]= geturl($modeel."&getcoderequ=".$idcurr);
//	$mylist[$uskey]["codeto"]= geturl($modeel."&codeto=".$uscont["coderequ"]);
				$vari= getvari($uscont);
//print "<br>[$vari]";
	$mylist[$uskey]["vari"]= $vari;
	$mylist[$uskey]["code"]= geturl($modeel."&code=".$uscont["coderequ"]."&vari=".$vari);
	$mylist[$uskey]["resp"]= geturl($modeel."&resp=".$idcurr);
	$mylist[$uskey]["pdfview"]= geturl($modeel."&pdfview=".$idcurr);
				# 13.04.2009 - маскираме спец.символи в коментара 
	$mylist[$uskey]["notes"]= htmlspecialchars( $mylist[$uskey]["notes"] ,ENT_QUOTES);
				# повторни действия 
	$mylist[$uskey]["sec3"]= geturl($modeel."&code=".$uscont["coderequ"]."&vari=3");
	$mylist[$uskey]["sec4"]= geturl($modeel."&code=".$uscont["coderequ"]."&vari=4");
}
//print_ru($mylist);

# add new link 
$addnew= geturl($modeel."&edit=0");

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
	$trancodeto= geturl($modeel."&trancodeto=yes");
	$smarty->assign("TRANCODETO", $trancodeto);
$smarty->assign("LIST", $mylist);
$pagecont= smdisp("cer2.tpl","fetch");


?>
