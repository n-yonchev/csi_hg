<?php

# $dbconst= mysql://[username]:[password]@[host]/[dbname] 

#------ full DB ------
function getdbconst(){
    $htho= $_SERVER["HTTP_HOST"];
# local test XAMPP 
    if ($htho=="lh" or $htho=="localhost" or $htho=="neno" or $htho=="192.168.2.105"){
        $dbconst= 'mysql://root:@localhost/exof';
# office test server 
    }elseif ($htho=="192.168.2.10"){
        $dbconst= 'mysql://root:bestregards@localhost/exof';
# real server 
//					}elseif ($htho=="csi.softhouse.bg"){
//						$dbconst= 'mysql://csi:Cs1_S0twH@localhost/softhouse_csi';
    }else{
        $dbconst= 'mysql://root:jzSHxGa912bna4HSAV@localhost/exof';
//die("uNKNOWN-SERVER=$htho");
    }
$dbconst= 'mysql://root:bgzNS$t3ZDkxr77Y@localhost/exof';
return $dbconst;
}

#------ extract DB ------
function getdbconst2(){
    $htho= $_SERVER["HTTP_HOST"];
# local test XAMPP 
    if ($htho=="lh" or $htho=="localhost" or $htho=="neno" or $htho=="192.168.2.105"){
        $dbconst= 'mysql://root:@localhost/exof2';
# office test server 
    }elseif ($htho=="192.168.2.10"){
        $dbconst= 'mysql://root:bestregards@localhost/exof_mitko';
# real server 
//					}elseif ($htho=="csi.softhouse.bg"){
//						$dbconst= 'mysql://csi:Cs1_S0twH@localhost/softhouse_csi';
    }else{
        $dbconst= 'mysql://root:jzSHxGa912bna4HSAV@localhost/exof';
//die("UNKNOWN-SERVER2=$htho");
    }
$dbconst= 'mysql://executor:8kFdbFPgJ7fugVrWW5Hk@localhost/exof';
return $dbconst;
}

require_once $dkpref."dklab/dbsimple/Generic.php";
							$dbconst= getdbconst();
$DB = DbSimple_Generic::connect($dbconst);
							$DB->query("SET NAMES 'utf8'");                            

$DB->setErrorHandler('databaseErrorHandler');
function databaseErrorHandler($message, $info){
	if (!error_reporting()) return;
	echo "SQL Error: $message<br><pre>"; 
	print_r($info);
	echo "</pre>";
	exit();
}

# extract DB 
							$dbconst2= getdbconst2();
$DB2 = DbSimple_Generic::connect($dbconst2);
							$DB2->query("SET NAMES 'utf8'");
$DB2->setErrorHandler('databaseErrorHandler');

function todb2($tablname,$filt="", $grp = "") { 
    global $DB, $DB2;
        $filt= ($filt=="") ? "" : "where $filt";
        $grp= ($grp=="") ? "" : "group by $grp";
        $mylist= $DB->select("select * from $tablname $filt $grp");
        $mylist= arstrip($mylist);
    //	$DB2->query("truncate table $tablname");
    //	arr2tab($mylist,$tablname);
    return $mylist;
}

function arstrip($value){
	$value = is_array($value) ?	array_map('arstrip', $value) : stripslashes($value);
return $value;
}


$mylist= todb2("viewersuit", "", "idcase");
var_dump($mylist);
echo 'test actual dept';