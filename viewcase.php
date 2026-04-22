<?php
# списък дела на наблюдател 
# източник : caseall2.php 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
//print "SESSname=".$view_sess_name;

# логнатия наблюдател =viewer.id 
$iduser= @$_SESSION["iduser"];
//var_dump($iduser);

$CASEALL= true;
			# заради cazobase.php 
			$_SESSION["FLAGALL"]= true;

# изкуствен филтър 
$filt= "all";

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
				
# 23.07.2010 - променен шаблон 
$tplnam= "case4.tpl";
# да се извежда списък с взискатели и длъжници - НЕЕФЕКТИВНО 
$ISFILTACTION= true;

# делата само на логнатия наблюдател 
$ext1= "left join (select * from viewersuit where idviewer=$iduser) as t2 on t2.idcase=suit.id";
$ext2= "and t2.id is not null";

# текущата страница 
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

		# корекция на избран запис 
		$edit= $GETPARAM["edit"];
		if (isset($edit)){
							include_once "viewcaseedit.php";

$smarty->assign("PAGEBACK", $page);
//print "mode=".$mode ."&page=".$page;
$smarty->assign("PAGEBACKLINK", geturl("mode=".$mode ."&page=".$page ."&filt=".$filt));
$pagecont= smdisp("caseedit.tpl","fetch");
return;
		}else{
		}

					# извеждаме списъка 
					include "case.php";
		

?>
