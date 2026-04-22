<?php
# разглеждане на справка от регистъра на длъжниците 
# отгоре : 
#    $mode= режима в глав.меню 
#    $page= текущата страница от списъка 
# $relurl - след успешен събмит 
# $modeel - базов стринг за събмит 
# управляващ : 
#    $resp - записа aadocuc2.id 
//print_r($GETPARAM);
//print "[$mode][$page][$princert]";

				sleep(1);

$fromview= $GETPARAM["fromview"]=="yes";
$smarty->assign("FROMVIEW", $fromview);

# данните 
$myquery= getcertqu() ." where aadocuc2.id=$resp";
$data= $DB->select($myquery);
$smarty->assign("ADRESAT", tran1251($data[0]["adresat"]));
//print_rr($data);

# отговора 
$response=  unserialize($data[0]["response"]);
//print_rr($response);
$smarty->assign("QURESU", tran1251($response["QueryResult"]));
//print_rr($response["QueryResult"]);

# документа автоматично 
//			$modeel= "mode=".$mode."&page=".$page;
			$toword= geturl($modeel."&word=".$resp);
$smarty->assign("TOWORD", $toword);

# извеждаме 
$tpname= "cer2resp.ajax.tpl";
print smdisp($tpname,"iconv");
//	$pagecont= smdisp($tpname,"iconv");


?>