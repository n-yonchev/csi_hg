{*----
<table class="d_table" width='100%' cellspacing='0' cellpadding='0' align=center>
----*}
{*----- дв-86/17-----*}
<style>
.inte2 {ldelim}background-color:beige;{rdelim}
.sut0 {ldelim}cursor:help;font:bold 8pt verdana;border: 1px solid red;color:red;{rdelim}
.sut3 {ldelim}cursor:help;font:bold 8pt verdana;background-color:silver;{rdelim}
.sut6 {ldelim}cursor:help;font:bold 8pt verdana;background-color:lightgreen !important;{rdelim}
.sut9 {ldelim}cursor:help;font:bold 8pt verdana;background-color:lightsalmon !important;{rdelim}
</style>
					{assign var=mark0 value="class='sut0' title='[T]'"}
					{assign var=mark3 value="class='sut3' title='[T]'"}
					{assign var=mark6 value="class='sut6' title='[T]&#xA;участва в изчисляване на лимита'"}
					{assign var=mark9 value="class='sut9' title='[T]&#xA;НЕ участва в изчисляване на лимита'"}
<table class="d_table" cellspacing='0' cellpadding='0' {include file="_cazoplan.tpl"}>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
предмет на изпълнение
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#t2link').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
</div>
			{if $FLAGNOCHANGE}
			{else}
<div class='d_table_button' style="float:right">
{include file='_button.tpl' HREF="caseeditzone.php$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
</div>
			{/if}
		</tr>
	</thead>
		<tr class='header'>
			<td><span> описание </span></td>
{*----
			<td class='sep'>&nbsp;</td>
<td> взис </td>
----*}
			<td class='sep'>&nbsp;</td>
<td> т.26 </td>
			<td class='sep'>&nbsp;</td>
			<td><span> тип</span></td>
			<td class='sep'>&nbsp;</td>	
<td align=right> сума
{*
<br> <span class="inte2">лихва</span>
*}
			<td class='sep'>&nbsp;</td>
			<td><span> от дата</span></td>
			<td class='sep'>&nbsp;</td>	
			<td><span> взискател</span></td>
			<td class='sep'>&nbsp;</td>
<td> длъж
		{if $FLAGNOCHANGE}
		{else}
			<td class='sep'>&nbsp;</td>	
			<td><span> &nbsp;</span></td>
{*---- главница и лихва --------*}
{*----
			<td class='sep'>&nbsp;</td>
<td><span> &nbsp;</span></td>
			<td class='sep'>&nbsp;</td>
			<td><span> &nbsp;</span></td>
----*}
		{/if}
{*----- дв-86/17-----*}
			<td class='sep'>&nbsp;</td>
<td align=center> 
		</tr>
	<tbody>

		{foreach from=$LIST item=elem key=ekey}
				{assign var="arindx" value=$elem.idsubtype}
			{if empty($ARSUBT.$arindx)}
				{assign var="txsubtype" value=""}
			{else}
				{assign var="txsubtype" value="/"|cat:$ARSUBT.$arindx}
			{/if}
<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
{*----
		<tr  onmouseover='this.style.backgroundColor="#f6f6f6";' onmouseout='this.style.backgroundColor="";'>
			<td> <img src="images/view.png" title="{$elem.text}"></td>
----*}
<td> {$elem.text} </td>
{*----
			<td class='sep'>&nbsp;</td>
<td align=center> {if $elem.istoclaimer}да{else}-{/if} </td>
----*}
			<td class='sep'>&nbsp;</td>
<td align=center> {if $elem.isintax}да{else}-{/if} </td>
			<td class='sep'>&nbsp;</td>
				{assign var="arindx" value=$elem.idtype}
			<td> {$ARTYPE.$arindx}{$txsubtype}</td>
			<td class='sep'>&nbsp;</td>
{***
<td align=right> {$elem.amount|tomoney2}
***}
{*---- дв-86/17 за месечни суми --------*}
			<td align=right> 
							{if $elem.idtype==3 or $elem.idtype==5}
<nobr>мес {$elem.amount|tomoney2}</nobr>
<br>
<nobr>общо {$elem.capital|tomoney2}</nobr>
							{else}
{$elem.amount|tomoney2}
							{/if}
{*---- ---------------------------- ----*}
{*
	{if $elem.interest+0==0}
	{else}
<br>
<span class="inte2"> {$elem.interest|tomoney2} </span>
	{/if}
*}
			<td class='sep'>&nbsp;</td>	
							{if $elem.idtype==1 and empty($elem.fromdate)}
<td> <font color=red>без-олихв</font> </td>
							{else}
<td> {$elem.fromdate|date_format:"%d.%m.%Y"}
							{/if}
							{if $elem.idtype==3 and !empty($elem.todate)}
<br> 
{$elem.todate|date_format:"%d.%m.%Y"}
							{else}
							{/if}
			<td class='sep'>&nbsp;</td>
				{assign var="arindx" value=$elem.idclaimer}
			<td> {$ARCLAI.$arindx}</td>
			<td class='sep'>&nbsp;</td>
{*
			<td>
				{foreach from=$elem.listde item=elemdebt key=iddebt}
					{$ARDEBT.$elemdebt}<br/>
				{/foreach}
			</td>
*}
<td align=center class="ttip inte2" rel="#de{$ekey}" title="длъжници" style="cursor:help;"> {$elem.counde}
<span id="de{$ekey}" style="display: none">
				{foreach from=$elem.listde item=elemdebt key=iddebt}
					{$ARDEBT.$elemdebt}<br/>
				{/foreach}
</span>
{*---- ---------------------------- ----*}
		{if $FLAGNOCHANGE}
{assign var="cosp" value="0"}
		{else}
{assign var="cosp" value="4"}
			<td class='sep'>&nbsp;</td>
			<td> 
<nobr>
<a href="caseeditzone.php{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php{$elem.delrec}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
</nobr>
			</td>
{*-----------
			<td class='sep'>&nbsp;</td>
			<td>
				{if $elem.idtype==4}
&nbsp;
				{else}
<a href="subjpaym.php{$elem.paym}" class="nyroModal" target="_blank"><img src="images/paym.gif" title="плащания"></a>
				{/if}					
-----------*}
			</td>
		{/if}
{*---- главница и лихва --------*}
{*
<td class='sep'>&nbsp;</td>
<td> {$elem.capital|tomoney2}
<td class='sep'>&nbsp;</td>
<td> {$elem.interest|tomoney2}
*}
{*---- тип дв-86/17 --------*}
{*
				{assign var="markcode" value="mark"|cat:$ARSU4T[$elem.idt2]}
				{eval var=$markcode assign="m2code"}
<td> {$elem.idt2}/{$markcode}/{$m2code}
<td {$markcode}> &nbsp;&nbsp;&nbsp;
*}
<td class='sep'>&nbsp;</td>
				{assign var="type2" value=$ARSU4T[$elem.idt2]}
				{assign var="text2" value=$ARSU2TYPE[$elem.idt2]}
				{if $type2==0}
<td {$mark0|replace:"[T]":$text2}> ?
				{elseif $type2==3}
<td {$mark3|replace:"[T]":$text2}> з
				{elseif $type2==6}
<td {$mark6|replace:"[T]":$text2}> у
				{elseif $type2==9}
<td {$mark9|replace:"[T]":$text2}> н
				{else}
<td> ??????????
				{/if}
		</tr>
{*---- лихва в отделен ред --------*}
	{if $elem.interest+0==0}
	{else}
<tr>
<td class="inte2" colspan=5> лихва {$elem.amount|tomoney2} период {$elem.fromdate|date_format:"%d.%m.%Y"}-{$CURRDATE|date_format:"%d.%m.%Y"}
<td>
<td class="inte2" align=right> {$elem.interest|tomoney2}
	{/if}
		{/foreach}

			{math equation="a*b" a=0.3 b=$RECATOT assign="reca30"}
{*----
<tr>
<td colspan=8>
<td colspan={$cosp} class="recapitulation"> <b>общо дълг</b>
<td colspan=4 class="recapitulation" align=right> <b>{$RECASUM|tomoney2}</b>
<tr>
<td colspan=8>
<td colspan={$cosp} class="recapitulation"> <b>такса по т.26 вкл.ДДС</b>
<td colspan=4 class="recapitulation" align=right> <b>{$RECATAX|tomoney2}</b>
<tr>
<td colspan=8>
<td colspan={$cosp} class="recapitulation"> <b>общо дължима сума</b>
<td colspan=4 class="recapitulation" align=right> <b>{$RECATOT|tomoney2}</b>

<tr>
<td colspan=8>
<td colspan={$cosp} class="recapitulation"> <b>30 % от общо дължимата сума</b>
<td colspan=4 class="recapitulation" align=right> <b>{$reca30|tomoney2}</b>
----*}

{*---- рекапитулация --------*}
{*---- 04.09.2009 Т.Софрониев : 30 % от общо дълж.сума ----*}
<tr>
<td colspan=50>
		<table align=right>
<tr>
<td align=right class="recapitulation" width=90> <b>общо дълг</b>
<td align=right class="recapitulation" width=90> <b>дълг за т.26</b>
<td align=right class="recapitulation" width=90> <b>такса по т.26 вкл.ДДС</b>
<td align=right class="recapitulation" width=90> <b>общо дължима сума</b>
{*----- дв-86/17 20% вместо 30% -----*}
<td align=right class="recapitulation" width=90> <b>20 % от общо дълж.сума</b>
<tr>
<td align=right> <b>{$RECASUM|tomoney2}</b>
<td align=right> <b>{$RECAT26|tomoney2}</b>
<td align=right> <b>{$RECATAX|tomoney2}</b>
<td align=right> <b>{$RECATOT|tomoney2}</b>
{*----- дв-86/17 20% вместо 30% -----*}
			{math equation="a*b" a=0.2 b=$RECATOT assign="reca20"}
<td align=right> <b>{$reca20|tomoney2}</b>
		</table>

{*----- дв-86/17-----*}
<tr>
<td colspan=50>
{include file="cazo2x2.tpl"}

</tbody>
</table>

{*
{include file="cazo2a.tpl"}
*}

<script type="text/javascript">
	$('a.nyroModal').nyroModal();
</script>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
{*----- дв-86/17-----*}
	$('.ttip').cluetip({ldelim} width: 300, local:true, cursor:'pointer' {rdelim});
	{if isset($FORCLINK)}
////////////////////////////$.nyroModalManual({ldelim}forceType:'iframe', url:'caseeditzone.php{$FORCLINK}'{rdelim});
	{else}
	{/if}
{rdelim});
</script>

{include file='_frame.footer.tpl'}



