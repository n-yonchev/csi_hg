<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:51
         compiled from _cbsess.tpl */ ?>
<script>
var _funcname;
function _cboxaction(funcname){
	_funcname= funcname;
	var list= $("input[@type='checkbox']");
	var lico= "";
	var coun= 0;
	for (var i=0; i<list.length; i++){
		if (list[i].checked){
			lico += list[i].id+",";
			coun += 1;
		}else{
		}
	}
	if (coun==0){
	}else{
		lico= lico.substring(0,lico.length-1);
		jQuery.ajax({
			url: "cbsess.ajax.php?p="+lico
			,success: _cboxsuccess
			});
	}
}
function _cboxsuccess(data){
//alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){
_funcname();
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>