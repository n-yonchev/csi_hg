{*
<style>
.he7 {ldelim}font: normal 7pt verdana !important; background-color:silver !important; padding-left:4px;{rdelim}
.ro7 {ldelim}font: normal 7pt verdana !important; border-bottom: 1px solid black !important;{rdelim}
.ertype {ldelim}background-color:salmon;cursor:help;{rdelim}
</style>
*}
<table align=center>
<tr>
<td class="he7"> адресат
<td class="he7"> адрес
<td class="he7"> метод
<td class="he7"> взет
<td class="he7"> връчен
<td class="he7"> върнат
<td class="he7"> статус
<td class="he7"> бележки
		{foreach from=$ARDELI item=eldata}
<tr>
<td class="ro7"> {$eldata.adresat}
<td class="ro7"> {$eldata.address}
<td class="ro7"> {$ARPOSTTYPE_2[$eldata.idposttype]}
<td class="ro7"> {$eldata.date1|date_format:"%d.%m.%Y"}&nbsp;
<td class="ro7"> {$eldata.date2|date_format:"%d.%m.%Y"}&nbsp;
<td class="ro7"> {$eldata.date3|date_format:"%d.%m.%Y"}&nbsp;
<td {if $eldata.isertype}class="ertype" title="статуса не отговаря на метода"{else}class="ro7"{/if}> {$eldata.statname}&nbsp;
<td class="ro7"> {$eldata.notes|nl2br}&nbsp;
		{/foreach}
</table>
