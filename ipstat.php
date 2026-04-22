<?php

$notchosen= "_N_O_";

$ipgett= $GETPARAM["ippara"];
	$ipvalu= (!isset($ipgett) or $ipgett==$notchosen) ? 0 : $ipgett;
$usgett= $GETPARAM["uspara"];
	$usvalu= (!isset($usgett) or $usgett==$notchosen) ? -1 : $usgett;
$dagett= $GETPARAM["dapara"];
	$davalu= (!isset($dagett) or $dagett==$notchosen) ? "" : $dagett;
//print "begin=[$ipvalu][$usvalu]<br>";

$mfacproc= $mfac->process();
//var_dump($mfacproc);

if (0){

}elseif ($mfacproc=="INIT"){
							$retucode= -1;
	$_POST["ippara"]= $ipvalu;
	$_POST["uspara"]= $usvalu;
	$_POST["dapara"]= $davalu;
}elseif ($mfacproc=="submit"){
							$retucode= 0;
	$ipvalu= $_POST["ippara"];
	$usvalu= $_POST["uspara"];
	$davalu= $_POST["dapara"];

}elseif ($mfacproc==NULL){
							$retucode= 1;
//	doerrors();

}elseif ($mfacproc=="UNKNOWN"){
							$retucode= 2;

}else{
print "<br>error=mfacproc=";
var_dump($mfacproc);
die();
}

$ipgett= $ipvalu==0 ? $notchosen : $ipvalu;
$usgett= $usvalu==-1 ? $notchosen : $usvalu;
$dagett= $davalu=="" ? $notchosen : $davalu;

				$arip= $DB->selectCol("select distinct ipaddr, ipaddr as ARRAY_KEY from ipuser order by ipaddr");
				$arip= array(0=>"--- all ---") + $arip;
				$smarty->assign("ARIPNAME", "arip");

				$aruser= getselect("user","name","1",false);
				$aruser_1251= dbconv($aruser);
				$aruser= array(-1=>"--- all ---", 0=>"[no user]") + $aruser;
				$smarty->assign("ARUSER", $aruser_1251);
				$smarty->assign("ARUSERNAME", "aruser");



$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;
										$filter= "1";
										$filter .= $ipvalu==0 ? "" : " and ipaddr='$ipvalu'";
										$filter .= $usvalu==-1 ? "" : " and iduser='$usvalu'";
										$filter .= $davalu=="" ? "" : " and date(time)='$davalu'";
//print "[$ipvalu][$usvalu]";
//var_dump($filter);

					include "pagi.class.php";
		$query= "select * from ipuser where $filter order by id desc";
		$prefurl= "";
//print "baseurl=[$ipgett][$usgett]<br>";
$baseurl= "mode=".$mode ."&ippara=".$ipgett ."&uspara=".$usgett;
		$obpagi= new paginator(100, 8, $query);
		$mylist= $obpagi->calculate($page, $prefurl, $baseurl);
$mylist= dbconv($mylist);

			$arvisu[0]= array("-", "", "");
			$arvisu[1]= array("htaccess"  ,"white" ,"orange");
			$arvisu[2]= array("loginip"   ,"white" ,"red");
			$arvisu[3]= array("logindata" ,"white" ,"blue");
			$smarty->assign("ARVISU", $arvisu);

$smarty->assign("LIST", $mylist);
$pagecont= smdisp("ipstat.tpl","fetch");

?>
