{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="статистика по дела" WIDTH=600}
<style>
td {ldelim}border-bottom: 1px solid silver;{rdelim}
</style>

								{if isset($MONT)}
						{assign var=text value="месеца"}
								{else}
						{assign var=text value="периода"}
								{/if}
<style>
.hetext {ldelim}background:silver;{rdelim}
</style>
					<table>
					<tr>
<td colspan=4> изходени документи по дела 
	<br> на деловодител {$USERNAME}
	<br> за {if isset($MONT)}месец {$MONT}-{$YEAR}
	{else}периода {$D1|date_format:"%d.%m.%Y"}-{$D2|date_format:"%d.%m.%Y"}{/if}
					<tr>
<td class="hetext"> №
<td class="hetext"> изх.номер
<td class="hetext"> изходен
<td class="hetext"> тип
<td class="hetext"> адресат
<td class="hetext"> дело
						{counter start=0 print=false}
			{foreach from=$DATA item=elem}
					<tr style="border-bottom: 1px solid black;">
<td class="sttext" align=right> {counter})
<td class="sttext" align=left> {$elem.serial}/{$elem.year}
<td class="sttext" align=left> {$elem.registered|date_format:"%d.%m.%Y"}
<td class="sttext" align=left> {$elem.text}
<td class="sttext" align=left> {$elem.adresat}
<td class="sttext" align=left> {$elem.caseseri}/{$elem.caseyear}
			{/foreach}
{*
					<tr>
<td class="hetext"> общо
<td class="hetext" align=right> {include file="_stcell.tpl" VALUE=$SUMA[1] DECI=2}
<td class="hetext" align=right> {include file="_stcell.tpl" VALUE=$SUMA[2] DECI=2}
*}
					</table>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
