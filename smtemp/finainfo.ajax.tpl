{*----
	източник : finaedit.ajax.tpl - редактиране на запис постъпление 
----*}
{*----
{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="данни за приключено постъпление"}
{include file="_erform.tpl"}
----*}

		<table align=center>
		<tr>
<td align=right valign=top> тип
			{assign var=myindx value=$DATA.idtype}
<td align=left valign=top> <b> {$ARTYPE.$myindx} </b>
		<tr>
<td align=right valign=top> сума
<td align=left valign=top> <b> {$DATA.inco} </b>
		<tr>
<td align=right valign=top> дело
<td align=left valign=top> <b> {$DATA.caseseri}/{$DATA.caseyear} </b>
		<tr>
<td align=right valign=top> описание
<td align=left valign=top> <b> {$DATA.descrip} </b>
		<tr>
<td colspan=3> <hr>
		</table>

		<table>
		<tr>
<td align=right valign=top> за ЧСИ неолихвяеми
<td align=left valign=top> <b> {$DATA.separa|tomoney:2} </b>
		<tr>
<td align=right valign=top> за ЧСИ т.26
<td align=left valign=top> <b> {$DATA.separa2|tomoney:2} </b>
	{*---- сумите по взискатели ----*}
	{if count($CLAILIST)==0}
		<tr>
<td colspan=3> няма взискатели
	{else}
		{foreach from=$CLAILIST item=clainame key=idclai}
		<tr>
<td align=right valign=top> <nobr>за взискател {$clainame}</nobr>
<td align=left valign=top><b> {$DATA.claiamou.$idclai} </b>
		{/foreach}
	{/if}
{*---- за връщане ----*}
	<tr>
	<td align=right valign=top> за връщане
<td align=left valign=top> <b> {$DATA.back|tomoney:2} </b>
		</table>

{*----
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
----*}
