<?php
//cazo2a.php START
//-------------------------------------------------------
function x2get_para($ardata,$x2_t26_inpu){
    global $calctax;
    $arx2para= array();
    $arx2para["t26"]= $calctax;
    $arx2para["mins"]= $_SESSION["minsal"];
    $arx2parainpu= array();
    $arx2parainpu["t26"]= $x2_t26_inpu;

	foreach($ardata as $elem){
		$idt2= $elem["idt2"];
		$capi= $elem["capital"];
		$ires= $elem["interest"];
        $amo2= trim($elem["amo2"]);
        $amo33= $amo2;
        $amo2= ($amo2=="") ? $capi : $amo2;

		if($idt2==4){
            $arx2para["debt"] += ($capi+$ires+0);
		}elseif($idt2==12){
            $arx2para["prop"] += $capi;
            $arx2para["all"] += $capi;
            $arx2parainpu["prop"] += $amo2;
            $arx2parainpu["all"] += $amo2;
		}elseif($idt2==16){
            $arx2para["prop"] += $capi;
            $arx2para["all"] += $capi;
            $arx2parainpu["prop"] += $amo2;
            $arx2parainpu["all"] += $amo2;
		}elseif($idt2==20){
            $arx2para["all"] += $capi;
            $arx2parainpu["all"] += $amo2;
		}
	}

	$arx2para["prop"] += $arx2para["t26"];
	$arx2para["all"] += $arx2para["t26"];
    $arx2parainpu["prop"] += $arx2parainpu["t26"];
    $arx2parainpu["all"] += $arx2parainpu["t26"];

	$arx2para["debt"]= round($arx2para["debt"],2);
	$arx2para["prop"]= round($arx2para["prop"],2);
	$arx2para["all"]= round($arx2para["all"],2);
    $arx2parainpu["prop"]= round($arx2parainpu["prop"],2);
    $arx2parainpu["all"]= round($arx2parainpu["all"],2);

    return array($arx2para,$arx2parainpu);
}

function x2get_inve($idcase){
    global $DB, $su2inve;
	$arin= $DB->select("select amount as orig, amo2 as inpu, concat('subject/',id,'/amo2') as code from subject where idcase=?d and idt2=?d"  ,$idcase,$su2inve);
    return $arin;
}

function x2get_t26($idcase){
    global $calctax;
	$rocase= getrow("suit",$idcase);
	$cont26= $rocase["t26"];
	$ar26= array("orig"=>$calctax,"inpu"=>$cont26, "code"=>"suit/$idcase/t26");
    return $ar26;
}

function x2get_group($debt,$minsal){
    global $arx2gr;

	if (empty($minsal)){
        die("error-minsal");
	}
			
    $idgr= 0;
	foreach($arx2gr as $i2=>$coef2){
		$uplimi= round($minsal*$coef2,2);
		if ($debt<=$uplimi){
			$idgr= $i2;
			break;
		}
	}

	if ($idgr==0){
        $idgr= count($arx2gr)+1;
	}

    return $idgr;
}


// function x2get_select(){
//     global $arsu2type;
//     $ar1= array();
//     $ar2= array();
//     $cucode= "";

// 	foreach($arsu2type as $code=>$text){
// 		if (is_int($code)){
// 			$ar2[$cucode][$code]= $text;
// 		}else{
// 			$ar1[$code]= $text;
// 			$cucode= $code;
// 		}
// 	}
    
//     $arresu= array();
// 	foreach($ar1 as $code=>$text){
//         $arresu[$text]= $ar2[$code];
// 	}

//     return toutf8($arresu);
// }

// function x2get_notype(){
//     global $DB;
// 	$arcounnotype= $DB->selectCol("
// 		select count(*), idgr as ARRAY_KEY 
// 		from txactigrelem 
// 		where idtype=3 and idt2=0
// 		group by idgr
//     ");

//     return $arcounnotype;
// }
//-------------------------------------------------------
//cazo2a.php END

//subjpaymhist.inc.php START
//-------------------------------------------
function calcinte($d1,$d2,$capi,$fltran=true){
    global $arperc;
    if (count($arperc)==0){
        $arperc= getpercent();
    }

    $begsta= $arperc[1]["begstamp"];

    if (empty($d1)){
        $d1= date("Y-m-d",$begsta);
    }else{
        list($ye,$mo,$da)= explode("-",$d1);
        $d1sta= mktime(0,0,1,  $mo,$da,$ye);
        if ($d1sta<$begsta){
            $d1= date("Y-m-d",$begsta);
        }
    }

	$secday= 86400;
	$counperc= count($arperc);

    if ($fltran){
        list($ye,$mo,$da)= explode("-",$d2);
        $d2stamp= mktime(0,0,0,  $mo,$da-1,$ye);
        $d2= date("Y-m-d",$d2stamp);
    }
	
    $arresu= array();
	$arresu["descrip"]= array($d1,$d2,$capi);

    $cuperiod= array();
	
	list($ye,$mo,$da)= explode("-",$d1);
	$d1stamp= mktime(0,0,0,  $mo,$da,$ye);
	$peindx= getperiindx($d1);

	$stamp1= max($d1stamp,$arperc[$peindx]["begstamp"]);

    $totalinte= 0;

	list($ye,$mo,$da)= explode("-",$d2);
	$d2stamp= mktime(0,0,0,  $mo,$da,$ye);
    $found= false;
    $indx2= $peindx;

    $mycoun= 0;
	while (true){
        $mycoun++;

        if ($mycoun>4000){
            die("stage=2=[$indx2]");
        }

		$peelem= $arperc[$indx2];

        if (!($indx2==$peindx)){
            $stamp1= $peelem["begstamp"];
        }

        $lastperi= false;
        if ($indx2 == $counperc-1){
            $lastperi= true;
        }else{
            $indx2next= $indx2 +1;
            $d2next= $arperc[$indx2next]["begstamp"];
            $d2endstamp= $d2next - $secday;
            if (!($d2stamp >= $d2next)){
                $lastperi= true;
            }
        }

		if ($lastperi){
            $stamp2= $d2stamp;
			$cuperiod= formdata($stamp1, $stamp2, $secday, $indx2, $capi);
            
            if (is_string($cuperiod)){
                return $cuperiod;
            }

            $totalinte += $cuperiod["result"];

			$arresu["list"][]= $cuperiod;
            $found= true;
            break;
		}else{
            $stamp2= $d2endstamp;
			$cuperiod= formdata($stamp1, $stamp2, $secday, $indx2, $capi);

            if (is_string($cuperiod)){
                return $cuperiod;
            }

            $totalinte += $cuperiod["result"];
			$arresu["list"][]= $cuperiod;

            $indx2++;
			
            if (!($indx2 <= $counperc-1)){
                break;
            }
		}
	}
    
    if (!$found){
        die("calcinte=3=[$d2]");
    }

	$arresu["newinte"]= $totalinte;
    return $arresu;
}

function formdata ($stamp1, $stamp2, $secday, $indx2, $capi){
    global $arperc;
    if (count($arperc)==0){
        $arperc= getpercent();
    }

    global $percname;
    if (empty($percname)){
        $percname= "bnb";
    }

    $difstamp= $stamp2 - $stamp1 + $secday;

    if ($difstamp<0){
        $myda1= date("Y-m-d",$stamp1);
        $myda2= date("Y-m-d",$stamp2);

        die("formdata=2=[$myda1][$myda2][$difstamp]");
    }

    $daycou= round( ($difstamp / $secday) ,0);
    $cuperiod["stamp1"]= $stamp1;
    $cuperiod["stamp2"]= $stamp2;
    $cuperiod["d1"]= date("d.m.Y",$stamp1);
    $cuperiod["d2"]= date("d.m.Y",$stamp2);
    $cuperiod["days"]  = $daycou;

    $percvalu= $arperc[$indx2][$percname];
    $percvalu= $percvalu +0;

    if ($percvalu==0 and $indx2<>0){
        $workindx= $indx2;
        $datevalu= $arperc[$workindx]["begin"];
        $mycoun= 0;

	    while (true){
            $mycoun++;

            if ($mycoun>4000){
                die("formdata=percvalu=[$workindx][$indx2]");
            }

			$workindx --;
		    $percvalu= $arperc[$workindx][$percname];
		    $percvalu= $percvalu +0;
					
            if ($workindx==0){
                return "няма лихви преди ".$datevalu;
            }

            if (!($percvalu==0)){
                break;
            }
	    }
    }

    $cuperiod["bnb"]= $percvalu;

    $extraint= $_SESSION["extraint"] +0;
    if ($extraint==0){
        die("extra=int=perc");
    }

    $zakono= $cuperiod["bnb"] + $extraint;

    $dnevna= $zakono / 360;
    $dnevna= round($dnevna,6);

    $result= $capi * $dnevna * 0.01 * $daycou;
    $result= round($result,2);

    $cuperiod["zakono"] = $zakono;
    $cuperiod["dnevna"] = $dnevna;
    $cuperiod["result"] = $result;

    return $cuperiod;
}

function addhistelem ($date, $type, $tocapi, $tointe){
    global $arhist;
    global $lastdate, $lastcapi, $lastinte;

	if ($type==0){
        $arelem= array();
        $arelem["date"]= $date;
        $arelem["text"]= "начало";
        $arelem["capi"]= $tocapi;
        $arelem["inte"]= $tointe;
	}elseif ($type==1){
        $arelem= array();
        $arelem["date"]= $date;
        $arelem["text"]= "олихвяване";
        $arelem["flag"]= "a";
        $arelem["open"]= "yes";

        $arinte= calcinte($lastdate, $arelem["date"], $lastcapi);
        $newinte= $arinte["newinte"];
        $arelem["listperi"]= $arinte;
        $arelem["capi"]= 0;
        $arelem["inte"]= $newinte;
	}elseif ($type==2){
        $arelem= array();
        $arelem["date"]= $date;
        $arelem["text"]= "мес.вноска";
        $arelem["capi"]= $tocapi;
        $arelem["inte"]= $tointe;
        $arelem["flag"]= "c";
	}elseif ($type==3){
        $arelem= array();
        $arelem["date"]= $date;
        $arelem["text"]= "погасяване";
        $arelem["capi"]= $tocapi;
        $arelem["inte"]= $tointe;
        $arelem["flag"]= "b";
	}else{
        die("addhist=type=$type");
	}

    $arelem["resucapi"]= $lastcapi + $arelem["capi"];
    $arelem["resuinte"]= $lastinte + $arelem["inte"];

    $arhist[]= $arelem;
    
    $lastdate= $arelem["date"];
    $lastcapi= $arelem["resucapi"];
    $lastinte= $arelem["resuinte"];

    return $arelem;
}

function getperiindx($date){
    global $arperc;

    if (count($arperc)==0){
        $arperc= getpercent();
    }

	list($ye,$mo,$da)= explode("-",$date);
	$stamp= mktime(0,0,0,  $mo,$da,$ye);
    $peindx= 0;
    $pelast= count($arperc) -1;

    $mycoun= 0;
	while (true){
        $mycoun++;
        if ($mycoun>4000){
            die("getperi=3=[$date]");
        }

		$peelem= $arperc[$peindx];

		if ($stamp >= $peelem["begstamp"]){
            if ($peindx < $pelast){
                $peindx ++;
            }elseif ($peindx == $pelast){
                break;
            }else{
                die("getperi=1=[$date]");
            }
		}else{
            if ($peindx <= 0){
                die("getperi=2=[$date]");
            }else{
                $peindx --;
                break;
            }
		}
	}

    return $peindx;
}
//-------------------------------------------
//subjpaymhist.inc.php START