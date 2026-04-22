<?php
#------------------ ЛЕПЕНКА ЗА АДМИНА -----------------------
# логовете от заявките изпратени към ИССИ
# отгоре : 
#    $GETPARAM - масив с параметрите от GET 
#    $mode - текущия режим 

include "pagi.class.php";

//# права само за админа 
//adminonly();
# логнатия потребител 
$idUser= @$_SESSION["iduser"];

# текущата страница 
//print_r($GETPARAM);
$page= $GETPARAM["page"];
$page= isset($page) ? $page : 1;

$view= $GETPARAM["view"];
if(isset($view)) {
    include_once "issi_log_view.php";
}

$tplName = 'issi_log.tpl';

$query = "SELECT * FROM issi_log ORDER BY data_date DESC";

$paginator = new paginator(20, 8, $query);

$prefUrl= "";
$baseUrl= "mode=".$mode;

$myList= $paginator->calculate($page, $prefUrl, $baseUrl);

$myList= dbconv($myList);

foreach($myList as $key => $item) {
    $newDate = new DateTime($item['date']);
    $newDate = $newDate->format('H:i d.m.Y');

    $myList[$key]['date'] = $newDate;
}

$smarty->assign("LIST", $myList);

$pagecont = smdisp($tplName, "fetch");