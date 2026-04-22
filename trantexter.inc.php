<?php

							if ($ispostbank){
		$txslen= 70;
								$text= $_POST["text"];
//		$slen= mb_strlen($text,"UTF-8");
//var_dump($slen);
		$slen= strlen(tran1251($text));
//var_dump($slen);
								if ($slen<=$txslen){
								//if (flagtextlen($text,$txslen)){
								}else{
											$lister["text"]= "съдържа $slen вместо макс.$txslen символа";
								}
							}else{
		$txslen= 35;
								$text1= $_POST["text1"];
//		$slen= mb_strlen($text1,"UTF-8");
		$slen= strlen(tran1251($text1));
								if ($slen<=$txslen){
								//if (flagtextlen($text1,$txslen)){
								}else{
											$lister["text1"]= "съдържа $slen вместо макс.$txslen символа";
								}
								$text2= $_POST["text2"];
//		$slen= mb_strlen($text2,"UTF-8");
		$slen= strlen(tran1251($text2));
								if ($slen<=$txslen){
								//if (flagtextlen($text2,$txslen)){
								}else{
											$lister["text2"]= "съдържа $slen вместо макс.$txslen символа";
								}
							}


?>