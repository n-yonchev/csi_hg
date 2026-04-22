{*----
	$HIST - дали се извежда историята
----*}
<style>
.head {ldelim}font:normal 7pt verdana; background-color:#efefef; border-right: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd;{rdelim}
</style>

{*---- антетката -----------------------------------*}
	<tr>
				{if $HIST}
				{else}
<td class="head" align=center> 
<td class="head" align=center> <img src="images/print.gif" title="отпечати маркираните" style="cursor:pointer" onclick="fuprincode();">
				{/if}
<td class="head" align=right> сума
							{if $HIST}
<td class="head"> тип
							{else}
<td class="head"> 
{*----
<span class="filt1" rel="finafilt.ajax.php?type=2&mode={$MODE}" title="избери тип" style="cursor:help"> 
тип <img src="images/filt.gif"> </span>
----*}
{*
{include file="_finalink.tpl" INDX=2 TITLE="избери тип" TEXT="тип"}
*}
тип
							{/if}
				{if $HIST}
				{else}
<td class="head" align=center> 
{*-----------------------------------------------------------------
ВНИМАНИЕ. Проблем с ефективността при Бъзински. 
поради това премахваме филтъра по извлечение
Виж забележката в fina.inc.php 
-----------------------------------------------------------------*}
{*----
{include file="_finalink.tpl" INDX=1 TITLE="избери извлечение" TEXT="извл"}
----*}
време
{*-------------------------------*}
				{/if}
{*----
<td> описание
----*}
<td class="head"> &nbsp;
				{if $HIST}
<td class="head" colspan=3> 
корекция
				{else}
{*----
последна корекция
----*}
				{/if}
				{if $HIST}
				{else}
<td class="head">&nbsp;</td>
{*----
<td align=center>изтр</td>
----*}
<td class="head">исто<br>рия</td>
{*----########
<td class="head" align=center>извл</td>
----*}
				{/if}
							{if $HIST}
<td class="head" align=center> дело
<td class="head" align=center> деловодител
<td class="head" colspan=2> заЧСИ
							{else}
{*----
<td class="head" align=center>
<span class="filt1" rel="finafilt.ajax.php?type=3&mode={$MODE}" title="избери вариант" style="cursor:help"> 
дело <img src="images/filt.gif"> </span>
</td>
<td class="head" align=center> 
<span class="filt1" rel="finafilt.ajax.php?type=4&mode={$MODE}" title="избери деловодител">
деловодител <img src="images/filt.gif" style="cursor:help"> 
</span>
</td>
<td class="head" align=center>
<span class="filt1" rel="finafilt.ajax.php?type=5&mode={$MODE}" title="избери вариант" style="cursor:help"> 
заЧСИ <img src="images/filt.gif"> </span>
</td>
----*}
<td class="head" align=center>
{*
{include file="_finalink.tpl" INDX=3 TITLE="избери вариант" TEXT="дело"}
*}
дело
			{if $SINGLEUSER}
<td class="head" align=center> деловодител
			{else}
<td class="head" align=center>
{*
{include file="_finalink.tpl" INDX=4 TITLE="избери деловодител" TEXT="деловодител"}
*}
деловодител
			{/if}
<td class="head" align=center colspan=2>
{*
{include file="_finalink.tpl" INDX=5 TITLE="избери вариант" TEXT="заЧСИ"}
*}
заЧСИ
							{/if}
<td class="head" align=center>заВзиск</td>
<td class="head" align=center>връ<br>щане</td>
					{if $ISBANKTAX}
<td class="head" align=center>банк<br>такси</td>
					{else}
					{/if}
<td class="head" align=center>нераз<br>пред</td>
							{if $HIST}
<td class="head" align=center> при<br>ключ 
							{else}
<td class="head" align=center>
{*----
<span class="filt1" rel="finafilt.ajax.php?type=6&mode={$MODE}" title="избери вариант" style="cursor:help"> 
при<br>ключ <img src="images/filt.gif"> </span>
----*}
{*
{include file="_finalink.tpl" INDX=6 TITLE="избери вариант" TEXT="при<br>ключ"}
*}
при<br>ключ
</td>
							{/if}
				{if $HIST}
				{else}
<td class="head" align=center> &nbsp; </td>
				{/if}
<td class="head" align=center>дата погасяв</td>
	</tr>

{*---- списъка ----------------------------------*}
{foreach from=$LIST item=elem key=ekey}
						{assign var="myid" value=$elem.id}
	<tr onmouseover='this.className="trdocu";' onmouseout='this.className="";' >
				{if $HIST}
				{else}
<td valign=top align=center> 
						{*---- ВНИМАНИЕ. 16.02.2010 само съмнителните постъпления ----*}
						{if empty($elem.susp)}
<img src="images/print.gif" title="отпечати" style="cursor:pointer" onclick="fup2('{$elem.prntcode}/');">
<td valign=top align=center> <input type=checkbox id="{$elem.prntcode}">
						{else}
<td valign=top align=center> 
<font color=red>{$elem.susp}</font>
						{/if}
				{/if}
<td class="head" valign=top align=right> <b>{$elem.inco|tomoney2}</b>
				{assign var="idtype" value=$elem.idtype}
{*----
				{assign var="arindx" value=$elem.idtype}
<td valign=top> <nobr>{$ARTYPE.$arindx} </nobr></td>
----*}
				{if $idtype==1}
					{assign var="finaba" value="/"|cat:$elem.sour.idfinabank}
				{else}
					{assign var="finaba" value=""}
				{/if}
<td valign=top> <nobr>{$ARTYPE.$idtype|cat:$finaba} </nobr></td>
				{if $HIST}
				{else}
{*----
<td valign=top align=center> {$elem.sour.idfinabank}
----*}
<td valign=top align=left>
						{if $idtype==1}
<nobr>
{$elem.sour.date} {$elem.sour.hour}
</nobr>
						{elseif $idtype==2}
<nobr>
{$elem.cashdate}
</nobr>
						{else}
&nbsp;
						{/if}
				{/if}
{*----
<td valign=top> {$elem.descrip}</td>
----*}
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
					{if empty($elem.descrip)}
					{else}
<img src="images/view.png" title="{$elem.descrip}" style="cursor:help">
					{/if}
				{/if}
</td>
				{if $HIST}
<td valign=top> {$elem.time|date_format:"%d.%m.%Y"}
<td valign=top> {$elem.time|date_format:"%H:%M:%S"}
<td valign=top> <nobr>{$elem.finaname}</nobr>
				{else}
				{/if}
				{if $HIST}
				{else}
<td align=left valign=top>
	{if $elem.isclosed==1}
{*----
<a href="{$elem.info}" class="nyroModal" target="_blank"><img src="images/info.gif" title="виж"></a>
----*}
<img src="images/info.gif" class="info" rel="{$elem.info}" title="информация за приключено постъпление" style="cursor:help">
	{else}
<nobr>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
			{if isset($elem.igno)}
<a href="{$elem.igno}" class="nyroModal" target="_blank"><img src="images/ignore.gif" title="игнорирай"></a>
			{else}
			{/if}
</nobr>
	{/if}
</td>
{*---- последна корекция и историята ----*}
<td align=center valign=top>
{*---- съдържание на историята ----*}
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
{*---- край на историята ----*}
			{if $elem.histcoun==0}
&nbsp;&nbsp;
<img src="images/hist.gif" class="hist" rel="#hist{$myid}" title="създаване" style="cursor:help">
</td>
{*----
<td align=center valign=top><img src="images/view.png" class="ttip" rel="#cont{$myid}" title="ред от извлечението" style="cursor:help">
----*}
			{else}
<a href="{$elem.hist}" class="nyroModal" target="_blank">
<nobr>
&nbsp;
<span class="finahist" rel="#hist{$myid}" title="история на корекциите">{$elem.histcoun}</span>
</nobr>
</a></td>
			{/if}
{*----########
			{if count($elem.sour)==0}
<td>&nbsp;</td>
			{else}
<td align=center valign=top><img src="images/view.png" class="ttip" rel="#cont{$myid}" title="ред от извлечението" style="cursor:help">
</td>
			{/if}
----*}

{*----
<td align=center><a href="{$elem.free}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a></td>
----*}
				{/if}
				{if $HIST}
<td align=left valign=top>
	{if empty($elem.caseseri) and empty($elem.caseyear)}
&nbsp;
	{else}
{$elem.caseseri}/{$elem.caseyear}
	{/if}
</td>
				{else}
			{if empty($elem.idcase)}
<td align=center valign=top>
<a href="{$elem.direcase}"> <img src="images/direcase.gif" title="избери дело">
</a></td>
			{else}
							{*---- 21.04.2010 разклонение за автоматично назначено дело ----*}
							{if $elem.isauto==0}
<td align=left valign=top>
<span class="finahist" title="виж делото" onclick="document.location.href='{$elem.viewcase}'; return false;">
{$elem.caseseri}/{$elem.caseyear} </span>
</td>
							{elseif $elem.isauto==1}
<td align=left valign=top>
<span class="finahistauto" title="виж автоматично назнач.дело" onclick="document.location.href='{$elem.viewcase}'; return false;">
{$elem.caseseri}/{$elem.caseyear} </span>
</td>
							{else}
<td align=left valign=top>
<span class="finahistauto2" title="виж автоматично назнач.дело" onclick="document.location.href='{$elem.viewcase}'; return false;">
{$elem.caseseri}/{$elem.caseyear} </span>
</td>
							{/if}
			{/if}
				{/if}
<td align=left valign=top> {$elem.username} &nbsp; </td>
<td align=right valign=top> {$elem.separa|tomoney2} &nbsp; </td>
<td align=right valign=top> {$elem.separa2|tomoney2} &nbsp; </td>

{*---- разпределените суми по взискатели ----*}
{*---- 23.07.2010 - за взискателите - обща сума с cluetip ----*}
<td align=right valign=top bgcolor=wheat class="ttip" style="cursor:help" rel="#clai{$myid}" title="разпределени суми по взискатели"> 
	{if count($elem.clailist)==0}
<b>-</b>
	{else}
<b>{$elem.claisuma|tomoney2} &nbsp;</b>
{*
		{foreach from=$elem.clailist item=clainame key=idclai}
			{assign var=myamou value=$elem.claiamou.$idclai}
			{if $myamou==0}
<nobr>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-{$clainame|truncate:40:"...":false}
</nobr>
			{else}
<nobr>
<b>{$myamou}</b>-{$clainame|truncate:40:"...":false}
</nobr>
			{/if}
<br>
		{/foreach}
*}
{*
<span class="ttip" rel="#dist{$myid}" title="по взискатели" style="border-bottom: 1px solid blue; cursor:help;">
		{foreach from=$elem.clailist item=clainame key=idclai}
			{assign var=myamou value=$elem.claiamou.$idclai}
			{if $myamou==0}
				{assign var=myamou value="</b>0.00<b>"}
			{else}
			{/if}
<b>{$myamou}</b> &nbsp;
		{/foreach}
</span>
<span id="dist{$myid}" style="display: none">
	<table align=center>
		{foreach from=$elem.clailist item=clainame key=idclai}
			{assign var=myamou value=$elem.claiamou.$idclai}
	<tr>
<td align=right> {$clainame}
<td>&nbsp;&nbsp; <b>{$myamou}</b>
		{/foreach}
	</table>
</span>
*}
	{/if}
{*---- 23.07.2010 - за взискателите - обща сума с cluetip ----*}
<span id="clai{$myid}" style="display: none">
		<table>
		{foreach from=$elem.clailist item=clainame key=idclai}
			{assign var=myamou value=$elem.claiamou.$idclai}
		<tr>
<td> {$clainame}
<td> <b>{if $myamou==0}-{else}{$myamou}{/if}</b>
		{/foreach}
		</table>
</span>
</td>

{*---- за връщане ----*}
<td align=right valign=top> 
	{if $elem.back==0}
-
	{else}
{$elem.back|tomoney:2}
	{/if}
</td>
{*---- за банк.такси ----*}
					{if $ISBANKTAX}
<td align=right valign=top> 
	{if $elem.banktax==0}
-
	{else}
{$elem.banktax|tomoney:2}
	{/if}
</td>
					{else}
					{/if}

{*---- неразпределения остатък ----*}
{*----
<td align=right> {"`$elem.inco-$elem.separa`"|tomoney:2} </td>
----*}
<td align=right valign=top> 
	{if $elem.rest==0}
-
	{else}
{$elem.rest|tomoney:2}
	{/if}
</td>

{*---- приключване - текст ----*}
{*------------------
<td align=center>
	{if $elem.rest==0}
		{if $elem.idcase==0}
<span class="no">не</span>
		{else}
&nbsp;
		{/if}
	{else}
<span class="yes">да</span>
	{/if}
</td>
------------------*}
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

{*---- приключи - икона ----*}
				{if $HIST}
				{else}
{*------------------
<td align=center>
	{if $elem.rest==0}
		{if $elem.idcase==0}
&nbsp;
		{else}
<a href="{$elem.correct}" class="nyroModal" target="_blank"><img src="images/correct.gif" title="приключи"></a>
		{/if}
	{else}
&nbsp;
	{/if}
</td>
------------------*}
<td align=center>
	{if $elem.idcase<>0 and $elem.rest==0}
		{if $elem.isclosed==1}
&nbsp;
		{else}
			{*---- деловодителя може да приключи само директен превод ----*}
			{*---- също и старо плащане ----*}
			{*---- финансиста може да приключи всички типове ----*}
			{if $CASEUSER and $elem.idtype<>9 and $elem.idtype<>7}
<span class="no2" title="финансиста може да го приключи">&nbsp;</span>
			{else}
{*----
<a href="{$elem.clos}" class="nyroModal" target="_blank"><img src="images/clos.gif" title="приключи"></a>
----*}
								{if empty($elem.lockname)}
<a href="{$elem.clos}" class="nyroModal" target="_blank"><img src="images/clos.gif" title="приключи"></a>
								{else}
<a href="{$elem.clos}" class="nyroModal" target="_blank"><img src="images/clos2.gif" title="приключи след като {$elem.lockname} затвори делото"></a>
								{/if}
			{/if}
		{/if}
	{else}
&nbsp;
	{/if}
</td>
				{/if}

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
{$elem.datebala|date_format:"%d.%m.%Y"}
		{/if}
	{else}
&nbsp;
	{/if}
</td>

	</tr>
{/foreach}

				{if $HIST}
				{else}
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
</script>
				{/if}

{*---- 23.07.2010 - за взискателите - обща сума с cluetip ----*}
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.ttip').cluetip({ldelim} width: 280, local:true, cursor:'pointer' {rdelim});
{rdelim});
</script>
