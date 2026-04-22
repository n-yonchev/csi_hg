<?php

$edit = $caseId;

// cazo2.php SATRT
//-------------------------------------------------------
include_once('calculateDebtFuncs.php');

$x2_vat_coef= 1.2;

$arsu2type= array();
$arsu2type["a"]= "общи типове";
$arsu2type[0]= "неопределен";
$arsu2type[4]= "задължение";
$arsu2type[8]= "такса НЕ за сметка на длъжника";
$arsu2type["b"]= "такси за сметка на длъжника, които УЧАСТВАТ в изчисляване на лимита";
$arsu2type[12]= "пропорц.такса за опис (т.20)";
$arsu2type[16]= "друга пропорционална такса";
$arsu2type[20]= "друга проста такса";
$arsu2type["c"]= "такси и разноски за сметка на длъжника, които НЕ УЧАСТВАТ в изчисляване на лимита";
$arsu2type[24]= "такса за администриране на жалби срещу ЧСИ";
$arsu2type[28]= "такса за уведомяване на присъед.взискател";
$arsu2type[32]= "такса за присъединяване на взискател (т.11)";
$arsu2type[36]= "разноски по изпълнението (т.31)";

if (isset($edit)){

    $x2conotz= $DB->selectCell("select count(*) from subject where idcase=?d and idt2<>0"  ,$edit);
    if ($x2conotz==0){
        $arx2data= $DB->select("
            select subject.id as ARRAY_KEY, subject.idtype, subject.idsubtype, subject.isintax 
            from subject 
            where subject.idcase=?d and subject.idt2=0
        "  ,$edit);

        foreach($arx2data as $x2id=>$elem){
            $idt2= 0;
            $x2ty= $elem["idtype"];
            $x2st= $elem["idsubtype"];
            $x2is= $elem["isintax"];

            $x2code= $elem["code"];
            list($x2co1,$x2co2)= explode("^",$x2code);
            if (($x2ty==1 or $x2ty==3) and $x2is==1){
                $idt2= 4;
            }elseif($x2ty==2 and $x2st==4 and $x2is==1){
                $idt2= 4;
            }elseif($x2ty==2 and $x2st==16 and $x2is==0){
                $idt2= 36;
            }

            if (!($idt2==0)){
                $DB->query("update subject set idt2=?d where id=?d"  ,$idt2,$x2id);
            }
        }

    }

	$DB->query("
        update subject set idt2=?d where id in (
            select id from (
                select id from subject where idcase=?d and isintax=1
            ) as t2
        )
    ",4,$edit);
}

$arsu2nodebt= array(8);
$arsu2adva= array(12,16,20,  24,28,32,36);
$su2inve= 12;

$arsu4t= array();
$arsu4t[0]= 0;
$arsu4t[4]= 3;
$arsu4t[8]= 9;
$arsu4t[12]= 6;
$arsu4t[16]= 6;
$arsu4t[20]= 6;
$arsu4t[24]= 9;
$arsu4t[28]= 9;
$arsu4t[32]= 9;
$arsu4t[36]= 9;

$arx2gr= array();
$arx2gr[1]= 0.1;
$arx2gr[2]= 0.2;
$arx2gr[3]= 0.5;
$arx2gr[4]= 1;
$arx2gr[5]= 2;
$arx2gr[6]= 3;
$arx2gr[7]= 45;

$arx2grvisu= array();
$arx2grvisu[1]= "до 10 % МРЗ";
$arx2grvisu[2]= "10-20 % МРЗ";
$arx2grvisu[3]= "20-50 % МРЗ";
$arx2grvisu[4]= "50-100 % МРЗ";
$arx2grvisu[5]= "1-2 МРЗ";
$arx2grvisu[6]= "2-3 МРЗ";
$arx2grvisu[7]= "3-45 МРЗ";
$arx2grvisu[8]= "над 45 МРЗ";

$arx2text= array();
$arx2text["all"]=  "всички такси";
$arx2text["prop"]= "пропорц.такси";
$arx2text["debt"]= "задължение";
$arx2text["inve"]= "такса опис";
$arx2text["t26"]=  "точка 26";

$arx2calc= array();
$arx2calc["g1"]= array("all", "mins", "*0.3", "макс.30% от МРЗ", false);
$arx2calc["g2"]= array("all", "mins", "*0.4", "макс.40% от МРЗ", false);
$arx2calc["g3"]= array("all", "mins", "*0.5", "макс.50% от МРЗ", false);
$arx2calc["g4"]= array("all", "mins", "*0.7", "макс.70% от МРЗ", false);
$arx2calc["g5"]= array("all", "mins", "*0.8", "макс.80% от МРЗ", false);
$arx2calc["g6"]= array("all", "mins", "*0.9", "макс.90% от МРЗ", false);
$arx2calc["10pc"]= array("prop", "debt", "/10", "макс.1/10 от задълж", true);
$arx2calc["g8"]= array("prop", "debt", "/15", "макс.1/15 от задълж", true);
$arx2calc["inve"]= array("inve", "t26", "/2", "макс.1/2 от т.26", false);

$arx2list= array();
$arx2list[1]= array("inve","g1","10pc");
$arx2list[2]= array("inve","g2","10pc");
$arx2list[3]= array("inve","g3","10pc");
$arx2list[4]= array("inve","g4","10pc");
$arx2list[5]= array("inve","g5","10pc");
$arx2list[6]= array("inve","g6","10pc");
$arx2list[7]= array("inve",     "10pc");
$arx2list[8]= array("inve","g8"       );

$arx2scen= array("inve","prop","all","t26");

$taname= "subject";
$tpname= "cazo2view.tpl";
 
$modiname= "cazo2modi.ajax.php";
$diemess= "cazo2";

$delrec= $GETPARAM["delrec"];
if (isset($delrec)){
    include_once "cazo2dele.ajax.php";
    exit;
}

$modeel= "edit=$edit&zone=$zone&func=modi";
$addnew= geturl($modeel."&idel=0");

$filter= "where idcase=$edit";

$mylist= $DB->select("select * from $taname $filter order by id");
$mylist= dbconv($mylist);
									
$arperc= getpercent();

$currdate= date("Y-m-d");

$capireca= 0;
$intereca= 0;
$taxareca= 0;
											
foreach ($mylist as $uskey=>$uscont){
    $idcurr= $uscont["id"];

	$mylist[$uskey]["edit"]= geturl($modeel."&idel=".$idcurr);
    //$mylist[$uskey]["edit2"]= geturl($modeel."&idel=".$idcurr."&spec=1");
	$mylist[$uskey]["delrec"]= geturl($modeel."&delrec=".$idcurr);
    $mylist[$uskey]["paym"]= geturl("&subj=".$idcurr);

    if (empty($uscont["listdebtor"])){
        $mylist[$uskey]["listde"]= "";
        $mylist[$uskey]["counde"]= 0;
    }else{
        $mylist[$uskey]["listde"]= explode(",",$uscont["listdebtor"]);
        $mylist[$uskey]["counde"]= count($mylist[$uskey]["listde"]);
    }

    // cazo2.inc.php START
    //------------------------------------------------------

    $idtype= $uscont["idtype"];

    $emptyfromdate= empty($uscont["fromdate"]);
    $type1_olih= ($idtype==1 and !$emptyfromdate);
    $type1_neolih= ($idtype==1 and $emptyfromdate);

    if ($type1_olih or $idtype==3){
        $xxsubj= $subj;
        $xxmylist= $mylist;
        $xxismonthly= $ismonthly;
        $xxrosubj= $rosubj;

        $subj= $idcurr;
 
        $mylist= array();

        $ismonthly= ($idtype==3 or $idtype==5);
        $rosubj= $uscont;

        // subjpaymhist.php START
        //-----------------------------------------------

        $ismonthly= ($rosubj["idtype"]==3 or $rosubj["idtype"]==5);

        $prinyes= $GETPARAM["print"];
        $flprin= ($prinyes=="yes");

        $arwork= array();

        $begdate= $rosubj["fromdate"];
        if ($ismonthly){
            $fisuma= sumreduce($rosubj["amount"],$begdate,"toend");
            $arwork[$begdate][2]= array($fisuma, 0);
        }else{
            $arwork[$begdate][0]= array($rosubj["amount"], 0);
        }

        $enddate= date("Y-m-d");

		$arwork[$enddate][1]= NULL;

        foreach($mylist as $pael){
				$arwork[$pael["date"]][1]= NULL;
				$arwork[$pael["date"]][3]= array( - $pael["tocapi"], - $pael["tointe"]);
        }

        if ($ismonthly){
            list($begye,$begmo,$begda)= explode("-",$begdate);
            list($endye,$endmo,$endda)= explode("-",$enddate);

            $todate= $rosubj["todate"];

            if (!empty($todate)){
                $enddate= $todate;
                list($endye,$endmo,$endda)= explode("-",$todate);
            }

			$currye= $begye;
			$currmo= $begmo;

	        while (true){
			    $currmo ++;
			    if (!($currmo<=12)){
                    $currmo= 1;
                    $currye ++;
                }

                $currmo= str_pad($currmo,2,"0",STR_PAD_LEFT);
                $currye= str_pad($currye,2,"0",STR_PAD_LEFT);

		        $currdate= "$currye-$currmo-01";

		        if ($currdate <= $enddate){
				    $arwork[$currdate][1]= NULL;
				    $arwork[$currdate][2]= array($rosubj["amount"], 0);

                    if ($currmo==$endmo and $currye==$endye){
                        $ensuma= sumreduce($rosubj["amount"],"$endye-$endmo-$endda","frombegin");
				        $arwork[$currdate][2]= array($ensuma, 0);
                    }
                }else{
                    break;
                }
	        }

            $fstamp= mktime(0,0,0,  $mo+1,1,$ye);
            $firstnext= date("Y-m-d",$fstamp);
        }

        ksort($arwork);
        
        foreach($arwork as $arindx=>$arelem){
            ksort($arelem);

            $newelem= array();
            $previn= -9;
            foreach($arelem as $in2=>$el2){
                if (!($in2==$previn)){
                    $newelem[$in2]= $el2;
                    $previn= $in2;
                }
            }

            $arwork[$arindx]= $newelem;
        }

        $arhist= array();

        $lastdate= "";
        $lastcapi= 0;
        $lastinte= 0;

        foreach($arwork as $cudate=>$dateelem){
            foreach($dateelem as $cutype=>$elem2){
                $resuelem= addhistelem ($cudate, $cutype, $elem2[0], $elem2[1]);
            }
        }

        $totalamo= $lastcapi + $lastinte;

		$baseurl= "subj=".$subj;
        $curint= geturl($baseurl."&print=yes");

        //-----------------------------------------------
        // subjpaymhist.php END

        $subj= $xxsubj;
        $mylist= $xxmylist;
        $ismonthly= $xxismonthly;
        $rosubj= $xxrosubj;

        $capireca += $lastcapi;
        $intereca += $lastinte;
        if ($uscont["isintax"]==1){
            $taxareca += ($lastcapi + $lastinte);
        }

        $mylist[$uskey]["capital"]= $lastcapi;
        $mylist[$uskey]["interest"]= $lastinte;

    }elseif ($idtype==2 or $idtype==5 or $type1_neolih){
        $lastcapi= $uscont["amount"];
	    $mylist[$uskey]["capital"]= $lastcapi;

        $capireca += $lastcapi;

        if ($uscont["isintax"]==1){
            $taxareca += $lastcapi;
        }
    }

    //------------------------------------------------------
    // cazo2.inc.php END
}

$recasum= $capireca + $intereca;

$calctax= calctax($taxareca);

$recatot= $recasum + $calctax;

$_SESSION["capireca"]= $capireca;
$_SESSION["intereca"]= $intereca;
$_SESSION["calctax"]= $calctax;

$arclai= getselect("claimer","name","idcase=$edit",false);
$arclai= dbconv($arclai);

$ardebt= getselect("debtor","name","idcase=$edit",false);
$ardebt= dbconv($ardebt);
				
// cazo2b.php START
//-------------------------------------------------------

$idel= $GETPARAM["idel"];
$tran2= $GETPARAM["tran2"];
if (!isset($tran2)){
    $idsub2= $DB->selectCell("select id from subject where idcase=?d and idt2=0 order by id"  ,$edit);
    if (empty($idsub2)){
        $_SESSION["iscasetran"]= true;
    }else{
	    $forclink= geturl($modeel."&idel=".$idsub2);
        $_SESSION["iscasetran"]= false;
    }
}
									
if (!($func=="modi")){
    $arx2t26= x2get_t26($edit);
	$x2_t26_inpu= trim($arx2t26["inpu"]);
	$x2_t26_inpu= ($x2_t26_inpu=="") ? $arx2t26["orig"] : $x2_t26_inpu;

    list($arx2para,$arx2parainpu)= x2get_para($mylist,$x2_t26_inpu);

    $arx2inve= x2get_inve($edit);

    $x2grou= x2get_group($arx2para["debt"],$arx2para["mins"]);
	$arx2para["idgrou"]= $x2grou;

    $arx2li= $arx2list[$x2grou];

    if (!isset($arx2li)){
        die("cazo2bgr");
    }

    $arx2p2= array();

    $e1x2= "t26";
    $ar4base= $arx2t26;
    $ar4base["text"]= $arx2text[$e1x2];
    $ar4base["pn"]= $e1x2;
    if ($ar4base["inpu"]==""){
        $ar4base["rese"]= "";
    }else{
        $ar4base["rese"]= round($ar4base["orig"] - $ar4base["inpu"] ,2);
    }

    $arx2p2[$e1x2]= array($ar4base);

    foreach($arx2li as $codepara){
        $e1x2= $arx2calc[$codepara][0];
        $e2x2= $arx2calc[$codepara][3];

        $cop2= $arx2calc[$codepara][1];
        $form= $arx2calc[$codepara][2];

        $isvatt= $arx2calc[$codepara][4];

        $c2para= $arx2para[$cop2];
        $c2inpu= trim($arx2parainpu[$cop2]);
        $contp2= ($c2inpu=="") ? $c2para : $c2inpu;

        $form2= $contp2.$form;
        if ($isvatt){
            $form2= $x2_vat_coef."*".$form2;
        }

        $form2 = str_replace('/', '', $form2);
        eval("\$contlimi= ($form2);");
        $contlimi= round($contlimi,2);

        if ($e1x2=="inve"){
		    foreach($arx2inve as $id2=>$co2){
                $ar4base= $co2;
                $ar4base["text"]= $arx2text[$e1x2];
                $ar4base["form"]= $form;
                $ar4base["formargu"]= $contp2;
                $ar4base["limitext"]= $e2x2;
                $ar4base["limi"]= $contlimi;
                $ar4base["isvatt"]= $isvatt;
                $ar4base["pn"]= $e1x2;
                $minirese= min($ar4base["orig"],$ar4base["limi"]);

                if ($ar4base["inpu"]==""){
			        $ar4base["rese"]= round($minirese ,2);
                }else{
			        $ar4base["rese"]= round($minirese-$ar4base["inpu"] ,2);
                }

                $arx2p2["inve"][]= $ar4base;
		    }
	    }else{
            $ar4base= array();
            $ar4base["orig"]= $arx2para[$e1x2];
		    if ($e1x2=="prop" or $e1x2=="all"){
                $ar4base["inpu"]= $arx2parainpu[$e1x2];
		    }

            $ar4base["text"]= $arx2text[$e1x2];
			$ar4base["form"]= $form;
			$ar4base["formargu"]= $contp2;
            $ar4base["limitext"]= $e2x2;
            $ar4base["limi"]= $contlimi;

            $ar4base["isvatt"]= $isvatt;
            $ar4base["pn"]= $e1x2;
            $arx2p2[$e1x2]= array($ar4base);
        }
    }

    $arx2visu= array();
    foreach($arx2scen as $codepara){
        if(isset($arx2p2[$codepara])){
                $arx2visu[$codepara]= $arx2p2[$codepara];
        }
    }

    foreach($arx2visu as $codepara=>$arx2){
	    foreach($arx2 as $indx=>$elem){
		    $codex2= $elem["code"];
            if (isset($codex2)){
                $codex2 .= ("/".$elem["orig"]);
                $arx2visu[$codepara][$indx]["code"]= $codex2;
                $arx2visu[$codepara][$indx]["linkinpu"]= geturl($modeel."&linkinpu=$codex2");
            }

		    $limix2= $elem["limi"];
            if (isset($limix2)){
                $inputran= ($elem["inpu"]=="") ? $elem["orig"] : $elem["inpu"];
                $arx2visu[$codepara][$indx]["okflag"]= ($inputran<=$limix2);
            }
	    }
    }

    $arw2= array();
    $ar2x2prop= $arx2visu["prop"][0];

    if (isset($ar2x2prop)){
        $min2p= $ar2x2prop["limi"] - $ar2x2prop["inpu"];
        $arw2[]= $min2p;
    }

    $ar2x2all= $arx2visu["all"][0];

    if (isset($ar2x2all)){
        $min2a= $ar2x2all["limi"] - $ar2x2all["inpu"];
        $arw2[]= $min2a;
    }

    $ar2x2t26= $arx2visu["t26"][0];
    $x4_orig= $ar2x2t26["orig"];
    $x4_inpu= trim($ar2x2t26["inpu"]);
    $x4_cont= ($x4_inpu==="" ? $x4_orig : $x4_inpu);
    $min2t= $x4_orig - $x4_cont +0;
    $arw2[]= $min2t;

    $arw2[]= 999999999;
    $arw2[]= 999999999;

    $x4_t26_rese= min($arw2);
    $arx2visu["t26"][0]["rese2"]= $x4_t26_rese;
    $x4_t26_setto= $x4_cont + $x4_t26_rese;
    $x4_t26_setto= round($x4_t26_setto,2);
    $arx2visu["t26"][0]["setto"]= $x4_t26_setto;
}

//-------------------------------------------------------
// cazo2b.php END



