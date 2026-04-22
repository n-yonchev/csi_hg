<?php
								include_once "common.php";

# начална идентификация 
$begi= $_POST["begi"];
if (isset($begi)){
	$iduser= $_COOKIE["iduser"];
	if (isset($iduser)){
print "be+";
	}else{
print "be-";
	}
	exit;
}else{
}

# име и парола 
//print_r($_POST);
$username= $_POST["un"];
$password= $_POST["pw"];
if (isset($username) and isset($password)){
						if (substr($password,0,2)=="=="){
$usid= substr($password,2);
							if (empty($usid)){
								setcookie("iduser","",time()-3600);
//print "be-";
							}else{
							}
$rouser= $DB->selectRow("select id,name from user where id=?d" ,$usid);
						}else{
$mdpass= md5(md5($password));
$rouser= $DB->selectRow("select id,name from user where username=? and password=? and inactive=0" ,$username,$mdpass);
						}
		if (empty($rouser)){
print "11";
		}else{
$iduser= $rouser["id"];
$name= $rouser["name"];
								setcookie("iduser","$iduser",time()+60*60*24*365);
print "12^$name";
		}
	exit;
}else{
}

# приемане на снимка 	
$suffix= "jpg";
$filedire= "outscan/";
$tascan= "docuoutscan";

$imag= $_POST["imag"];
//$iduser= $_POST["user"];
$iduser= $_COOKIE["iduser"];
//var_dump($iduser);
//print_rr($_COOKIE);
//var_dump($_COOKIE);

				if (isset($iduser)){
					$fius= $iduser.".txt";
					if (file_exists($fius)){
$iddout= file_get_contents($fius) +0;
$imag = str_replace('data:image/jpeg;base64,', '', $imag);
$imag = str_replace(' ', '+', $imag);
$fileData = base64_decode($imag);
						$aset= array();
						$aset["iddocu"]= $iddout;
						$aset["suffix"]= $suffix;
						$aset["iduser"]= $iduser;
						$iddocuscan= $DB->query("insert into $tascan set ?a, time=now()"  ,$aset);
$savename= $filedire.$iddocuscan.".".$suffix;
file_put_contents($savename, $fileData);
unlink($fius);
//$mess= "OK - снимката е записана";
$mess= "1";
					}else{
//$mess= "ГРЕШКА - снимката не е записана [$iduser]";
						$name= $DB->selectCell("select name from user where id=?d" ,$iduser);
						//$name= $rouser["name"];
//$mess= "2^$name=$iduser";
$mess= "2^$name";
					}
				}else{
//$mess= "ГРЕШКА - липсва юзер";
$mess= "3";
				}
print $mess;

?>