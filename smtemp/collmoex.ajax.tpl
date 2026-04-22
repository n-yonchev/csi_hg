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
td {ldelim}font: normal 12pt verdana;{rdelim}
.hetext {ldelim}background-color:#d0d0d0; {rdelim}
</style>
					<table border=1>
					<tr>
<td colspan=5> 
Месечен доклад 
	<br> на деловодител <b>{$USERNAME}</b>
	<br> за <b>{if isset($MONT)}месец {$MONT}-{$YEAR}</b>
	{else}периода {$D1|date_format:"%d.%m.%Y"}-{$D2|date_format:"%d.%m.%Y"}{/if}
<br> Събрани суми за ЧСИ по изпълнителни дела 
					<tr>
<td class="hetext"> дело
<td class="hetext" align=right> сума<br>с ДДС
<td class="hetext" align=right> сума<br>без ДДС
<td class="hetext"> дата
<td class="hetext"> тип
{*
<td class="hetext"> постъпление
*}
			{foreach from=$DATA item=elem}
					<tr>
<td class="sttext" align=left> '{$elem.caseseri}/{$elem.caseyear}
<td class="sttext" align=right> {$elem.suma|tomoney2}
<td class="sttext" align=right> {$elem.novat|tomoney2}
<td class="sttext" align=left> {$elem.timeclosed|date_format:"%d.%m.%Y"}
<td class="sttext" align=left> {$ARTYPE[$elem.idtype]}
{*
<td class="sttext" align=left> {$elem.inco|tomoney2}
*}
			{/foreach}
					<tr>
<td class="hetext"> общо
<td class="hetext" align=right> {$TOTA[1]|tomoney2}
<td class="hetext" align=right> {$TOTA[2]|tomoney2}
					</table>

{*----
{include file="_window.footer.tpl"}
{include file="_ajax.footer.tpl"}
----*}
