<?php
# формиране на нов изходящ банков пакет за плащане 
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 
#    $page - текущата страница 
# $cancel=0 - формираме нов пакет 
print "BAYMCREA";

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser= @$_SESSION["iduser"];


# нов пакет 
$newid= $DB->query("insert into bankpaym set created=now()");

# филтър за назначените постъпления, които още на са включени в изходящ пакет 
$filt= "idclaimer>0 and idbankpaym=0";
/*
# списък на тези постъпления 
$mylist= $DB->selectCell("select id from bank where $filt");
//$mylist= dbconv($mylist);
# назначаваме ги към новия пакет 
foreach($mylist as $cuid){
	$mylist= $DB->query("update bank where $filt");
}
*/
# назначаваме ги ВСИЧКИ ДИРЕКТНО към новия пакет 
$DB->query("update bank set idbankpaym=?d where $filt" ,$newid);

/*
# четем плащанията от новия пакет 
# източник : bapaelem.php 
		$query= "select bank.*, bank.id as id
				,claimer.name as clainame ,claimer.iban as claiiban ,claimer.bic as claibic
			from bank 
				left join claimer on bank.idclaimer=claimer.id
			where bank.idbankpaym=$newid
			order by bank.id
			";
$mylist= $DB->select($query);
$mylist= dbconv($mylist);
print_r($mylist);

# формираме масив за XML файла за експорт 
$const1= '<TRANSID>IBAN311</TRANSID>';
$const2= '<CURRENCY>BGN</CURRENCY>';
					# начало 
					$arxml= array();
					$arxml[]= '<?xml version="1.0" encoding="windows-1251" ?>';
					$arxml[]= '<PAYMENTS>';
foreach($mylist as $elem){
					$arxml[]= '<PAYMENT>';
					$arxml[]= $const1;
			$arxml[]= '<NAME_R>'.$elem["clainame"].'</NAME_R>';
			$arxml[]= '<IBAN_R>'.$elem["claiiban"].'</IBAN_R>';
			$arxml[]= '<BIC_R>'.$elem["claibic"].'</BIC_R>';
					$arxml[]= $const2;
	# сумата - трием запетаите за хилядите 
	$amou= str_replace(",","",$elem["AMOUNT_C"]);
	$arxml[]= '<JSUM>'.$amou.'</JSUM>';
			$arxml[]= '<REM_I>'.$elem["payrem1"].'</REM_I>';
			$arxml[]= '<REM_II>'.$elem["payrem2"].'</REM_II>';
					$arxml[]= '</PAYMENT>';
}
					# край 
					$arxml[]= '</PAYMENTS>';
print_r($arxml);

# формираме сания XML файл 
$xmltex= implode("\n",$arxml);
*/

# извеждаме XML файла за експорт 
print $xmltex;


?>
