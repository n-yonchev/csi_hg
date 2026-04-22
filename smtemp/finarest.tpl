	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'> списък на ИГНОРИРАНИТЕ постъпления
{*
				{if isset($FILTTEXT)}
&nbsp;&nbsp;&nbsp;&nbsp;
<span style="font: bold 7pt verdana; color: black;">
{$FILTTEXT}
</span>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{$FILTTOALL}" style="font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;">без филтър</a>
				{else}
				{/if}
*}
	</tr>
	</thead>

{*---- съдържание, източник : _fina.tpl ----------------------*}
<style>
.head {ldelim}font:normal 7pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd;{rdelim}
</style>

<td class="head" align=right> сума
<td class="head"> тип
<td class="head" align=center> време
<td class="head">
<td class="head">
{*
<td class="head" align=center> исто<br>рия
*}
<td class="head" align=center> дело
<td class="head" align=center> деловодител
<td class="head" align=center> нераз<br>пред
<td class="head" align=center> при<br>ключ 
<td class="head" align=center> дата погасяв

{*---- списъка ----------------------------------*}
{foreach from=$LIST item=elem key=ekey}
						{assign var="myid" value=$elem.id}
	<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";' >
{*---- сума ----*}
<td class="head" valign=top align=right> <b>{$elem.inco}</b>
{*---- тип ----*}
				{assign var="idtype" value=$elem.idtype}
				{if $idtype==1}
					{assign var="finaba" value="/"|cat:$elem.sour.idfinabank}
				{else}
					{assign var="finaba" value=""}
				{/if}
<td valign=top> <nobr>{$ARTYPE.$idtype|cat:$finaba} </nobr></td>
{*---- време ----*}
<td valign=top align=left>
						{if $idtype==1}
{$elem.sour.date} {$elem.sour.hour}
						{elseif $idtype==2}
{$elem.cashdate}
						{else}
&nbsp;
						{/if}
{*---- доп.информация ----*}
<td align=center valign=top>
				{if $idtype==1}
<img src="images/view.png" class="ttip" rel="#cont{$myid}" title="ред от извлечението" style="cursor:help">
{*---- съдържание на доп.информация ----*}
<span id="cont{$myid}" style="display: none">
	<table align=center>
	<tr>
	<td align=left valign=top> време
	<td width=10>
<td> <b>{$elem.sour.date} {$elem.sour.hour}</b>
	<tr>
	<td align=left valign=top> постъпление
	<td width=10>
<td> <b>{$elem.sour.amount}</b>
	<tr>
	<td align=left valign=top> описание
	<td width=10>
<td> <b>{$elem.sour.desc1}</b>
	<tr>
	<td align=left valign=top> кореспондент
	<td width=10>
<td> <b>{$elem.sour.desc2}</b>
	<tr>
	<td align=left valign=top> основание
	<td width=10>
<td> <b>{$elem.sour.desc3}</b>
	<tr>
	<td align=left valign=top> пояснения
	<td width=10>
<td> <b>{$elem.sour.desc4}</b>
	<tr>
	<td align=left valign=top> референция
	<td width=10>
<td> <b>{$elem.sour.reference}</b>
	</table>
</span>
{*---- край на доп.информация ----*}
				{else}
<img src="images/view.png" title="{$elem.descrip}" style="cursor:help">
				{/if}
{*---- възстановяване ----*}
<td align=center valign=top>
<a href="{$elem.rest}">
<img src="images/restore.gif" title="възстанови">
</a>
{*---- последна корекция и историята ----*}
{*
<td align=center valign=top>
<span id="hist{$myid}" style="display: none">
			{if $elem.histcoun==0}
записа е въведен
			{else}
последната корекция е направена
			{/if}
<br>
от <b>{$elem.finaname}</b>
<br>
на <b>{$elem.time|date_format:"%d.%m.%Y"}</b> в <b>{$elem.time|date_format:"%H:%M:%S"}</b>
			{if $elem.histcoun==0}
			{else}
<br>
<br>
<b>кликни, за да видиш цялата история</b>
			{/if}
</span>
			{if $elem.histcoun==0}
&nbsp;&nbsp;
<img src="images/hist.gif" class="hist" rel="#hist{$myid}" title="създаване" style="cursor:help">
</td>
			{else}
<a href="{$elem.hist}" class="nyroModal" target="_blank">
<nobr>
&nbsp;
<span class="finahist" rel="#hist{$myid}" title="история на корекциите">{$elem.histcoun}</span>
</nobr>
</a></td>
			{/if}
*}
{*---- дело ----*}
			{if empty($elem.idcase)}
<td align=center valign=top>
{*
<a href="{$elem.direcase}"> <img src="images/direcase.gif" title="избери дело">
</a>
*}
			{else}
<td align=left valign=top>
<span class="finahist" title="виж делото" onclick="document.location.href='{$elem.viewcase}'; return false;">
{$elem.caseseri}/{$elem.caseyear} </span>
</td>
			{/if}
{*---- деловодител ----*}
<td align=left valign=top> {$elem.username} &nbsp; </td>
{*---- неразпределения остатък ----*}
<td align=right valign=top> 
	{if $elem.rest==0}
-
	{else}
{$elem.rest|tomoney:2}
	{/if}
</td>
{*---- приключване ----*}
<td align=center>
	{if $elem.idcase<>0 and $elem.rest==0}
		{if $elem.isclosed==1}
{*
<span class="yes" title="ПРИКЛЮЧЕН">&nbsp;</span>
*}
<span class="yes" title="ПРИКЛЮЧЕНО на {$elem.timeclosed|date_format:'%d.%m.%Y'}">&nbsp;</span>
		{else}
&nbsp;
		{/if}
	{else}
<span class="no" title="приключването е невъзможно">&nbsp;</span>
	{/if}
</td>
{*---- дата за погасяването ----*}
<td align=left>
	{if $elem.idcase<>0 and $elem.rest==0}
		{if $elem.isclosed==1}
			{if empty($elem.datebala)}
				{assign var=daco value="няма"}
				{assign var=dast value="finahistno"}
			{else}
				{assign var=daco value=$elem.datebala|date_format:"%d.%m.%Y"}
				{assign var=dast value="finahist"}
			{/if}
				{if $HIST}
{$daco}
				{else}
<a href="{$elem.date}" class="nyroModal" target="_blank">
<span class="{$dast}" title="корегирай датата"> {$daco}
</span></a>
				{/if}
		{else}
&nbsp;
		{/if}
	{else}
&nbsp;
	{/if}
</td>

{/foreach}

{include file="_pagina.tr.tpl"}
	</table>


<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
	$('.hist').cluetip({ldelim} width: 240, local:true, cursor:'pointer' {rdelim});
	$('.finahist').cluetip({ldelim} width: 240, local:true, cursor:'pointer' {rdelim});
$('.filt1').cluetip({ldelim}
//	cluetipClass: 'rounded', 
	arrows: true, 
	width: 220,
	sticky: true,
	mouseOutClose: true,
	closeText: '<b>x</b>',
	closePosition: 'title'
	{rdelim});
$('.info').cluetip({ldelim} width: 360, cursor:'help' {rdelim});
{rdelim});
{*
function fup2(p1){ldelim}
	fuprin("finaprnt.php?para="+p1);
{rdelim}
function fuprincode(){ldelim}
	var list= $("input[@type='checkbox']");
	var lico= "";
	for (var i=0; i<list.length; i++){ldelim}
		if (list[i].checked){ldelim}
			lico += list[i].id+"/";
		{rdelim}else{ldelim}
		{rdelim}
	{rdelim}
//alert(lico);
	fuprin("finaprnt.php?para="+lico);
{rdelim}
*}
</script>


