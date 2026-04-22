{*----
	източник : cazo1view.tpl 
----*}
												<table>
			<tr>
			<td class="contcase" valign=top>
деловодител
			<td class="contcase" valign=top>
<b>
{$USERNAME}
</b>
			<tr>
			<td class="contcase" valign=top>
образувано на
			<td class="contcase" valign=top>
<b>
{$DATA.created|date_format:"%d.%m.%Y"}
</b>
			<tr>
			<td class="contcase" valign=top>
описание
			<td class="contcase" valign=top>
<b>
{$DATA.text}
</b>
			<tr>
			<td class="contcase" valign=top>
идва от
			<td class="contcase" valign=top>
						{assign var="arindx" value=$DATA.idcofrom}
<b>
{$ARFROM.$arindx}
</b>
	{if empty($DATA.cogrou)}
	{else}
/ състав {$DATA.cogrou}
	{/if}
			<tr>
			<td class="contcase" valign=top>
изп.титул
			<td class="contcase" valign=top>
						{assign var="arindx" value=$DATA.idtitu}
<b>
{$ARTITU.$arindx}
</b>
			<tr>
			<td class="contcase" valign=top>
вид, номер/год
			<td class="contcase" valign=top>
						{assign var="arindx" value=$DATA.idsort}
<b>
{$ARSORT.$arindx}, {$DATA.conome}/{$DATA.coyear}
</b>
												</table>
