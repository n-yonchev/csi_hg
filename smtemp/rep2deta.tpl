<style>
.c1 {ldelim}font: normal 8pt verdana; border-bottom: 1px solid silver !important; padding: 2px 8px;{rdelim}
.c1suma {ldelim}font: normal 8pt verdana; background-color:#dddddd; padding: 2px 8px;{rdelim}
.c1head {ldelim}font: normal 8pt verdana; background-color:#dfe8f6; padding: 2px 8px;{rdelim}
.c1he2 {ldelim}font: bold 8pt verdana; background-color:#dfe8f6; padding: 2px 8px;{rdelim}
.c1link {ldelim}font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;{rdelim}
.c2text {ldelim}font: normal 8pt verdana; color:darkmagenta; {rdelim}
.c2vari {ldelim}font: normal 8pt verdana; color:darkmagenta; border-bottom: 1px solid darkmagenta; cursor: pointer{rdelim}
.c2curr {ldelim}font: normal 8pt verdana; color:darkmagenta; background-color:wheat; cursor: pointer; padding: 1px 10px;{rdelim}
.c3desc {ldelim}font: normal 8pt verdana; color:blue;{rdelim}
</style>
						{assign var="isdesc" value="<sup><b><font color=red>o</font></b></sup>"}
						{assign var="cudesc" value="style='cursor:help'"}
				<table align=center class="d_table">
				<tr>
<td class="c1he2" colspan=20> {$REHEAD}
<br>
<span class="c2text">избери филтър</span>
&nbsp;&nbsp;
{foreach from=$ARLIN2 item=elem key=ekey}
	<span class="{if $ekey==$SUBLIS}c2curr{else}c2vari{/if}" title="{$ARTIT2.$ekey}"
	{include file="_href.tpl" LINK=$elem}> {$ARTEX2.$ekey} </span>
						{assign var="xxcode" value=$ARINDX.$ekey}
{*
	<sup>{"`$ARCOUN.$xxcode+0`"}</sup>
*}
	<sup>{$ARCOUN.$xxcode}</sup>
{/foreach}
								{if $ISSUMA}
				<tr>
{*
<td class="c1suma" colspan=3> сумарно в отчета
*}
<td class="c1suma" colspan=3>
<span class="{if $CURRF2=="all"}c2curr{else}c2vari{/if}" {include file="_href.tpl" LINK=$ARLINKF2.all} 
title="кликни за : всички дела от групата">
сумарно в отчета </span>
				<td> &nbsp;
{*
<td class="c1suma" align=right> {$ARSUMA.sum_c1full|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c1paym|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c1|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c2|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c3suma|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c9|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c11diff|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c12diff|tomo3}
*}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c1full COLU="c1full"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c1paym COLU="c1paym"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c1 COLU="c1"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c2 COLU="c2"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c3suma COLU="c3suma"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c9 COLU="c9"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c11diff COLU="c11diff"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c12diff COLU="c12diff"}
				<td>
{*
<td class="c1suma" align=right> {$ARSUMA.sum_c5|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c6|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c7|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c8|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c4|tomo3}
<td class="c1suma" align=right> {$ARSUMA.sum_c10|tomo3}
*}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c5 COLU="c5"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c6 COLU="c6"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c7 COLU="c7"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c8 COLU="c8"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c4 COLU="c4"}
{include file="rep2detaf2.tpl" CONT=$ARSUMA.sum_c10 COLU="c10"}
								{else}
								{/if}
			{if $CURRF2=="all"}
			{else}
				<tr>
<td class="c1head" colspan=30>
<font color=red>
само делата, които формират сумата в {$ARF2.$CURRF2}
</font>
			{/if}
				<tr>
<td class="c1head"> дело
<td class="c1head"> образувано
<td class="c1head" align=center width=50> съст
				<td> &nbsp;
{include file="rep2detahead.tpl"}
						{assign var="t1befo" value="<span style='background:tomato'><b>&lt;</b></span>"}
						{assign var="t1duri" value="<span style='background:green'>&nbsp;&nbsp;</span>"}
						{assign var="t2no" value="<span style='background:silver'>&nbsp;&nbsp;</span>"}
						{assign var="t2yes" value="<span style='background:green'>&nbsp;&nbsp;</span>"}
		{foreach from=$DATA item=elem}
						{assign var="mycase" value=$elem.idcase}
				<tr>
<td class="c1link" onclick="toggle('{$mycase}');" oncontextmenu="proc2('{$mycase}');return false;"> {$elem.serial}/{$elem.year}
<td class="c1"> {$elem.created|date_format:"%d.%m.%Y"}
<td class="c1" rel="#cont{$mycase}" title="състояние" rela="ttip" style="cursor:help;">
<nobr>
		{if $elem.stat1==0}
{$t1duri}
		{else}
{$t1befo}
		{/if}
		{if $elem.stat2==0}
{$t2no}
		{else}
{$t2yes}
		{/if}
{$isdesc}		
</nobr>
{*---- съдържание на доп.информация ----*}
<span id="cont{$mycase}" style="display: none">
		{if $elem.stat1==0}
образувано ПРЕЗ периода
		{else}
образувано ПРЕДИ периода
		{/if}
		{if $elem.stat2==0}
		{else}
<hr>
прекратено през периода
<br>
последен статус от <b>{$elem.timeduri|date_format:"%d.%m.%Y"}</b>
<br>
<b>{$ARSTAT[$elem.statduri]}</b> 
		{/if}
<hr>
изп.титул : <b>{$ARTITU[$elem.idtitu]}</b>
<br>
срок за доброволно събиране : <b>{$elem.voludays} дни</b>
<br>
крайна дата добров.събиране : <b>{$elem.voluenddate|date_format:"%d.%m.%Y"}</b>
</span>
{*------------------------*}
				<td>
<td class="c1" align=right> {$elem.c1full|tomo3}
<td class="c1" align=right> {$elem.c1paym|tomo3}
<td class="c1suma" align=right> {$elem.c1|tomo3}
<td class="c1" align=right> {$elem.c2|tomo3}
<td class="c1suma" align=right> {$elem.c3suma|tomo3}
<td class="c1" align=right> {$elem.c9|tomo3}
<td class="c1suma" align=right> {$elem.c11diff|tomo3}
<td class="c1suma" align=right> {$elem.c12diff|tomo3}
				<td>
<td class="c1" align=right> {$elem.c5|tomo3}
<td class="c1" align=right> {$elem.c6|tomo3}
<td class="c1" align=right> {$elem.c7|tomo3}
<td class="c1" align=right> {$elem.c8|tomo3}
<td class="c1suma" align=right> {$elem.c4|tomo3}
<td class="c1" align=right> {$elem.c10|tomo3}
{*---- допълнителен ред ----*}
				<tr id='tr{$mycase}' style="display:none" rela="togg">
<td id='td{$mycase}' colspan=40 align=left bgcolor="" rela="togg">
</td>
		</tr>
		{/foreach}
{include file="_pagina.tr.tpl"}
				</table>
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$("[@rela='ttip']").cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
	$("[@rela='desc']").cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
{rdelim});

function toggle(pid){ldelim}
	var trobje= document.getElementById("tr"+pid);
	var tdobje= document.getElementById("td"+pid);
	var curdis= (trobje.style.display=="");
//			$("tr[@rela='togg']").each(function(){ldelim}$(this).hide();{rdelim});
//			$("td[@rela='togg']").each(function(){ldelim}$(this).html('');{rdelim});
	if (curdis){ldelim}
		trobje.style.display= "none";
		$(tdobje).html("");
	{rdelim}else{ldelim}
		trobje.style.display= "";
//		linkcall(tdobje,plink);
		$(tdobje).html("<img src='ajaxload.gif'>");
		$(tdobje).load("rep2case.ajax.php?c="+pid+"&p={$PERIOD}");
	{rdelim}
{rdelim}

function proc2(p1){ldelim}
window.currcase= p1;
		jQuery.ajax({ldelim}
			url: "rep2calc2.ajax.php?p={$PERIOD}&c="+p1 +"&log=yes"
			,success: succ2
			{rdelim});
{rdelim}
function succ2(data){ldelim}
p1= window.currcase;
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){ldelim}
		var trobje= document.getElementById("tr"+p1);
		trobje.style.display= "none";
		var tdobje= document.getElementById("td"+p1);
		$(tdobje).html("");
	{rdelim}else{ldelim}
alert("ERROR"+String.fromCharCode(10)+data);
	{rdelim}
{rdelim}
</script>
