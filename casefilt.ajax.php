<?php
# въвеждане/корекция на филтър за списък дела
# отгоре :
#    $iduser - логнатия потребител
#    $mode - текущия режим на глав.меню   =="case"
#    $filt - режим за филтъра   =="change"
#    $page - към коя страница на списъка да преминем след submit
# сесията :
#    ["filtco"] - масив с полетата от филтъра

# шаблона
$tpname = "casefilt.ajax.tpl";
# всичко за филтъра по делата
include_once "casefilt.inc.php";
$filist = $filterlist;

# константни полета
$ficonst = array("iduser" => $iduser);

# reload - след успешен събмит
$relurl = geturl("mode=" . $mode . "&page=" . $page . "&filt=yes");

#----------------- директно редактиране -----------------------
# класа за редактиране
# само заради функцията doerrors
include_once "edit.class.php";

if (!isset($mfacproc)) {
    $mfacproc = $mfac->process();
}

if ($mfacproc == "INIT") {
    #------ начало
    $retucode = -1;
    $_POST = $_SESSION["filtco"];

    # 09.07.2009 - без jscalendar
    $exafte = $_POST["exafte"];
    $_POST["exafte"] = empty($exafte) ? $exafte : bgdatefrom($exafte);
    $exbefo = $_POST["exbefo"];
    $_POST["exbefo"] = empty($exbefo) ? $exbefo : bgdatefrom($exbefo);
    $last_finance = $_POST["last_finance"];
    $_POST["last_finance"] = empty($last_finance) ? $last_finance : bgdatefrom($last_finance);

} elseif ($mfacproc == "clear") {
    #------ submit за изчистване на полетата
    $retucode = 1;
    unset($_SESSION["filtco"]);
    unset($_POST);

} elseif ($mfacproc == "submit") {
    #------ submit без формални грешки
    $retucode = 0;
    # проверяваме за допълнителни грешки
    $lister = array();

    #---------------------------------------------------------------
    # датите - създадено след и преди
    $exafte = $_POST["exafte"];
    $exbefo = $_POST["exbefo"];
    $last_finance = $_POST["last_finance"];

    # 09.07.2009 - без jscalendar
    # - формална проверка на датите
    $resuafte = validator_bgdate_valid($exafte, "");
    $resubefo = validator_bgdate_valid($exbefo, "");
    $resulastfinance = validator_bgdate_valid($last_finance, "");
    $datevali = true;
    if ($resuafte !== true) {
        $datevali = false;
        $lister["exafte"] = $resuafte[0];
    }
    if ($resubefo !== true) {
        $datevali = false;
        $lister["exbefo"] = $resubefo[0];
    }
    if ($resulastfinance !== true) {
        $datevali = false;
        $lister["last_finance"] = $resulastfinance[0];
    }
    # - проверка на периода
    if ($datevali) {
        $exafte = empty($exafte) ? $exafte : bgdateto($exafte);
        $exbefo = empty($exbefo) ? $exbefo : bgdateto($exbefo);
        $last_finance = empty($last_finance) ? $last_finance : bgdateto($last_finance);
        if (!empty($exafte) and !empty($exbefo) and $exafte > $exbefo) {
            $lister["exafte"] = "грешен период";
            $lister["exbefo"] = "грешен период";
            $lister["last_finance"] = "грешен период";
        }
    }

    # ВНИМАНИЕ. 06.04.2010 - Софрониев
    # Вече има отделни полета за взискател и длъжник
    # - няма избор на обхват
    #---------------------------------------------------------------

    # според дали има грешка
    if (count($lister) <> 0) {
        #---- има ----
        $retucode = 1;
        $smarty->assign("LISTER", $lister);
    } else {
        #---- няма ----
        $retucode = 0;

        # 09.07.2009 - без jscalendar
        $_POST["exafte"] = $exafte;
        $_POST["exbefo"] = $exbefo;
        $_POST["last_finance"] = $last_finance;
        $_SESSION["filtco"] = $_POST;
        # край - според дали има грешка
    }

} elseif ($mfacproc == NULL) {
    #------ submit с формални грешки
    $retucode = 1;
    doerrors();

} elseif ($mfacproc == "UNKNOWN") {
    #------ автоматичен submit -----------------------------------------------------
    $retucode = 2;

} else {
    #------ невъзможна грешка от библиотеката
    print "<br>error=mfacproc=";
    var_dump($mfacproc);
    die();
}

#----------------- край на директното редактиране -----------------------

# резултат
if ($retucode == 0) {
    # redirect
    reload("parent", $relurl);
} else {

    # за избор на година [exyear] - предаваме името, а не съдържанието на масива
    # $listyear - отгоре - commspec.php
    $smarty->assign("ARYEARNAME", "listyear");

    # за избор на "идва от" - option/optgroup - името на масива
    $arfrom = selcofrom();
    $smarty->assign("ARFROMNAME", "arfrom");
    # за избор на "титул" - масива $listtitu - commspec.php
    # предаваме името, а не съдържанието на масива
    $smarty->assign("ARTITUNAME", "listtitu_utf8");

    # за избор на "вид дело" - масива $listsort - commspec.php
    # предаваме името, а не съдържанието на масива
    $smarty->assign("ARSORTNAME", "listsort_utf8");

    # за избор на обхват на участниците - предаваме името, а не съдържанието на масива
    # $listcaserang - отгоре - commspec.php
    $smarty->assign("ARRANGNAME", "listcaserang_utf8");
    # за избор на тип за участник - предаваме името, а не съдържанието на масива
    # $listmembtype - отгоре - commspec.php
    $smarty->assign("ARTYPENAME", "listmembtype_utf8");

    # 17.04.2009 - за избор на деловодител
    # не може да се филтрират делата, които нямат деловодител
    $userlist = getselect("user", "name", "inactive=0", true);
    # предаваме името, а не съдържанието на масива
    $smarty->assign("ARUSERNAME", "userlist");

    # 26.05.2009 - добавяме и ред за отчета, текущ статус и характер на изпълнението
    # не може да се филтрират делата, за които съответния указател е нулев
    # предаваме името, а не съдържанието на масива
    $smarty->assign("ARREPONAME", "listrepo_utf8");
    $smarty->assign("ARSTATNAME", "listcasestat_utf8");
    $smarty->assign("ARCHARNAME", "listchartype_utf8");

    # извеждаме формата
    $smarty->assign("EDIT", $edit);
    $smarty->assign("FILIST", $filist);
    print smdisp($tpname, "iconv");
}


?>
