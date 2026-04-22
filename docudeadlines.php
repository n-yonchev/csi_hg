<?php
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

//# права само за админа 
//adminonly();
# логнатия потребител 
$iduser = @$_SESSION["iduser"];


# текущата страница 
//print_r($GETPARAM);
$page = $GETPARAM["page"];
$type = $GETPARAM["type"];
$page = isset($page) ? $page : 1;
$type = (in_array($type, array('done', 'expired', 'active', 'discard'))) ? $type : "active";

$links = array(
    'active'  => array('name' => "активни",    'url' => geturl($modeel = "mode=" . $mode . "&type=active")),
    'expired' => array('name' => "изтекли",    'url' => geturl($modeel = "mode=" . $mode . "&type=expired")),
    'done'    => array('name' => "изпълнени",  'url' => geturl($modeel = "mode=" . $mode . "&type=done")),
    'discard' => array('name' => "отхвърлени", 'url' => geturl($modeel = "mode=" . $mode . "&type=discard")),
);
$smarty->assign("LINKS", $links);
$smarty->assign("TYPE", $type);

# общи параметри 
$modeel = "mode=" . $mode . "&type=" . $type . "&page=" . $page;
$relurl = geturl($modeel);

# корекция на избран запис
$edit = $GETPARAM["edit"];
if (isset($edit)) {
    include_once "docudeadlines.ajax.php";
    exit;
} else {
}

if ($type == 'active') {
    $where_status = "IS NULL";
    $where_remaining_days = "and datediff(date_add(docu.created, INTERVAL dt.deadline_days DAY), NOW()) >= 0";
    $order_days = "remaining_days ASC";
} elseif ($type == 'done') {
    $where_status = "= 1";
    $order_days = "remaining_days ASC";
} elseif ($type == 'expired') {
    $where_status = "IS NULL";
    $where_remaining_days = "and datediff(date_add(docu.created, INTERVAL dt.deadline_days DAY), NOW()) < 0";
    $order_days = "remaining_days DESC";
} else {
    // discard
    $where_status = "= 2";
    $where_remaining_days = "";
    $order_days = "remaining_days ASC";
}


$myquery = "
	select 
		docu.* ,
		docu.id as id,
		u2.name as u2name,
		deadline_days,
		docu.created,
        date_add(docu.created, INTERVAL dt.deadline_days DAY) as due_date,
        datediff(date_add(docu.created, INTERVAL dt.deadline_days DAY), NOW()) as remaining_days,
        dd.status,
        dd.date,
        ddu.name as ddu_name,
        dd.comment as dd_comment

		
	from docu
	left join user as u2 on docu.iduser=u2.id
	left join aadocutype as dt on docu.idtype=dt.id
	left join docu_deadlines dd on dd.iddocu = docu.id
	left join user as ddu on dd.iduser=ddu.id
	where 
	    dt.deadline_days > 0 
	    and dd.status $where_status 
	    $where_remaining_days
	order by 
	    docu.year desc, 
		docu.serial desc
	";

# странициране заедно с dbsimple [dklab]
include "pagi.class.php";
$query = $myquery;
$prefurl = "";
$baseurl = "mode=" . $mode . "&type=" . $type ;
//		$obpagi= new paginator(18, 8, $query);
$obpagi = new paginator(50, 8, $query);
$mylist = $obpagi->calculate($page, $prefurl, $baseurl);
$mylist = dbconv($mylist);
//print_r(toutf8($mylist));

# трансформираме го - параметри за иконите 
//				$modeel= "mode=".$mode;
//				$modeel= "mode=".$mode."&page=".$page;
$arin = array();
foreach ($mylist as $uskey => $uscont) {
    $idcurr = $uscont["id"];
    $mylist[$uskey]["edit"] = geturl($modeel . "&edit=" . $idcurr);
    # 13.04.2009 - маскираме спец.символи в коментара
    $mylist[$uskey]["notes"] = htmlspecialchars($mylist[$uskey]["notes"], ENT_QUOTES);
    # 13.04 2009 - един документ - много дела
    # добавяме масив със свързаните дела
    # НЕЕФЕКТИВНО - заявки в цикъл
    /*
                    $casequ= "
                    select
                        suit.serial as caseseri ,suit.year as caseyear
                        ,user.name as username
                    from docusuit
                        left join suit on docusuit.idcase=suit.id
                        left join user on suit.iduser=user.id
                    where docusuit.iddocu=?d
                    order by docusuit.docurange
                    ";
                    $caselist= $DB->select($casequ ,$idcurr);
                    $caselist= dbconv($caselist);
    */
    $caselist = getcaselist($idcurr);
    $mylist[$uskey]["caselist"] = $caselist;
    # и броя на делата
    $mylist[$uskey]["casecoun"] = count($caselist);
    # и линк за разглеждане на списъка в nyroModal
    $mylist[$uskey]["viewlist"] = geturl($modeel . "&viewlist=" . $idcurr);
    # сканиран образ
    $arin[] = $idcurr;
    $mylist[$uskey]["linkdone"]    = geturl($modeel . "&action=done&edit=" . $idcurr);
    $mylist[$uskey]["linkdiscard"] = geturl($modeel . "&action=discard&edit=" . $idcurr);
    $mylist[$uskey]["scanview"] = geturl($modeel . "&scanview=" . $idcurr);
}
# брой сканирани образи по вх.документи
$codein = implode(",", $arin);
#$arscancoun= getscancoun("iddocu in ($codein)");
//print_rr($arscancoun);
$smarty->assign("ARSCANCOUN", $arscancoun);

# add new link 
$addnew = geturl($modeel . "&edit=0");

# 13.04 2009 - един документ - много дела
# допълнителни js линкове за секцията head 
$smarty->assign("HEADJS", array("cluetip.hoverIntent.js", "jquery.cluetip.js"));

# флага за образуване - не 
$_SESSION["iscreacase"] = false;

# извеждаме 
$smarty->assign("ADDNEW", $addnew);
$smarty->assign("LIST", $mylist);
$pagecont = smdisp("docudeadlines.tpl", "fetch");

# ВНИМАНИЕ. 
# Трябва да е след smdisp, защото след извеждането [display, fetch] 
# обекта $smarty губи назначенията $smarty->assign 
//# допълнителни js линкове за секцията head 
//$smarty->assign("HEADJS", array("_docu.js"));

?>
