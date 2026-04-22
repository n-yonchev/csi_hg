<?php

		$txslen= 35;
								$clainame= $_POST["clainame"];
//		$slen= mb_strlen($text,"UTF-8");
//var_dump($slen);
		$slen= strlen(tran1251($clainame));
//var_dump($slen);
								if ($slen<=$txslen){
								//if (flagtextlen($text,$txslen)){
								}else{
											$lister["clainame"]= "съдържа $slen вместо макс.$txslen символа";
								}


?>