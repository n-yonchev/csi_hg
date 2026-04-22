{include file="_ajax.header.tpl"}
					{assign var="date" value=$ROBANK.created|date_format:'%d.%m.%Y %H:%M:%S'}
{include file="_window.header.tpl" TITLE="редове от извлечение № "|cat:$ROBANK.id|cat:" от "|cat:$date|cat:" (ОББ)"}
{include file="_erform.tpl"}
<style>
.he2 {ldelim}font: bold 7pt verdana; background-color: silver;{rdelim}
.ro2 {ldelim}font: normal 7pt verdana; border-bottom: 1px solid black;{rdelim}
</style>

		<table align=center>
		<tr>
<td class="he2"> дата
<td class="he2"> време
<td class="he2" align=right> приход &nbsp;
<td class="he2" align=right> разход &nbsp;
<td class="he2"> описание
<td class="he2"> кореспондент
<td class="he2"> основание
<td class="he2"> пояснения
<td class="he2"> референция
<td class="he2"> статус
	{foreach from=$LIST item=elem}
		<tr>
<td class="ro2" valign=top> {$elem.POST_DATE.value}
<td class="ro2" valign=top> {$elem.TIME.value}
<td class="he2" valign=top align=right> {$elem.AMOUNT_C.value} &nbsp;
<td class="he2" valign=top align=right> {$elem.AMOUNT_D.value} &nbsp;
<td class="ro2" valign=top> {$elem.TR_NAME.value}
<td class="ro2" valign=top> {$elem.NAME_R.value}
<td class="ro2" valign=top> {$elem.REM_I.value}
<td class="ro2" valign=top> {$elem.REM_II.value}
<td class="ro2" valign=top> {$elem.REFERENCE.value}
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
