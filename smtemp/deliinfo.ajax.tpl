{***
		$iddocu 
***}
{*
<style>
.he7 {ldelim}font: normal 7pt verdana !important; background-color:silver !important; padding-left:4px;{rdelim}
.ro7 {ldelim}font: normal 7pt verdana !important; border-bottom: 1px solid black !important;{rdelim}
.ertype {ldelim}background-color:salmon;cursor:help;{rdelim}
</style>
*}
<td align=left>
<nobr>
							{assign var=ardata value=$ARDELI[$iddocu]}
							{assign var=armeth value=$ARDELIMETH[$iddocu]}
		{if isset($ardata)}
			{if $armeth==-1}
			{else}
{$ARPOSTTYPE_2[$armeth]}
			{/if}
					{if $ARDELINODA[$iddocu]==0}
					{else}
<span style="background-color:violet;padding:2px 6px 2px 6px;">
					{/if}
<sub>
{***
<img src="images/view.png" class="deliinfo" rel="#deli{$iddocu}" title="информация за връчване на изх.док.{$elem.serial}/{$elem.year}" style="cursor:help;">
***}
<img src="images/view.png" class="deliinfo" style="cursor:help;" 
rel="deliinfo.ajax.php?p={$iddocu}" title="информация за връчване на изх.док.{$elem.serial}/{$elem.year}">
</sub>
					{if $ARDELINODA[$iddocu]==0}
					{else}
</span>
					{/if}
		{else}
-
		{/if}
</nobr>
{***
<span id="deli{$iddocu}" style="display: none">
<table>
<tr>
<td class="he7"> адресат
<td class="he7"> метод
<td class="he7"> взет
<td class="he7"> връчен
<td class="he7"> върнат
<td class="he7"> статус
		{foreach from=$ardata item=eldata}
<tr>
<td class="ro7"> {$eldata.adresat}
<td class="ro7"> {$ARPOSTTYPE_2[$eldata.idposttype]}
<td class="ro7"> {$eldata.date1|date_format:"%d.%m.%Y"}&nbsp;
<td class="ro7"> {$eldata.date2|date_format:"%d.%m.%Y"}&nbsp;
<td class="ro7"> {$eldata.date3|date_format:"%d.%m.%Y"}&nbsp;
<td {if $eldata.isertype}class="ertype" title="статуса не отговаря на метода"{else}ro7{/if}> {$eldata.statname}&nbsp;
		{/foreach}
</table>
</span>
***}
