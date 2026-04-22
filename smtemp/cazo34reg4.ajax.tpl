{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="съвпадения за длъжник "|cat:$DEBTNAME WIDTH=400}
{include file="_erform.tpl"}

			{if isset($MESS)}
{$MESS}
			{else}
{*
			{/if}
*}
				{if count($ARRESU)==0}
няма регистрирани дела 
				{else}
<style>
.trow {ldelim}border-bottom: 1px solid black;{rdelim}
</style>
						<table align=center>
						<tr>
<td colspan=10> списък съвпадения
						<tr bgcolor=silver>
<td> име
<td> ЕГН/ЕИК
<td> чужд
<td> изп.дело
<td> статус
<td> ЧСИ
<td> номер
		{foreach from=$ARRESU item=elem}
						<tr>
<td class="trow"> {if empty($elem.name)}{$elem.company_name}{else}{$elem.name}{/if}
<td class="trow"> {$elem.egn_eik}
<td class="trow"> {if $elem.foreigner==0}&nbsp;{else}да{/if}
<td class="trow"> {$elem.number}
<td class="trow"> {$AR4CASESTAT[$elem.status]}
<td class="trow"> {$elem.chsi_name}
<td class="trow"> {$elem.chsi_number}
		{/foreach}
						</table>
				{/if}
			{/if}

{*----
<h3>{$MESS}</h3>
			{if isset($ERCONT)}
{$ERCONT}
			{else}
{$OKRESU}
за <b>{$DEBTNAME}</b>
<br>
				{if count($OKLIST)==0}
няма регистрирани дела при други ЧСИ 
				{else}
има <b>{$OKCOUN} {if $OKCOUN==1}брой{else}броя{/if}</b> регистрирани дела при други ЧСИ
<style>
.trow {ldelim}border-bottom: 1px solid black;{rdelim}
</style>
						<table align=center>
						<tr bgcolor=silver>
<td> ЧСИ
<td> име
<td> изп.дело
		{foreach from=$OKLIST item=elem}
						<tr>
<td class="trow"> {$elem.enforcernumber}
<td class="trow"> {$elem.enforcerfullname}
<td class="trow"> {"`$elem.execcasenumber+0`"}/{$elem.execcaseyear}
		{/foreach}
						</table>
				{/if}
			{/if}
<br>
<br>
----*}

{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}
