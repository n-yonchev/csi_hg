<?php
# 22.12.2009 - брой дела за миналите години 

								session_start();
								include_once "common.php";

$year= $_GET["year"];
$coun= $_GET["coun"];
$crea= $_GET["crea"];
//print "[$year][$coun][$crea]";
if ($coun+0<=0){
	print toutf8("въведи броя");
return;
}else{
}

# създаване на нови дела с пропуснатите номера 
# дата на образуване = 1 януари от годината 
# доп.информация за създаването - полето creainfo .= "/1" 
if ($crea=="yes"){
//	print toutf8("<br>СЪЗДАДЕНИ");
		$query= "select serial from suit where year=$year order by serial";
		$mylist= $DB->selectCol($query);
							$coinse= 0;
		for ($myse=1; $myse<=$coun; $myse++){
			if (in_array($myse,$mylist)){
			}else{
				$iset= array();
				$iset["serial"]= $myse;
				$iset["year"]= $year;
				$iset["created"]= "$year-01-01";
				$iset["creainfo"]= "/1";
				$DB->query("insert into suit set ?a"  ,$iset);
							$coinse ++;
			}
		}
}else{
}

# колко дела има с по-големи номера 
$query= "select count(*) as coun from suit where year=$year and serial>$coun";
$mycoun= $DB->selectCell($query);
if ($mycoun==0){
	print toutf8("няма дела с по-големи номера");
}else{
	print toutf8("има $mycoun дела с по-големи номера");
}

# колко пропуснати номера на дела има за тази година 
$query= "select serial from suit where year=$year order by serial";
$mylist= $DB->selectCol($query);
				$comiss= 0;
for ($myse=1; $myse<=$coun; $myse++){
	if (in_array($myse,$mylist)){
	}else{
				$comiss ++;
	}
}
if ($comiss==0){
	print toutf8("<br>няма пропуснати номера");
}else{
	print toutf8("<br>има $comiss пропуснати номера<br><a href='#' style=\"border-bottom:1px solid black;\" onclick=\"checkyear('$year','*');\">създай ги</a>");
}

# съобщанието за създаване на нови дела с пропуснатите номера 
if ($crea=="yes"){
	print toutf8("<br>СЪЗДАДЕНИ $coinse нови дела");
}else{
}

?>
