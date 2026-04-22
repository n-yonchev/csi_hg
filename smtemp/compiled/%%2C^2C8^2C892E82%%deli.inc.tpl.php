<?php /* Smarty version 2.6.9, created on 2020-02-28 11:14:13
         compiled from deli.inc.tpl */ ?>

<script>
var currlink;
function fubegi(p1){
currlink= p1;
	var list= $("input[@type='checkbox']");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){
//alert(i);
		if (list[i].checked){
			lico += list[i].id+"/";
//alert(i+'='+lico);
			coun ++;
		}else{
		}
	}
//return lico+"^"+coun;
//alert(coun);
	if (coun==0){
	}else{
		jQuery.ajax({
			url: "delidocucbox.ajax.php?list="+lico
			,success: succedit
			});
	}
}
function succedit(data){
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){
$.nyroModalManual({forceType:'iframe', url:currlink});
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>