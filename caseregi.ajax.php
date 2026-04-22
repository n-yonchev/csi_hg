<?php
#---- централен регистър ----

sleep(1);
									include_once "common.php";

/**/
$GETPARAM= getparam();
$uniqname= $GETPARAM["uniqname"];
if (isset($uniqname)){
}else{
	$uniqname= md5(microtime());
				$arpara= array();
	foreach($GETPARAM as $gename=>$gecont){
				$arpara[]= $gename."=".$gecont;
	}
				$arpara[]= "uniqname=".$uniqname;
	$gecode= implode("&",$arpara);
	$gelink= geturl($gecode);
	print "
<script>
document.location.href='$gelink';
</script>
	";
exit;
}
/**/

//$GETPARAM= getparam();
$iduser= @$_SESSION["iduser"];
print_rr($GETPARAM);
$edit= $GETPARAM["edit"];
$regi= $GETPARAM["regi"];
$iddebt= $GETPARAM["iddebt"];
/*					
					$uniqname= $_SESSION["uniqname"];
						if (isset($uniqname)){
						}else{
$uniqname= md5(microtime());
var_dump($uniqname);
					$_SESSION["uniqname"]= $uniqname;
						}
*/
//$uniqname= md5(microtime());
//var_dump($uniqname);

							include_once "caseregi.inc.php";
							
							if (0){
							}elseif ($regi=="act1"){
# syncAction - към регистъра - данните за делото $edit 
#---- самото дело 
putcases("id=$edit","idcase=$edit");
#---- длъжници (евент. и взискатели) 
putpersons("%s.idcase=$edit");
#---- произходи на вземане 
putorigins("idcase=$edit");
#---- обобщен zip файл 
putzip();
							}elseif ($regi=="act2"){
# queryDebtor - от регистъра - удостоверение за вписване на длъжник $iddebt 
							}elseif ($regi=="act3"){
# queryMyDebtor - от регистъра - справка за съвпадение на длъжник $iddebt 
							}else{
var_dump($regi);
die("=caseregi");
							}


//					unset($_SESSION["uniqname"]);

$tpname= "caseregi.ajax.tpl";
$smarty->assign("FILIST", $filist);
print smdisp($tpname,"iconv");

?>