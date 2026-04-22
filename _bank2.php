<?php
									include_once "common.php";
									
$arbank= $DB->selectCol("select id as ARRAY_KEY, name from banklist");
$arbank= arstrip($arbank);
foreach($arbank as $idbank=>$name){
	$ipos= strpos($name,", ");
	if ($ipos===false){
	}else{
		$bankname= substr($name,0,$ipos);
		$bankaddr= substr($name,$ipos+2);
			$aset= array();
		$aset["name"]= $bankname;
		$aset["address"]= $bankaddr;
		$DB->query("update banklist set ?a where id=?d"  ,$aset,$idbank);
	}
}

?>