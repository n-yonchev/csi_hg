{*----
{include file="_ajax.header.tpl"}
{include file="_window.header.tpl" TITLE="статистика по дела"}
----*}

								{if isset($MONT)}
						{assign var=text value="месеца"}
								{else}
						{assign var=text value="периода"}
								{/if}
<style>
td {ldelim}font: normal 8pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; text-align:left;{rdelim}
</style>
					<table>
					<tr>
<td colspan=6> Суми разпределени за ЧСИ от приключени постъпления по изп.дела 
	<br> на деловодител {$USERNAME}
	<br> за {if isset($MONT)}месец {$MONT}-{$YEAR}
	{else}периода {$D1|date_format:"%d.%m.%Y"}-{$D2|date_format:"%d.%m.%Y"}{/if}
					<tr>
<td class="hetext"> дата
<td class="hetext"> сума<br>с ДДС
<td class="hetext"> сума<br>без ДДС
<td class="hetext"> дело
<td class="hetext"> тип
<td class="hetext"> постъпление
			{foreach from=$DATA item=elem}
					<tr>
<td class="sttext" align=left> {$elem.timeclosed|date_format:"%d.%m.%Y"}
<td class="sttext" align=left> {$elem.suma|tomoney2}
<td class="sttext" align=left> {$elem.novat|tomoney2}
<td class="sttext" align=left> '{$elem.caseseri}/{$elem.caseyear}
<td class="sttext" align=left> {$ARTYPE[$elem.idtype]}
<td class="sttext" align=left> {$elem.inco|tomoney2}
			{/foreach}
					<tr>
<td class="hetext"> общо
<td class="hetext" align=left> {$TOTA[1]|tomoney2}
<td class="hetext" align=left> {$TOTA[2]|tomoney2}
					</table>

{*----
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
----*}
