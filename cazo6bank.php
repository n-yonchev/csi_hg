<?php
# отгоре : 
#     $BANKLIMI - MySQL код за фразата limit 

#------------------------------------------------------------------------------------------------------------
# 14.07.2009 - ЛЕПЕНКА специално за Бъзински 
# размножаване на банки за документа Запорно съобщение за банови сметки = _zb.html 
/*
				# подготвяме съдържанието 
				$cont= stripslashes($cont);
				# за абсолютния адрес на логото <img= src="http://......"> 
					$sear= ".php";
					$refe= $_SERVER["HTTP_REFERER"];
//print $refe;
					$pind= strpos($refe,$sear);
					if ($pind===false){
					}else{
						$subs= substr($refe,0,$pind);
						$pind= strrpos($subs,"/");
						$pref= substr($subs,0,$pind+1);
				$what= "[LOGOPREFIX]";
//var_dump($pref);
				$cont= str_replace($what,$pref,$cont);
					}
*/
		# подготвяме съдържанието 
		$cont= stripslashes($cont);
		# абсолютен адрес на логото <img= src="http://......"> 
		$cont= logotran($cont);
//print htmlentities($cont);
//print "<xmp>$cont</xmp>";
# списъка на банките 
//$banklist= $DB->selectCol("select name from banklist");
$banklist= $DB->selectCol("select name from banklist $BANKLIMI");
												//$newpage= '<div style="page-break-before: always;">&nbsp;</div>';
												//$newpage= "<!--NewPage-->";
														$newcont= "";
												//for ($i=1;$i<58;$i++){
												//	$docu2= str_replace($markbank, str_repeat($i,10), $cont);
																$i= 1;
												foreach ($banklist as $bankname){
													$docu2= str_replace($markbank, $bankname, $cont);
													//$docu2 .= "FOOTER";
													if ($i==1){
													}else{
														$newcont .= $newpage;
													}
													$newcont .= $docu2;
																			# втори екземпляр 
																			$newcont .= ($newpage .$docu2);
													//$newcont .= $newpage;
																$i += 1;
												}
//print "<xmp>$newcont</xmp>";
//--------------------ExcelHeader("zapor.doc");
							$cont= $newcont;

# край на лепенката 
#-------------------------------------------------------------------------------------

?>
