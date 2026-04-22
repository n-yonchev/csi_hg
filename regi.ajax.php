<?php
									session_start();
									include_once "common.php";

$uniqname= $_GET["uniq"];
$acti= $_GET["acti"];
//print "[$uniq][$acti]";
//print_rr($_GET);
							include_once "caseregi.inc.php";
							include_once "regi.inc.php";

			if ($acti=="yes"){
#---- да се коментира при временен тест ----
/**/
#-----------------------------------------
putcases("id>0","idcase>0");
putpersons("%s.idcase>0");
putorigins("idcase>0");
putzip();
#-----------------------------------------
/**/
	$rooffi= getofficerow(0);
	$serial= $rooffi["serial"];
	$namezi= gettofile("namezip");
											#---- само за временен тест ----
//											$uniqname= "t1";
//											$namezi= "register/t1_zip.zip";
											#-------------------------------
$namezi= "../" .$namezi;

//$p1= popen("start regi.bat ".escapeshellarg("$serial $namezi") ,"r");
//$p1= popen("start regi.bat $serial $namezi $uniqname" ,"r");
$_SESSION["beginregi"]= time();
					$htho= $_SERVER["HTTP_HOST"];
					if ($htho=="lh" or $htho=="localhost"){
$p1= popen("start regi.bat $serial $namezi $uniqname" ,"r");
//print "windows";
pclose($p1);
					}else{

//$p1= popen("/bin/sh regi.sh $serial $namezi $uniqname" ,"r");
//pclose($p1);
//print "linux";
#=================================================================================
$outname= "regicert/STD_OUT.TXT";
$errname= "regicert/STD_ERR.TXT";
$arpipe = array(
//  0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
//	1 => array("file", "regicert/STD_OUT.TXT", "a"),  // stdout is a pipe that the child will write to
	1 => array("file", $outname, "a"),  // stdout is a FILE that the child will write to
	2 => array("file", $errname, "a") // stderr is a file to write to
);
//$cwd = '/tmp';
//$env = array('some_option' => 'aeiou');
$f1= fopen($outname,"a");
fwrite($f1,"----------------".date("d.m.Y H:i:s")." before\n\n");
//++++++++++++++++++$process = proc_open("/bin/sh regi.sh $serial $namezi $uniqname", $arpipe, $pipes);
$process = proc_open("/bin/sh regi.sh $serial $namezi $uniqname > /dev/null &", $arpipe, $pipes);
fwrite($f1,"----------------".date("d.m.Y H:i:s")." AFTER\n\n");
//fclose($f1);
if (is_resource($process)){
				//echo stream_get_contents($pipes[2]);
				//fclose($pipes[2]);
//sleep(2);
fwrite($f1,"----------------".date("d.m.Y H:i:s")." before return\n\n");
	$return_value= proc_close($process);
//	echo "command returned $return_value\n";
fwrite($f1,"----------------".date("d.m.Y H:i:s")." return=$return_value\n\n");
}else{
}
fclose($f1);
$f1= fopen($outname,"a");
fwrite($f1,"----------------".date("d.m.Y H:i:s")."----------------\n\n");
fclose($f1);
#=================================================================================


//$read = fread($p1,2096);
//echo "out=".$read;
//echo exec("whoami");
//echo exec("/bin/sh regi.sh $serial $namezi $uniqname", $output);
//var_dump($output);
/*
$p1= popen("/bin/sh regi.sh $serial $namezi $uniqname" ,"r");
//print "linux";
//echo gettype($p1)."\n";
	sleep(2);
//$read = fread($p1,2096);
//echo $read;
//var_dump($read);
while(!feof($p1)){
	$read = fread($p1,2096);
	echo $read;
}
print "\n------------------\n";
	sleep(5);
while(!feof($p1)){
	$read = fread($p1,2096);
	echo $read;
}
*/
//echo exec("whoami");
//echo php_sapi_name();
//++++++++++++++++++++++++++var_dump(exec("/usr/local/bin/php -h >help3.txt"));
//$p1= popen("php -help" ,"r");
//echo gettype($p1)."\n";
//	sleep(2);
//$read = fread($p1,2096);
//echo $read;
//var_dump($read);
					}

print "wait";
			}else{
				//$fnam= dirname(__FILE__)."/"."regicert/".$uniqname."_debug.txt";
											#---- само за временен тест ----
//											$uniqname= "t1";
											#-------------------------------
				$fnpref= dirname(__FILE__)."/"."regicert/".$uniqname;
				$fidebug= $fnpref ."_debug.txt";
//print $fidebug."^^^";
$tsec= time()-$_SESSION["beginregi"];
				if (file_exists($fidebug)){
$resu= "OK^$tsec";
					foreach($arfina as $code=>$fina){
						$fnam= $fnpref .$fina;
						$resu .= exis($fnam,$code);
					}
print $resu;
				}else{
print "wait^$tsec";
				}
			}

function exis($p1,$p2){
	if (file_exists($p1)){
return "^".$p2;
	}else{
return "";
	}
}

?>