<?php
									session_start();
									include_once "common.php";

								# 18.08.2014 - връчване 
								include_once "deli.inc.php";

$iddocuout= $_GET["p"];
			
			$ardeli= $DB->select("
				select post.id as ARRAY_KEY
					, post.*
					, poststat.name as statname
					, if($codepostempty,1,0) as nopostdata
					, if(post.idpoststat=0 or post.idposttype=poststat.idtype,0,1) as isertype
				from post
					left join poststat on post.idpoststat=poststat.id 
				where post.iddocuout=?d
				"  ,$iddocuout);
			$ardeli= dbconv($ardeli);
//print_ru($ardeli);
			$smarty->assign("ARDELI", $ardeli);

print smdisp("deliinfodocu.ajax.tpl","iconv");

?>
