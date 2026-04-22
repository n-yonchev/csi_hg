{*
параметър :
	$EDIT - делото suit.id 
ВАЖНО : 
	Работи само за единично дело, не за група дела. 
*}
{*---- ЦРД-2014 -----------------*}
<a href="#" onclick="tose('{$EDIT}'); return false;"><img src="images/admin.gif" title="предай делото към ЦРД-2014"></a>
&nbsp;
<img id="reg4mark" src="images/block.gif"  rel="#reg4cont" title="последен резултат от ЦРД-2014" style="cursor:help">
<span id="reg4cont" style="display: none">
</span>
&nbsp;
<img id="reg4from" src="images/exclude.gif"  rel="#reg4contfrom" title="съдържание на делото в ЦРД-2014" style="cursor:pointer"
onclick="fromse('{$EDIT}'); return false;">
<span id="reg4contfrom" style="display: none">
<span style="color:red">клик за обръщение към сървъра</span>
	<span id="reg4cf2">
	</span>
</span>
&nbsp;&nbsp;

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
function tose(p1){ldelim}
		jQuery.ajax({ldelim}
			url: "cazo1tose.ajax.php?e="+p1
			,success: cazo1succ
			{rdelim});
{rdelim}
function cazo1succ(data){ldelim}
///////////////////////////alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}

$(document).ready(function() {ldelim}
	reg4get();
	$('#reg4mark').cluetip({ldelim} width: 660, local:true, cursor:'help' {rdelim});
	$('#reg4from').cluetip({ldelim} width: 600, local:true, cursor:'help' {rdelim});
{rdelim});

function reg4get(){ldelim}
	$('#reg4mark').attr("src","ajaxload.gif");
		jQuery.ajax({ldelim}
			url: "cazo1viewr4.ajax.php?e={$EDIT}"
			,success: r4resu
			{rdelim});
{rdelim}
function r4resu(data){ldelim}
//alert(data);
	$('#reg4mark').attr("src","images/block.gif");
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
		var r4cont= arre[1];
		if (r4cont){ldelim}
$('#reg4cont').html(r4cont);
$('#reg4mark').show();
		{rdelim}else{ldelim}
$('#reg4mark').hide();
		{rdelim}
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
setTimeout(reg4get,10000);
{rdelim}

function fromse(p1){ldelim}
	$("#reg4from").attr("src","ajaxload.gif");
		jQuery.ajax({ldelim}
			url: "cazo1fromse.ajax.php?e="+p1
			,success: cazo1succfrom
			{rdelim});
{rdelim}
function cazo1succfrom(data){ldelim}
///////////////////////////alert(data);
	$("#reg4from").attr("src","images/exclude.gif");
	var arre= data.split("^");
	if (arre[0]=="ok"){ldelim}
$("#reg4cf2").html(arre[1]);
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
