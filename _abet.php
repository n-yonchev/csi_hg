<?php

									include_once "common.php";

/*
//$roar= $DB->select("select * from debtor where id=19");
$roar= getrow("debtor",19);
$name= $roar["name"];

var_dump($name);

for ($i=0; $i<strlen($name); $i++){
	$lett= substr($name,$i,1);
	print "<br>$lett=" .ord($lett);
}
*/
/*
		print '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
		';
*/
		print "<table border=1>";
//for ($i=0; $i<255; $i++){
for ($i=0; $i<513; $i++){
	$lett= $DB->selectCell("select char($i)");
	$st1251= to1251($lett);
	$stutf8= toutf8($lett);
		print "<tr><td> $i <td> $lett <td> $st1251 <td> $stutf8";
//		print "<tr><td> $i <td> $lett <td> $st1251";
}
		print "</table>";


/************************************

SELECT id,name,ord(name),ascii(name)
,upper(  substring(  replace(  replace(  replace(replace(  replace(  replace(trim(name),char(226),'')  ,char(0),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",'')  ,1,1)  )
as nameup
,ord(upper(  substring(  replace(  replace(  replace(replace(  replace(  replace(trim(name),char(226),'')  ,char(0),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",'')  ,1,1)  ) )
as nameord
,ascii(upper(  substring(  replace(  replace(  replace(replace(  replace(  replace(trim(name),char(226),'')  ,char(0),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",'')  ,1,1)  ) )
as nameasc
FROM `debtor` WHERE 1 order by name


SELECT id,name,ord(name),ascii(name)
,upper(  substring( trim( replace(  replace(  replace(replace(  replace(  replace(trim(name),char(226),'')  ,char(0),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",''))  ,1,1)  )
as nameup
,ord(upper(  substring( trim( replace(  replace(  replace(replace(  replace(  replace(trim(name),char(226),'')  ,char(0),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",''))  ,1,1)  ) )
as nameord
,ascii(upper(  substring( trim( replace(  replace(  replace(replace(  replace(  replace(trim(name),char(226),'')  ,char(0),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",''))  ,1,1)  ) )
as nameasc
FROM `debtor` WHERE 1 order by name


SELECT id,name,ord(name),ascii(name)
,upper(  substring( trim( replace(  replace(  replace(replace(  replace(  replace(trim(name),char(132),'')  ,char(148),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",''))  ,1,1)  )
as nameup
,ord(upper(  substring( trim( replace(  replace(  replace(replace(  replace(  replace(trim(name),char(132),'')  ,char(148),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",''))  ,1,1)  ) )
as nameord
,ascii(upper(  substring( trim( replace(  replace(  replace(replace(  replace(  replace(trim(name),char(132),'')  ,char(148),'')  ,'=','='),'\\"','')  ,'\\\\','')  ,"\'",''))  ,1,1)  ) )
as nameasc
FROM `debtor` WHERE 1 order by name


2124 	„ÀËÁÅÍÀ 2000 – ÑÒÐÎÈÒÅËÑÒÂÎ È ÈÍÆÅÍÅÐÈÍÃ 	14844062 	226  	  	0 	0
2088 	„ÀËÓÌÈÍÀ ÑÒÈË - 2” ÎÎÄ 	14844062 	226 	  	0 	0
2072 	„ÀÌÈÊÎ 68” ÅÎÎÄ 	14844062 	226 	  	0 	0
1609 	„ÀÍÈÂÀ ÅÀÃ” ÅÎÎÄ 	14844062 	226 	  	0 	0
2198 	„ÀÐÃÎÑÒÈË” ÅÎÎÄ 	14844062 	226 	  	0 	0
2342 	„ÀÐÃÎÑÒÈË” ÅÎÎÄ 	14844062 	226 	  	0 	0
2348 	„ÀÐÃÎÑÒÈË” ÅÎÎÄ 	14844062 	226 	  	0 	0

************************************/

?>
