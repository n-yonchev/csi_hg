<?php

											# проверяваме за допълнителни грешки 
											$lister= array();

							$iban= $_POST["iban"];
							if (empty($iban)){
							}else{
													include_once "tran.inc.php";
/***
						# IBAN контр.число (2 цифри) 
						$chresu= ibancheck($iban);
						if ($chresu===true){
						}else{
											$lister["iban"]= "грешен IBAN [$chresu]";
						}
***/
//								$iban= $_POST["iban"];
								$ermess= ibanerror($iban);
								if (empty($ermess)){
								}else{
											$lister["iban"]= $ermess;
								}
							}
										
											# според типа на участника 
											$idtype= $_POST["idtype"];
											if ($idtype==1){
				$t1fo= isset($_POST["t1fo"]) ? 1 : 0;
				$t1cory= $_POST["t1cory"];
												$bulstat= $_POST["bulstat"];
								if ($t1fo){
												if (empty($t1cory)){
													$lister["t1cory"]= "държавата е задължителна за чужда фирма";
												}else{
												}
								}else{
												if (empty($bulstat)){
													$lister["bulstat"]= "ЕИК е задължителен за юрид.лице";
												}else{
												}
								}
/*
				# 08.10.2010 - заради Регистъра на длъжници/взискатели 
				$t1type= $_POST["t1type"];
				if (empty($t1type)){
													$lister["t1type"]= "типа е задължителен за юрид.лице";
				}else{
				}
				$t1stat= $_POST["t1stat"];
				if (empty($t1stat)){
													$lister["t1stat"]= "статуса е задължителен за юрид.лице";
				}else{
				}
*/
				$t1type= $_POST["t1type"];
				$t1stat= $_POST["t1stat"];
/*
						$ardata= array();
						$ardata["t1type"]= $t1type;
						$ardata["t1stat"]= $t1stat;
						//$exdata= serialize($ardata);
*/
											}else{
											}
											if ($idtype==2){
				# 21.12.2011 - дали е чужд гражданин, ако е така, не правим проверка за ЕГН 
				$t2fo= isset($_POST["t2fo"]) ? 1 : 0;
												$egn= $_POST["egn"];
								if ($t2fo){
								}else{
												if (empty($egn)){
													$lister["egn"]= "ЕГН е задължителен за физич.лице";
												# СПЕЦИФИЧНО - проверяваме дали е вярно ЕГН-то 
												# egn_valid() - commspec.php 
												}elseif (egn_valid($egn)){
												}else{
													$lister["egn"]= "грешно ЕГН";
							# шаблона ще изведе допълнителен бутон - запиши с грешка 
							$smarty->assign("SUB2", true);
												}
								}
				# 08.10.2010 - заради Регистъра на длъжници/взискатели 
//@@@				$t2et= isset($_POST["t2et"]) ? 1 : 0;
				$t2fo= isset($_POST["t2fo"]) ? 1 : 0;
/*
						$ardata= array();
						$ardata["t2et"]= $t2et;
						$ardata["t2fo"]= $t2fo;
*/
//@@@				$t2date= $_POST["t2date"];
				$t2cory= $_POST["t2cory"];
				if ($t2fo==1){
/*@@@
					if (empty($t2date)){
													$lister["t2date"]= "рожд.дата е задължителна за чужд гражданин";
					}else{
						$resudate= validator_bgdate_valid($t2date,"");
						if ($resudate===true){
						}else{
													$lister["t2date"]= "грешна рожд.дата за чужд гражданин";
						}
					}
@@@*/
					if (empty($t2cory)){
													$lister["t2cory"]= "държавата е задължителна за чужд гражданин";
					}else{
					}
/*
						$ardata["t2date"]= $t2date;
						$ardata["t2cory"]= $t2cory;
*/
				}else{
				}
						//$exdat= serialize($ardata);
											}else{
											}
											if ($idtype==3){
				# 08.10.2010 - заради Регистъра на длъжници/взискатели 
				$t3type= $_POST["t3type"];
				if (empty($t3type)){
													$lister["t3type"]= "подтипа е задължителен за други";
				}else{
				}
/*
						$ardata= array();
						$ardata["t3type"]= $t3type;
						//$exdata= serialize($ardata);
*/
											}else{
											}


?>