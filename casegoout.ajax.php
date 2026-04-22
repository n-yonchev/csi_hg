<?php
									session_start();
									include_once "common.php";

				$outall= $_GET["outall"];
				if (isset($outall)){

						# ЗАТВАРЯМЕ ВСИЧКИ ДЕЛА 
//print "OUTALL=YES";
						# отключваме всики в БД 
						foreach($_SESSION["tabs"] as $caid=>$x2){
							$DB->query("update suit set lockedby=0 where id=?" ,$caid);
						}
						# изтриваме целия списък с табовете 
						$_SESSION["tabs"]= array();

				}else{
				
$GEPA= getparam();
//print_r($GEPA);
$goout= $GEPA["goout"];

						# премахваме отделно дело от списъка с табовете 
						unset($_SESSION["tabs"][$goout]);
						# отключваме делото в БД 
						$DB->query("update suit set lockedby=0 where id=?" ,$goout);

				# if (isset($outall)){
				}

print count($_SESSION["tabs"]);

?>
