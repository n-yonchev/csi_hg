{*---- 
		$ISEXCE 
----*}
<style>
body td {ldelim}font: normal 8pt verdana; margin: 1px 6px 1px 6px;{rdelim}
.header {ldelim}font: bold 7pt verdana; background-color:#bbbbbb; margin: 1px 6px 1px 6px;{rdelim}
</style>
				<table>
				<tr>
<td colspan='8'>
списък на фактурите {$TEXTHEAD}
		<tr>
<td class='header'> номер
<td class='header'> дата
<td class='header' align=right> сума
<td class='header' align=right> ДДС
<td class='header' align=right> общо
<td class='header'> получател
<td class='header'> ЕГН/ЕИК
<td class='header'> сметка
<td class='header'> дата
<td class='header'> дело
<td class='header'> деловодител

{foreach from=$LIST item=elem key=ekey}
								{assign var="myinvo" value=$elem.id}
										{if $myinvo==0}
{*
		<tr>
<td colspan=8> <font color=red> {$elem.diff} незаети номера </font>
*}
										{else}
		<tr>
<td align=right>
					{if empty($elem.seriinvo)}
&nbsp;
					{else}
{$elem.seriinvo}
					{/if}

<td> {$elem.dateinvo|date_format:"%d.%m.%Y"}

<td align=right> {$elem.s0|tomo3ex:$ISEXCE}

<td align=right> {$elem.svat|tomo3ex:$ISEXCE}

{*
					{if $elem.suma==0}
<td id="suma{$myinvo}" align=right class="zero"> нула
					{else}
<td id="suma{$myinvo}" align=right> {$elem.suma|tomo3ex:$ISEXCE}
					{/if}
*}
<td id="suma{$myinvo}" align=right> {$elem.suma|tomo3ex:$ISEXCE}

<td> {$elem.name}

			{if empty($elem.egn)}
<td> {$elem.eik}
			{else}
<td> {$elem.egn}
			{/if}

<td> 
					{if $elem.serial<=0}
-
					{else}
{$elem.serial}
					{/if}

<td> {$elem.date|date_format:"%d.%m.%Y"}

<td> 
					{if $elem.serial==0}
-
					{else}
{$elem.caseseri}/{$elem.caseyear}
					{/if}

<td> 
					{if $elem.serial==0}
-
					{else}
{$elem.username}
					{/if}
										{*--- {if $myinvo==0} ---*}
										{/if}
		</tr>
{/foreach}

{*---- общо за периода ----*}
		<tr class="header">
<td colspan=2> общо за периода
<td align=right> {$ARSUYEAR.s0|tomo3ex:$ISEXCE}
<td align=right> {$ARSUYEAR.svat|tomo3ex:$ISEXCE}
<td align=right> {$ARSUYEAR.suma|tomo3ex:$ISEXCE}
<td colspan=4> &nbsp;

				</table>
				