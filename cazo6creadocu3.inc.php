<?php
# специално за Бургас 


# 27.05.2009 - Бургас - всичко за взискателя/длъжника според типа юрид/физич лице 
# шаблони за типовете : 1=юрид 2=физич 
# 26.01.2010 - Бургас - добавен и представителя [agent] 
	$temp1= "
<p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>%s, рег. по ф.д. № %s/%s г. по описа на %s</b><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> ЕИК %s</b><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> адрес на управление: %s</b><br />
".$temp1_end="
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> представител: %s</b><br />
	";
	$temp1_agent= "
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> представлявана от: %s</b>
</p>
	";
	$temp2= "
<p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>%s ЕГН %s</b><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;с постоянен адрес: %s, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;настоящ адрес : %s, <br />
	";
	$temp2_agent= "
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> представляван от: %s
</p>
	";

# 14.09.2009 - Бургас - всичко за взискателя/длъжника според типа юрид/физич лице 
# но всичко на един ред без разделители 
# шаблони за типовете : 1=юрид 2=физич 
	$temp1one= "
%s, рег. по ф.д. № %s/%s г. по описа на %s
ЕИК %s
адрес на управление: %s
".$temp1one_end="
представител: %s
	";
	$temp1one_agent= "
представлявана от: %s
	";
	$temp2one= "
%s ЕГН %s
с постоянен адрес: %s,
настоящ адрес : %s
	";
	$temp2one_agent= "
представляван от: %s
	";

# 09.07.2010 - клонинг за Дичев, но само с 1 адрес, а не с 2 
#------------------------------------------------------------------
# 14.09.2009 - Бургас - всичко за взискателя/длъжника според типа юрид/физич лице 
	$data_temp1one= "
%s, рег. по ф.д. № %s/%s г. по описа на %s
ЕИК %s
адрес на управление: %s
".$data_temp1one_end="
представител: %s
	";
	$data_temp1one_agent= "
представлявана от: %s
	";
	$data_temp2one= "
%s ЕГН %s
с адрес: %s,
	";
	$data_temp2one_agent= "
представляван от: %s
	";


# 27.05.2009 - Бургас - всичко за длъжника според типа юр/физ лице 
# 26.01.2010 - Бургас - добавен и представителя [agent] 
function debt99(){
global $rodebt, $temp1, $temp2;
global $temp1_agent, $temp2_agent, $temp1one_agent, $temp2one_agent;
		$typedebt= $rodebt["idtype"];
		if (0){
		}elseif ($typedebt==1){
										# 28.07.2010 КРЪПКА Дичев Пламен 
										$t1= c6patch($rodebt["regipers"],"temp1","temp1_end");
//			$resu= sprintf($temp1, $rodebt["name"],$rodebt["regidocu"],$rodebt["regidate"],$rodebt["regicase"]
			$resu= sprintf($t1, $rodebt["name"],$rodebt["regidocu"],$rodebt["regidate"],$rodebt["regicase"]
			,$rodebt["bulstat"],$rodebt["address"],$rodebt["regipers"]);
					if (empty($rodebt["agent"])){
					}else{
			$resu .= sprintf($temp1_agent, $rodebt["agent"]);
					}
return $resu;
		}elseif ($typedebt==2){
			$resu= sprintf($temp2, $rodebt["name"],$rodebt["egn"],$rodebt["address"],$rodebt["address"]);
//			,$rodebt["agent"]);
					if (empty($rodebt["agent"])){
					}else{
			$resu .= sprintf($temp2_agent, $rodebt["agent"]);
					}
# 19.01.2011 - за чужденец 
egndele($resu,$rodebt);
return $resu;
		}else{
return "????????";
		}
}

function clai99(){
global $roclai, $temp1, $temp2;
global $temp1_agent, $temp2_agent, $temp1one_agent, $temp2one_agent;
		$typeclai= $roclai["idtype"];
		if (0){
		}elseif ($typeclai==1){
										# 28.07.2010 КРЪПКА Дичев Пламен 
										$t1= c6patch($roclai["regipers"],"temp1","temp1_end");
//			$resu= sprintf($temp1, $roclai["name"],$roclai["regidocu"],$roclai["regidate"],$roclai["regicase"]
			$resu= sprintf($t1, $roclai["name"],$roclai["regidocu"],$roclai["regidate"],$roclai["regicase"]
			,$roclai["bulstat"],$roclai["address"],$roclai["regipers"]);
//			,$roclai["agent"]);
					if (empty($roclai["agent"])){
					}else{
			$resu .= sprintf($temp1_agent, $roclai["agent"]);
					}
return $resu;
		}elseif ($typeclai==2){
			$resu= sprintf($temp2, $roclai["name"],$roclai["egn"],$roclai["address"],$roclai["address"]);
//			,$roclai["agent"]);
					if (empty($roclai["agent"])){
					}else{
			$resu .= sprintf($temp2_agent, $roclai["agent"]);
					}
# 19.01.2011 - за чужденец 
egndele($resu,$roclai);
return $resu;
		}else{
return "????????";
		}
}

# 14.09.2009 - Бургас - всичко за длъжника според типа юр/физ лице 
# но с шаблоните за един ред 
# 26.01.2010 - Бургас - добавен и представителя [agent] 
function debt99one(){
global $rodebt, $temp1one, $temp2one;
global $temp1_agent, $temp2_agent, $temp1one_agent, $temp2one_agent;
		$typedebt= $rodebt["idtype"];
		if (0){
		}elseif ($typedebt==1){
										# 28.07.2010 КРЪПКА Дичев Пламен 
										$t1= c6patch($rodebt["regipers"],"temp1one","temp1one_end");
//			$resu= sprintf($temp1one, $rodebt["name"],$rodebt["regidocu"],$rodebt["regidate"],$rodebt["regicase"]
			$resu= sprintf($t1, $rodebt["name"],$rodebt["regidocu"],$rodebt["regidate"],$rodebt["regicase"]
			,$rodebt["bulstat"],$rodebt["address"],$rodebt["regipers"]);
//			,$rodebt["agent"]);
					if (empty($rodebt["agent"])){
					}else{
			$resu .= sprintf($temp1one_agent, $rodebt["agent"]);
					}
return $resu;
		}elseif ($typedebt==2){
			$resu= sprintf($temp2one, $rodebt["name"],$rodebt["egn"],$rodebt["address"],$rodebt["address"]);
//			,$rodebt["agent"]);
					if (empty($rodebt["agent"])){
					}else{
			$resu .= sprintf($temp2one_agent, $rodebt["agent"]);
					}
# 19.01.2011 - за чужденец 
egndele($resu,$rodebt);
return $resu;
		}else{
//return "????????";
return $rodebt["name"];
		}
}

function clai99one(){
global $roclai, $temp1one, $temp2one;
global $temp1_agent, $temp2_agent, $temp1one_agent, $temp2one_agent;
		$typeclai= $roclai["idtype"];
		if (0){
		}elseif ($typeclai==1){
										# 28.07.2010 КРЪПКА Дичев Пламен 
										$t1= c6patch($roclai["regipers"],"temp1one","temp1one_end");
//			$resu= sprintf($temp1one, $roclai["name"],$roclai["regidocu"],$roclai["regidate"],$roclai["regicase"]
			$resu= sprintf($t1, $roclai["name"],$roclai["regidocu"],$roclai["regidate"],$roclai["regicase"]
			,$roclai["bulstat"],$roclai["address"],$roclai["regipers"]);
//			,$roclai["agent"]);
					if (empty($roclai["agent"])){
					}else{
			$resu .= sprintf($temp1one_agent, $roclai["agent"]);
					}
return $resu;
		}elseif ($typeclai==2){
			$resu= sprintf($temp2one, $roclai["name"],$roclai["egn"],$roclai["address"],$roclai["address"]);
//			,$rodebt["agent"]);
					if (empty($roclai["agent"])){
					}else{
			$resu .= sprintf($temp2one_agent, $roclai["agent"]);
					}
# 19.01.2011 - за чужденец 
egndele($resu,$roclai);
return $resu;
		}else{
//return "????????";
return $roclai["name"];
		}
}



# 09.07.2010 - клонинг за Дичев, но само с 1 адрес, а не с 2 
#------------------------------------------------------------------
# 14.09.2009 - Бургас - всичко за длъжника според типа юр/физ лице 
# но с шаблоните за един ред 
# 26.01.2010 - Бургас - добавен и представителя [agent] 
function data_debt99one($padata=NULL){
//global $rodebt, $data_temp1one, $data_temp2one;
global $data_temp1one, $data_temp2one;
global $temp1_agent, $temp2_agent, $data_temp1one_agent, $data_temp2one_agent;
	if ($padata===NULL){
$rodebt= $GLOBALS["rodebt"];
	}else{
$rodebt= $padata;
	}
		$typedebt= $rodebt["idtype"];
		if (0){
		}elseif ($typedebt==1){
										# 28.07.2010 КРЪПКА Дичев Пламен 
										$t1= c6patch($rodebt["regipers"],"data_temp1one","data_temp1one_end");
//			$resu= sprintf($data_temp1one, $rodebt["name"],$rodebt["regidocu"],$rodebt["regidate"],$rodebt["regicase"]
			$resu= sprintf($t1, $rodebt["name"],$rodebt["regidocu"],$rodebt["regidate"],$rodebt["regicase"]
			,$rodebt["bulstat"],$rodebt["address"],$rodebt["regipers"]);
//			,$rodebt["agent"]);
					if (empty($rodebt["agent"])){
					}else{
			$resu .= sprintf($data_temp1one_agent, $rodebt["agent"]);
					}
return $resu;
		}elseif ($typedebt==2){
			$resu= sprintf($data_temp2one, $rodebt["name"],$rodebt["egn"],$rodebt["address"]);
//			,$rodebt["agent"]);
					if (empty($rodebt["agent"])){
					}else{
			$resu .= sprintf($data_temp2one_agent, $rodebt["agent"]);
					}
# 19.01.2011 - за чужденец 
egndele($resu,$rodebt);
return $resu;
		}else{
//return "????????";
return $rodebt["name"];
		}
}

function data_clai99one($padata=NULL){
//global $roclai, $data_temp1one, $data_temp2one;
global $data_temp1one, $data_temp2one;
global $temp1_agent, $temp2_agent, $data_temp1one_agent, $data_temp2one_agent;
	if ($padata===NULL){
$roclai= $GLOBALS["roclai"];
	}else{
$roclai= $padata;
	}
		$typeclai= $roclai["idtype"];
		if (0){
		}elseif ($typeclai==1){
										# 28.07.2010 КРЪПКА Дичев Пламен 
										$t1= c6patch($roclai["regipers"],"data_temp1one","data_temp1one_end");
//			$resu= sprintf($data_temp1one, $roclai["name"],$roclai["regidocu"],$roclai["regidate"],$roclai["regicase"]
			$resu= sprintf($t1, $roclai["name"],$roclai["regidocu"],$roclai["regidate"],$roclai["regicase"]
			,$roclai["bulstat"],$roclai["address"],$roclai["regipers"]);
//			,$roclai["agent"]);
					if (empty($roclai["agent"])){
					}else{
			$resu .= sprintf($data_temp1one_agent, $roclai["agent"]);
					}
return $resu;
		}elseif ($typeclai==2){
			$resu= sprintf($data_temp2one, $roclai["name"],$roclai["egn"],$roclai["address"]);
//			,$rodebt["agent"]);
					if (empty($roclai["agent"])){
					}else{
			$resu .= sprintf($data_temp2one_agent, $roclai["agent"]);
					}
# 19.01.2011 - за чужденец 
egndele($resu,$roclai);
return $resu;
		}else{
//return "????????";
return $roclai["name"];
		}
}



# 28.07.2010 КРЪПКА Дичев Пламен 
function c6patch($emptco,$p1,$p1_end){
	$emptco= trim($emptco);
//print "----<br>";
//var_dump($emptco);
//var_dump($GLOBALS[$p1]);
	if (empty($emptco)){
//		$GLOBALS[$p1]= str_replace($GLOBALS[$p1_end],"",$GLOBALS[$p1]);
return str_replace($GLOBALS[$p1_end],"",$GLOBALS[$p1]);
	}else{
return $GLOBALS[$p1];
	}
//var_dump($GLOBALS[$p1_end]);
//var_dump($GLOBALS[$p1]);
}



?>
