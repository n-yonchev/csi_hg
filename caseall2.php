<?php
# всички дела по филтъра за НЕделоводител 
# източник : caseall.php 

$CASEALL= true;
			# заради cazobase.php 
			$_SESSION["FLAGALL"]= true;

# 04.05.2009 - делата са разделени на активни и прекратени 
# тук влизат и двата вида - не използваме този елемент от филтъра 
$FILTACTI= "not in (-1)";

				# не може да се корегират 
//				$FLAGNOCHANGE= getnochange($edit);
				$FLAGNOCHANGE= true;
		
# да излизат табовете 
//$FLAGYESSTAT= true;
//$_SESSION["FLAGYESSTAT"]= true;
$smarty->assign("FLAGBACK", true);

# да няма назначаване на деловодител 
$smarty->assign("VIEWUSERNAME", false);
				
# 23.07.2010 - променен шаблон Бъзински 
$tplnam= "case3.tpl";
$ISFILTACTION= true;

					include "case.php";

?>