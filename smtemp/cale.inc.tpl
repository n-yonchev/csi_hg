		<table class="d_table" cellspacing='0' cellpadding='0' align=left>
		<thead>
						{if count($DATA)==0}
		<tr>
<td class='d_table_title' colspan='200'> НЯМА събития през месец {$YEMO} </td>
		</tr>
		</thead>
						{else}
		<tr>
<td class='d_table_title' colspan='200'> събития през месец {$YEMO} </td>
		</tr>
		</thead>
		<tr class='header'>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td align=left> дело </td>
		<td class='sep'>&nbsp;</td>
<td align=left> деловодител </td>
		<td class='sep'>&nbsp;</td>
<td align=left> събитие </td>
		<tbody>
{foreach from=$DATA item=elem key=mkey}
		<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td> {$elem.date|date_format:"%d.%m.%Y"}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.caseseri}/{$elem.caseyear}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.username}
		<td class='sep'>&nbsp;</td>
<td align=left> {$elem.text}
{/foreach}
		</tbody>
						{/if}
		</table>
