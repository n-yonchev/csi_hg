<?php

# връща код за ajax
//function getajax($PHFILE,$AJAXTOSE,$AJAXFROMSE   ,$JSFILE){
function getajax($PHFILE,$AJAXTOSE,$AJAXFROMSE){
	#----------- параметри --------------
	# 1) php скрипта за специфична сървърна обработка на ajax обръщението
	# 2) js функция за събиране стойностите на полетата от формата - вика се от toServer
	#    кода на функцията трябва да го има в HTML кода на викащата страница
	# 3) js функция за отразяване резултата в страницата след ajax - вика се от fromServer
	#    кода на функцията трябва да го има в HTML кода на викащата страница
			#----------- константи --------------
			# файла за javascript компонента от готовия клас ajax 
//			$JSFILE= $JSFILE ."dklab/ext1/Js.js";
			# id на спана за възможните грешки от сървърната обработка на ajax обръщението
			# спана трябва да го има в HTML кода на викащата страница
			$IDERROR= "iderror";
//	<script language="JavaScript" src="$JSFILE"></script>
return <<<A1
	<script>
	var req;
	function toServer(){
		req= new Subsys_JsHttpRequest_Js();
		req.onreadystatechange= fromServer;
		req.caching= false;
		req.open('POST','$PHFILE',true);
document.body.style.cursor='wait';
						$AJAXTOSE 
	}
	function fromServer(){
		if (req.readyState == 4) {
document.body.style.cursor='auto';
if (req.responseText==''){
}else{
//	alert(req.responseText);
	document.getElementById('$IDERROR').innerHTML = req.responseText;
}
			if (req.responseJS) {
						$AJAXFROMSE 
			}
		}
	}
</script>
A1;
}

?>