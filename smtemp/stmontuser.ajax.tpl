{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="статистика по дела"}

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
<td colspan=4> статистика по дела 
	<br> на деловодител {$USERNAME}
	<br> за {if isset($MONT)}месец {$MONT}-{$YEAR}
	{else}периода {$D1|date_format:"%d.%m.%Y"}-{$D2|date_format:"%d.%m.%Y"}{/if}
					<tr>
<td class="hetext"> дело
<td class="hetext"> събрано<br>общо<br>през {$text}
<td class="hetext"> събрано<br>заЧСИ<br>през {$text}
			{foreach from=$DATA item=elem}
					<tr>
<td class="sttext" align=left> {$elem.caseseri}/{$elem.caseyear}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$elem.coun DECI=2}
<td class="sttext" align=right> {include file="_stcell.tpl" VALUE=$elem.coun2 DECI=2}
			{/foreach}
					<tr>
<td class="hetext"> общо
<td class="hetext" align=right> {include file="_stcell.tpl" VALUE=$SUMA[1] DECI=2}
<td class="hetext" align=right> {include file="_stcell.tpl" VALUE=$SUMA[2] DECI=2}
					</table>

{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
