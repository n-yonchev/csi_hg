<?php
# обслужване на изх.документи с много адресати 

function getbranlist($tablname,$extra){
global $DB;

			$myarbran= $DB->select("select * from $tablname limit 1");
											if (isset($myarbran[0]["serial"])){
				$arbran= $DB->selectCol("select id as ARRAY_KEY, name from $tablname order by serial");
											}else{
				$arbran= getselect($tablname,"name","",false);
											}
				$arbran= dbconv($arbran);
			# 20.01.2010 ВНИМАНИЕ. ЛЕПЕНКА. 
			# Бл.град Дервиш - Запорно съобщение до банки - при генериране има чекнати банки 
			# Премахваме банките извън този списък. 
//			if (isset($extra)){
			if (!empty($extra)){
				$arex= unserialize($extra);
							$ar22= array();
				foreach($arbran as $baid=>$elem){
					if (in_array($baid,$arex)){
							$ar22[$baid]= $elem;
					}else{
					}
				}
$arbran= $ar22;
			}else{
			}
$arbran= str_replace('"','',$arbran);
//$arbran= addsla($arbran);
//print_r(toutf8($arbran));

return $arbran;
}

?>
