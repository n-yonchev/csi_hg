{include file="_tab2.tpl"}
<style>
.tab2 tr td {ldelim}cursor:help;{rdelim}
.more {ldelim}background-color:beige;cursor:pointer !important;{rdelim}
.como {ldelim}background-color:linen;{rdelim}
.h7 {ldelim}font:normal 7pt verdana !important;background-color:#ddddee;{rdelim}
.suma {ldelim}background-color:#eeeeee;{rdelim}
</style>
				<table class="tab2" cellspacing='2' cellpadding='2' align=center style="margin:10px;">
				<tr class='head1'>
<td colspan='200'>
данни по взискатели
<br>
			<form name="mynameform" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
за търсене въведи част от име или ЕИК/ЕГН
<input type="text" class="inp7bold" name="filtname" id="filtname" size=16 autocomplete=off onkeyup="autonamesubm(event,'filtname');" value="{$FILTNAME}">
+enter
			</form>
				<tr class='h7'>
<td rowspan=2 colspan=5>
{include file="rep3head.tpl" MODE=1}
				<tr class='h7'>
{include file="rep3head.tpl" MODE=2}
				<tr class='h7'>
<td colspan=2> взискател
<td> ЕИК
<td> ЕГН
<td> дела
{include file="rep3head.tpl" MODE=3}
{foreach from=$ARDATA item=elem key=indx}
			{include file="_tab2tr.tpl"}
<td colspan=2> {$elem.name}
<td> {$elem.eik}
<td> {$elem.egn}
{***
<td align=center class="more" pare="e{$indx}" stat="-" onclick="toggle('e{$indx}');" title="подробно"> {$elem.coun}
***}
<td align=center class="more" pare="e{$indx}" stat="-" onclick="toggle('e{$indx}');" title="подробно"> {$elem.c3}
<td align=right title="{$ARHE.h1}"> {$elem.c1}
<td align=right title="{$ARHE.h2}"> {$elem.c2}
<td align=right title="{$ARHE.h3}" class="suma"> {$elem.c3}
<td align=right title="{$ARHE.h4}"> {$elem.c4}
<td align=right title="{$ARHE.h5}"> {$elem.c5}
<td align=right title="{$ARHE.h6}"> {$elem.c6}
<td align=right title="{$ARHE.h7}" class="suma"> {$elem.c7}
<td align=right title="{$ARHE.h8}"> {$elem.c8}
<td align=right title="{$ARHE.h9}"> {$elem.c9}
<td align=right title="{$ARHE.h10}" class="suma"> {$elem.c10}
<td align=right title="{$ARHE.h11}" class="suma"> {$elem.c11}
<td align=right title="{$ARHE.h12}"> {$elem.c12}
<td align=right title="{$ARHE.h13}"> {$elem.c13}
<td align=right title="{$ARHE.h14}"> {$elem.c14}
<td align=right title="{$ARHE.h15}" class="suma"> {$elem.c15}
	{foreach from=$AR2[$elem.codeut] item=elcase key=idcase}
			<tr rela="e{$indx}" style="display:none;">
			<td colspan=3>
			<td class="como" colspan=2> {$elcase.caye}
			<td align=right class="como" title="{$ARHE.h1}"> {$elcase.c1}
			<td align=right class="como" title="{$ARHE.h2}"> {$elcase.c2}
			<td align=right class="como suma" title="{$ARHE.h3}"> {$elcase.c3}
			<td align=right class="como" title="{$ARHE.h4}"> {$elcase.c4}
			<td align=right class="como" title="{$ARHE.h5}"> {$elcase.c5}
			<td align=right class="como" title="{$ARHE.h6}"> {$elcase.c6}
			<td align=right class="como suma" title="{$ARHE.h7}"> {$elcase.c7}
			<td align=right class="como" title="{$ARHE.h8}"> {$elcase.c8}
			<td align=right class="como" title="{$ARHE.h9}"> {$elcase.c9}
			<td align=right class="como suma" title="{$ARHE.h10}"> {$elcase.c10}
			<td align=right class="como suma" title="{$ARHE.h11}"> {$elcase.c11}
			<td align=right class="como" title="{$ARHE.h12}"> {$elcase.c12}
			<td align=right class="como" title="{$ARHE.h13}"> {$elcase.c13}
			<td align=right class="como" title="{$ARHE.h14}"> {$elcase.c14}
			<td align=right class="como suma" title="{$ARHE.h15}"> {$elcase.c15}
	{/foreach}
{/foreach}
{include file="_tab2pagi.tpl"}
				</table>

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
{*
	var obje= $("#"+idpa);
	if ($(obje).is(":hidden")){ldelim}
		$(obje).show();
	{rdelim}else{ldelim}
		$(obje).hide();
	{rdelim}
*}
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
