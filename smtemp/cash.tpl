<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>приходни касови ордери</td>
	</tr>
</thead>
<tbody>
	<tr class='header'>
		<td><span> номер </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> дата </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> сума </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> задел </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> остатък </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> вносител </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> длъжник </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> дело </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> пакет </span></td>
	</tr>
	{foreach from=$LIST item=elem key=ekey}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
		<td align=right> {$elem.serial}/{$elem.year}</td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.date|date_format:"%d.%m.%Y"} </td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.amount|tomoney} </td>
		<td class='sep'>&nbsp;</td>
		<td> {if $elem.packstat==0 or $elem.packstat==0}
			<span class="t8checked" align=right title="корегирай" onclick="$('#se{$elem.id}').click();" style="cursor:pointer">
				<a href="{$elem.editsepa}" class="nyroModal" target="_blank"  id="se{$elem.id}"><b>{$elem.amountsep|tomoney2}</b></a>
				</span>
			{else}
				{$elem.amountsep|tomoney2}
			{/if}
			{assign var="rest" value=$elem.amount-$elem.amountsep} </td>
		<td class='sep'>&nbsp;</td>
		<td> {$rest|tomoney} </td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.name} </td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.debtname} </td>
		<td class='sep'>&nbsp;</td>
		<td> {$elem.suseri}/{$elem.suyear} </td>
		<td class='sep'>&nbsp;</td>
		{if empty($elem.packseri)}
			<td class="packout" align=center title="не е включен в пакет" style="cursor:help"> - </td>
		{else}
			{if $elem.packstat==0}
			{assign var="mycl" value="packnotfin"}
			{assign var="myti" value="пакета НЕ Е приключен"}
			{else}
			{assign var="mycl" value=""}
			{assign var="myti" value="пакета е приключен"}
			{/if}
		<td class="{$mycl}" title="{$myti}" style="cursor:help"> &nbsp; {$elem.packseri} &nbsp; {$elem.packamou|tomoney} </td>
		{/if}
	</tr>
	{/foreach}
	</tbody>
{include file="_pagina.tr.tpl"}
</table>

