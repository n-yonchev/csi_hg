<?php
# изтриване на банка 
# отгоре : 
#    $dele - id за изтриване 
//print_r($GETPARAM);
$action = $GETPARAM['action']=='done' ? "done" : "discard";

# таблицата 
$taname = "banklist";
# шаблона 
$tpname = "docudeadlines.ajax.tpl";
# полетата 
$filist = array();
# константни полета 
$ficonst = array();

# класа за редактиране
include_once "edit.class.php";

#----------------- директно редактиране -----------------------

$myquery = "
	select 
		docu.* ,
		docu.id as id,
		u2.name as u2name,
		deadline_days,
		docu.created
		
	from docu
	left join user as u2 on docu.iduser=u2.id
	left join aadocutype as dt on docu.idtype=dt.id
	where docu.id = ?";
$test = $DB->selectRow($myquery, $edit);
$test = dbconv($test);
$smarty->assign("DOCU", $test);

if (isset($mfacproc)) {
} else {
    $mfacproc = $mfac->process();
}
//print "MFACPROC=[$mfacproc]";
# основен параметър - $dele
if (0) {

    #------ начало
} elseif ($mfacproc == "INIT") {
    $retucode = -1;
    # данните за реда

    $rocont = getrow($taname, $dele);
    $name = $rocont["name"];

    #------ submit без формални грешки
    # потвърдено изтриване
} elseif ($mfacproc == "submyes") {
    $retucode = 0;
    $dataset = array();
    $dataset['iddocu']  = $edit;
    $dataset['status']  = ($action == 'done' ? 1 : 2);
    $dataset['date']    = date("Y-m-d H:i:s");
    $dataset['iduser']  = $_SESSION['iduser'];
    $dataset['comment'] = $_POST['comment'];
    $DB->query("insert into docu_deadlines set ?a", $dataset);

    #------ допълнителен бутон
    # отказ
} elseif ($mfacproc == "submno") {
    $retucode = 0;
    #echo "no";

    #------ submit с формални грешки
    # - невъзможно в случая
} elseif ($mfacproc == NULL) {
    //	# стандартна реакция
    $retucode = 1;
    //	doerrors();

    #------ автоматичен submit -----------------------------------------------------
    # - невъзможно в случая
} elseif ($mfacproc == "UNKNOWN") {
    $retucode = 2;

    #------ невъзможна грешка от библиотеката
} else {
    print "<br>error=mfacproc=";
    var_dump($mfacproc);
    die();
}

#----------------- край на директното редактиране -----------------------

# резултат 
if ($retucode == 0) {
    # redirect
    $relurl = geturl("mode=" . $mode);
    reload("parent", $relurl);
} else {
    # извеждаме формата

    $smarty->assign("ACTION", $action);
    $smarty->assign("NAME", $name);
    print smdisp($tpname, "iconv");
}
