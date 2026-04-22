{*
<style>
.tab6 tr td {ldelim}width:120px;font:normal 8pt verdana !important;{rdelim}
</style>
*}
						{assign var=st6 value="style='width:120px !important;vertical-align:middle !important;'"}
				<table border=1>
				<tr>
<td colspan='15'> Обобщен отчет за ВСС
				<tr>
{include file="rep3head.tpl" MODE=1}
				<tr>
{include file="rep3head.tpl" MODE=2}
				<tr>
{include file="rep3head.tpl" MODE=3}
{foreach from=$ARDATA item=elem key=indx}
				<tr>
<td {$st6} align=right title="{$ARHE.h1}"> {$elem.c1}
<td {$st6} align=right title="{$ARHE.h2}"> {$elem.c2}
<td {$st6} align=right title="{$ARHE.h3}" class="suma"> {$elem.c3}
<td {$st6} align=right title="{$ARHE.h4}"> {$elem.c4}
<td {$st6} align=right title="{$ARHE.h5}"> {$elem.c5}
<td {$st6} align=right title="{$ARHE.h6}"> {$elem.c6}
<td {$st6} align=right title="{$ARHE.h7}" class="suma"> {$elem.c7}
<td {$st6} align=right title="{$ARHE.h8}"> {$elem.c8|tomoex}
<td {$st6} align=right title="{$ARHE.h9}"> {$elem.c9|tomoex}
<td {$st6} align=right title="{$ARHE.h10}" class="suma"> {$elem.c10|tomoex}
<td {$st6} align=right title="{$ARHE.h11}" class="suma"> {$elem.c11|tomoex}
<td {$st6} align=right title="{$ARHE.h12}"> {$elem.c12|tomoex}
<td {$st6} align=right title="{$ARHE.h13}"> {$elem.c13|tomoex}
<td {$st6} align=right title="{$ARHE.h14}"> {$elem.c14|tomoex}
<td {$st6} align=right title="{$ARHE.h15}" class="suma"> {$elem.c15|tomoex}
{/foreach}
				</table>
{*
<script type="text/javascript">
function autonamesubm(event,foid){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
document.forms['mynameform'].submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
function toggle(idpa){ldelim}
	var obpare= $("[@pare="+idpa+"]");
//$("tr[@rel=tr"+pid+"]").show();
	if ($(obpare).attr("stat")=="-"){ldelim}
		$("[@rela="+idpa+"]").show();
		$(obpare).attr("stat","+");
	{rdelim}else{ldelim}
		$("[@rela="+idpa+"]").hide();
		$(obpare).attr("stat","-");
	{rdelim}
{rdelim}
</script>
*}

