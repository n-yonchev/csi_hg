	<table>
	<tr>
<td> деловодител
<td><b>{$elem.username}</b>
	<tr>
<td> постъпление
<td><b>{$elem.suma|tomo3}</b>
		{foreach from=$ARGODATA[$idfina] item=eldata key=elkey}
		<tr>
<td align=right><b>{$eldata.amount|tomo3}</b>
					{if $eldata.idclaimer<0}
<td color=red><font color=red> {$PSCLAI[$eldata.idclaimer]} </font>
					{else}
<td> {$eldata.clainame}
					{/if}
		{/foreach}
	<tr>
<td colspan=4> <font color=blue>ляв клик = ВЗЕМИ ЗА ПРЕВОД </font>
	<tr>
<td colspan=4> <font color=blue>десен клик = върни на деловодителя </font>
	</table>
