{include file="_ajax.header.tpl"}
					{assign var="date" value=$ROBANK.created|date_format:'%d.%m.%Y %H:%M:%S'}
{include file="_window.header.tpl" TITLE="редове от извлечение № "|cat:$ROBANK.id|cat:" от "|cat:$date|cat:" (Алианц)"}
{include file="_erform.tpl"}
<style>
.he2 {ldelim}font: bold 7pt verdana; background-color: silver;{rdelim}
.ro2 {ldelim}font: normal 7pt verdana; border-bottom: 1px solid black;{rdelim}
</style>

		<table align=center>
		<tr>
<td class="he2"> вальор
<td class="he2"> време
<td class="he2" align=right> сума &nbsp;
<td class="he2" align=center> ДК
<td class="he2"> име
<td class="he2"> код
<td class="he2"> контрагент
<td class="he2"> основание
<td class="he2"> пояснения
<td class="he2"> сметка
<td class="he2"> референция
<td class="he2"> статус
	{foreach from=$LIST item=elem}
		<tr>
<td class="ro2" valign=top> {$elem.valuedate}
<td class="ro2" valign=top> {$elem.datetime}
<td class="he2" valign=top align=right> {$elem.amount} &nbsp;
<td class="he2" valign=top align=center> {$elem.dtkt}
<td class="ro2" valign=top> {$elem.trname}
<td class="ro2" valign=top> {$elem.trcode}
<td class="ro2" valign=top> {$elem.contragent}
<td class="ro2" valign=top> {$elem.rem_i}
<td class="ro2" valign=top> {$elem.rem_ii}
<td class="ro2" valign=top> {$elem.rem_iii}
<td class="ro2" valign=top> {$elem.reference}
					{assign var=colo value=""}
				{if $elem.status==0}
				{elseif $elem.status==1}
					{assign var=colo value="red"}
				{elseif $elem.status==2}
					{assign var=colo value="green"}
				{else}
				{/if}
<td class="he2" valign=top> <font color="{$colo}">{$ARSTAT[$elem.status]}</font>
	{/foreach}
		</table>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
