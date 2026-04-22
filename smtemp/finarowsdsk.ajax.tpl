{include file="_ajax.header.tpl"}
					{assign var="date" value=$ROBANK.created|date_format:'%d.%m.%Y %H:%M:%S'}
{include file="_window.header.tpl" TITLE="редове от извлечение № "|cat:$ROBANK.id|cat:" от "|cat:$date|cat:" (ДСК)"}
{include file="_erform.tpl"}
<style>
.he2 {ldelim}font: bold 7pt verdana; background-color: silver;{rdelim}
.ro2 {ldelim}font: normal 7pt verdana; border-bottom: 1px solid black;{rdelim}
</style>

		<table align=center>
		<tr>
<td class="he2"> дата
<td class="he2"> час
<td class="he2"> описание
<td class="he2" align=right> приход &nbsp;
<td class="he2" align=right> разход &nbsp;
<td class="he2"> код
<td class="he2"> статус
	{foreach from=$LIST item=elem}
		<tr>
<td class="ro2" valign=top> {$elem.date}
<td class="ro2" valign=top> {$elem.hour}
<td class="ro2" valign=top> {$elem.desc1|cat:" "|cat:$elem.desc2|cat:" "|cat:$elem.desc3|cat:" "|cat:$elem.desc4}
<td class="he2" valign=top align=right> {$elem.prih|tomoney2} &nbsp;
<td class="he2" valign=top align=right> {$elem.razh|tomoney2} &nbsp;
<td class="ro2" valign=top> {$elem.refe}
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
