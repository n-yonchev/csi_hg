{include file="_tab2.tpl"}
<style>
.case {ldelim}cursor:pointer;background-color:khaki;{rdelim}
{*
input,select {ldelim}font:normal 7pt verdana !important;border:1px solid silver;{rdelim}
.poin {ldelim}cursor:pointer;border-bottom:1px solid black;background-color:silver;{rdelim}
.p7 {ldelim}font:normal 7pt verdana !important;{rdelim}
.link {ldelim}font: normal 8pt verdana; cursor: pointer; background-color:khaki;{rdelim}
.curr {ldelim}border-bottom:1px solid black; background-color:#cccccc; padding: 1px 6px 1px 6px;{rdelim}
.vari {ldelim}border-bottom:1px solid black;{rdelim}
.mark2 {ldelim}font:bold 8pt verdana;cursor:help;background-color:red;color:white;{rdelim}
.m0 {ldelim}font:bold 8pt verdana;cursor:help;background-color:silver;{rdelim}
.m1 {ldelim}font:bold 8pt verdana;cursor:help;background-color:orange;{rdelim}
.m2 {ldelim}font:bold 8pt verdana;cursor:help;background-color:green;{rdelim}
*}
</style>

									<table align=center>
									<tr>
									<td>
											{if isset($PAGEBACKLINK)}
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$PAGEBACKLINK}> {$PAGEBACKTEXT} </a>
											{else}
											{/if}
										{*---- отделно дело ----*}
{*
									<td width=50>
									<td align=right>
{include file="_caseinpu.tpl"}
*}
{*---- списъка ----*}
									<tr>
									<td colspan=6>
			<table class="tab2" cellspacing='0' cellpadding='2' align=center>
			<tr class='head2'>
<td colspan='20'>
											{if isset($PAGEBACKLINK)}
											{else}
списък на делата за перемиране
<div style="float:right;">
			<form name="form2" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
<nobr>
въведи макс.брой оставащи дни
<input type="text" name="daysrest" id="daysrest" size=6 autocomplete=off class="inp7bold" style="background:orange" 
onkeyup="form2subm(event,this.form,this.id);">
+enter
</nobr>
			</form>
</div>
											{/if}
			<tr class='head2'>
<td> дело
<td> деловодител
<td> образувано
<td> статус
<td align=center> остав<br>дни
<td> архив
<td> взискатели
<td> длъжници
<td> последно<br>изходяване
<td> последно<br>постъпление
<td> посл.вх.док<br>перемиране
{*
<td> разпо<br>реждане
<td> изх<br>докум
*}
							{if empty($ARDATA)}
								<tr>
<td colspan=20 align=center>
<br>&nbsp;
<b>няма дела в списъка</b>
<br>&nbsp;
							{else}
{foreach from=$ARDATA item=elem key=idcase}
			<tr>
<td class="case" {include file="_href.tpl" LINK=$elem.edit} title="виж делото"> {$elem.serial}/{$elem.year}
<td> {$elem.username}&nbsp;
<td> {$elem.created|date_format:"%d.%m.%Y"}
{*---- статус ----*}
<td>
{$ARSTAT[$elem.idstat]}
{***
		{if $elem.idstat<>$IDSTATPERE and !empty($elem.idorde)}
<nobr>
<a href="{$elem.topere}"><img src="images/lock3.gif" title="перемирай делото"></a>
<a href="{$elem.nopere}"><img src="images/unmark.gif" title="премахни делото от списъка"></a>
</nobr>
		{else}
		{/if}
***}
{*---- остав.дни ----*}
{*
<td align=center> {$elem.diff}
*}
<td align=center title="обр[{$elem.casecrea}]вх[{$elem.maxdatedocu}]изх[{$elem.maxdatedout}]пост[{$elem.maxdatefina}]=[{$elem.maxdate}]"> {$elem.diff}
{*---- архивирано ----*}
<td> {if $elem.isarch==0}{else}архив{/if}
{*---- взискатели, длъжници ----*}
<td class="p7">
{foreach from=$ARCLAI[$idcase] item=clname}
	{$clname}<br>
{/foreach}
<td class="p7">
{foreach from=$ARDEBT[$idcase] item=dename}
	{$dename}<br>
{/foreach}
<td> {$elem.datedout|date_format:"%d.%m.%Y"}
<td> {$elem.datefina|date_format:"%d.%m.%Y"}
<td> {$elem.datepere|date_format:"%d.%m.%Y"}
{*---- разпореждане ----*}
{*
		{if empty($elem.idorde)}
<td {if $elem.counclai==0 or $elem.coundebt==0}{else}align=center{/if}> 
<a href="{$elem.ordegene}" class="nyroModal" target="_blank"><img src="images/topaym.gif" title="формирай разпореждане"></a>
				{if $elem.counclai==0}
<span class="mark2" title="няма взискатели">&nbsp;В&nbsp;</span>
				{else}
				{/if}
				{if $elem.coundebt==0}
<span class="mark2" title="няма длъжници">&nbsp;Д&nbsp;</span>
				{else}
				{/if}
		{else}
<td> {$elem.idorde}/{$elem.ordecrea|date_format:"%d.%m.%Y %H:%M:%S"}
		{/if}
*}
{*---- изх.документи ----*}
{*
<td>
<nobr>
		{foreach from=$ARDOUT[$idcase] item=eldout}
			{if empty($eldout.docrea)}
<span class="m0" title="{$eldout.dttext}&#xA;не е формиран изх.документ">&nbsp;&nbsp;&nbsp;</span>
			{elseif empty($eldout.doseri) and empty($eldout.dogrou)}
<span class="m1" title="{$eldout.dttext}&#xA;формиран {$eldout.docrea|date_format:"%d.%m.%Y %H:%M:%S"}, но неизходен">&nbsp;&nbsp;&nbsp;</span>
			{elseif empty($eldout.doseri) and !empty($eldout.dogrou)}
<span class="m2" title="{$eldout.dttext}&#xA;изходени група документи">&nbsp;&nbsp;&nbsp;</span>
			{else}
<span class="m2" title="{$eldout.dttext}&#xA;изходен док.{$eldout.doseri}/{$eldout.doyear}">&nbsp;&nbsp;&nbsp;</span>
			{/if}
		{/foreach}
</nobr>
*}
{/foreach}
{include file="_tab2pagi.tpl"}
							{/if}
			</table>
									</table>

<script>
function form2subm(event,obform,idfiel){ldelim}
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){ldelim}
var obfi= document.getElementById(idfiel);
obfi.style.visibility= "hidden";
//obfi.value= foid+obfi.value;
//document.forms['mymainform'].submit();
obform.submit();
	{rdelim}else{ldelim}
return true;
	{rdelim}
{rdelim}
</script>
