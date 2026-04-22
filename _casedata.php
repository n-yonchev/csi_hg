<?php
# извеждаме всички дела, които имат бележки или събития 

									session_start();
									include "common.php";

$mylist= $DB->select("
	(select id from suit where notes<>'') 
	union distinct
	(select idcase as id from suitevent) 
	order by id
	");
/*
$mylist= $DB->select("
(select distinct $mycrit as marker from claimer where $upsuna='$lettutf8') 
union distinct
(select distinct $mycrit as marker from debtor  where $upsuna='$lettutf8') 
order by marker
	select suit.*, suit.id as id, user.name as username
	, suitevent.date as evendate, suitevent.text as eventext
	from suit
	left join user on suit.iduser=user.id
	left join suitevent on suitevent.idcase=suit.id
	where suit.notes<>'' or suitevent.id is not null
	");
*/
//$mylist= dbconv($mylist);

							print '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
							';
							print "<style>td{font:normal 8pt verdana}</style>";
							print "<table align=center>";
foreach($mylist as $elem){
							print "<tr>";
							print "<td>"."[".$elem["id"]."]";
							print "<td>".$elem["serial"]."/".$elem["year"];
							print "<td>".$elem["username"];
}
							print "</table>";
							print '
</body>
</html>
							';

?>
