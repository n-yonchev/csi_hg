<?php
									session_start();
									include_once "common.php";

# параметъра 
$htmlout= $_GET["htmlout"];
//print "<h2>$htmlout</h2>";

# съдържанието 
$cont= $DB->selectCell("select content from docuout where id=?d" ,$htmlout);


				# подготвяме съдържанието 
				$cont= stripslashes($cont);
//					$sear= "index.php";
					$sear= "caseeditzone.php";
					$refe= $_SERVER["HTTP_REFERER"];
//print "[$refe]";
					$pind= strpos($refe,$sear);
					if ($pind===false){
					}else{
						$pref= substr($refe,0,$pind);
				$what= "[LOGOPREFIX]";
//var_dump($pref);
				$cont= str_replace($what,$pref,$cont);
					}
//print htmlentities($cont);
//print "<xmp>$cont</xmp>";
//print "<xmp>".to1251($cont)."</xmp>";
# списъка на банките 
$banklist= $DB->selectCol("select name from banklist");
//var_dump($banklist);
//$banklist= dbconv($banklist);
//print_r($_SERVER);
												$markbank= "(-[ADRESAT_BANK]-)";
												$newpage= '<div style="page-break-before: always;">&nbsp;</div>';
											//	$newpage= "<!--NewPage-->";
														$newcont= "";
												//for ($i=1;$i<58;$i++){
												//	$docu2= str_replace($markbank, str_repeat($i,10), $cont);
																$i= 1;
												foreach ($banklist as $bankname){
													$docu2= str_replace($markbank, $bankname, $cont);
											//		$docu2 .= "FOOTER";
													if ($i==1){
													}else{
														$newcont .= $newpage;
													}
													$newcont .= $docu2;
													//$newcont .= $newpage;
																$i += 1;
													//#--------------- 2-ри екземпляр --------------
													//	$newcont .= $newpage;
													//$newcont .= $docu2;
													//			$i += 1;
												}
//print "<xmp>$newcont</xmp>";
					$cont= $newcont;
print to1251($newcont);

?>
