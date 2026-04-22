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
 $dbconst= 'mysql://root:bgzNS$t3ZDkxr77Y@localhost/exof';
return $dbconst;
}


?>
