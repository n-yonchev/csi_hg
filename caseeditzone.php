<?php
# 2-ро ниво - 
# извежда съдържание в една от 6-те зони за текущото дело 
# вика се директно с криптиран параметричен низ 

#--------------------------------------------------------------------
# 26.07.2010 - заради наблюдател 
#--------------------------------------------------------------------
									include_once "common.php";

# вземаме масива с входните параметри 
$GETPARAM= getparam();

			$sena= $GETPARAM["sena"];
			if (isset($sena)){
session_name($sena);
//print "caseeditzone=".$sena."]";
			}else{
			}
#--------------------------------------------------------------------

									# вика се самостоятелно, а не с include 
									session_start();
//									include_once "common.php";

					$smarty->assign("CASEALL", $CASEALL);
					//$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
//print "caseeditzone=";
//var_dump($CASEALL);
//print "caseeditzone=";
//var_dump($FLAGNOCHANGE);

# сесийните параметри 
$iduser= @$_SESSION["iduser"];

//sleep(1);
//+++# вземаме масива с входните параметри 
//+++$GETPARAM= getparam();

# входни параметри 
$edit= $GETPARAM["edit"];
$zone= $GETPARAM["zone"];
$func= $GETPARAM["func"];
//print "[$edit][$zone][$func]";

# 14.12.2010 
# финансист и друг деловодител да може да добавят погасяване в брой 
$FLAGNOCHANGE= getnochange($edit);
$smarty->assign("FLAGNOCHANGE", $FLAGNOCHANGE);
//print "caseeditzone=";
//var_dump($FLAGNOCHANGE);

# скриптовете според зоната 
$zonephp["base"]= "cazobase.php";
$zonephp[1]= "cazo1.php";
$zonephp[2]= "cazo2.php";
$zonephp[3]= "cazo3.php";
$zonephp[4]= "cazo4.php";
$zonephp["paym"]= "cazofina.php";
		//# 07.08.2009 - временно за Бургас - стар вариант 
		//$zonephp["paym"]= "cazopaym.php";
					#---- януари-2010 актуален дълг ----
					$zonephp["actu"]= "cazoactu.php";
$zonephp[5]= "cazo5.php";
$zonephp[6]= "cazo6.php";
# 07.08.2009 - извадка от журнала - дневник на изв.действия 
$zonephp["jour"]= "cazojour.php";
# 12.03.2010 зона-бележки и зона-събития 
$zonephp["note"]= "cazonote.php";
$zonephp["even"]= "cazoeven.php";
# 18.07.2010 аванс.вноски от взиск. 
$zonephp["adva"]= "cazoadva.php";

#---- 07.07.2009 финансов баланс [погасяване] ---- 
		# 16.05.2011 - извеждаме протокол - balist.txt 
				$ISLOGTXT= true;
$zonephp[7]= "cazobala.php";

# 22.11.2010 - сметки 
$zonephp["bill"]= "cazobill.php";

					# викаме скрипта 
					# - $pagecont получава съдържание 
if($GETPARAM["noaction"]=="yes"){
}elseif (file_exists($zonephp[$zone])){
					include_once $zonephp[$zone];
}else{
die("not.zone=$zone");
}

print $pagecont;


?>