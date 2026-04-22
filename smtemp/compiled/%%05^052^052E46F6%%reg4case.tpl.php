<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from reg4case.tpl */ ?>
<a href="#" onclick="tose('<?php echo $this->_tpl_vars['EDIT']; ?>
'); return false;"><img src="images/admin.gif" title="предай делото към ЦРД-2014"></a>
&nbsp;
<img id="reg4mark" src="images/block.gif"  rel="#reg4cont" title="последен резултат от ЦРД-2014" style="cursor:help">
<span id="reg4cont" style="display: none">
</span>
&nbsp;
<img id="reg4from" src="images/exclude.gif"  rel="#reg4contfrom" title="съдържание на делото в ЦРД-2014" style="cursor:pointer"
onclick="fromse('<?php echo $this->_tpl_vars['EDIT']; ?>
'); return false;">
<span id="reg4contfrom" style="display: none">
<span style="color:red">клик за обръщение към сървъра</span>
	<span id="reg4cf2">
	</span>
</span>
&nbsp;&nbsp;

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
function tose(p1){
		jQuery.ajax({
			url: "cazo1tose.ajax.php?e="+p1
			,success: cazo1succ
			});
}
function cazo1succ(data){
///////////////////////////alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}

$(document).ready(function() {
	reg4get();
	$('#reg4mark').cluetip({ width: 660, local:true, cursor:'help' });
	$('#reg4from').cluetip({ width: 600, local:true, cursor:'help' });
});

function reg4get(){
	$('#reg4mark').attr("src","ajaxload.gif");
		jQuery.ajax({
			url: "cazo1viewr4.ajax.php?e=<?php echo $this->_tpl_vars['EDIT']; ?>
"
			,success: r4resu
			});
}
function r4resu(data){
//alert(data);
	$('#reg4mark').attr("src","images/block.gif");
	var arre= data.split("^");
	if (arre[0]=="ok"){
		var r4cont= arre[1];
		if (r4cont){
$('#reg4cont').html(r4cont);
$('#reg4mark').show();
		}else{
$('#reg4mark').hide();
		}
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
setTimeout(reg4get,10000);
}

function fromse(p1){
	$("#reg4from").attr("src","ajaxload.gif");
		jQuery.ajax({
			url: "cazo1fromse.ajax.php?e="+p1
			,success: cazo1succfrom
			});
}
function cazo1succfrom(data){
///////////////////////////alert(data);
	$("#reg4from").attr("src","images/exclude.gif");
	var arre= data.split("^");
	if (arre[0]=="ok"){
$("#reg4cf2").html(arre[1]);
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>