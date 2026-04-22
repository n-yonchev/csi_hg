
{include file="_ajax.header.tpl"}{if empty($LIST)}	{assign var='_title' value='няма приходни ордери включени в пакета'}{else}	{assign var='_title' value='приходни ордери включени в пакета'}{/if}{include file='_window.header.tpl' TITLE="$_title" }
{include file="_erform.tpl"}
									{if empty($LIST)}	няма приходни ордери включени в пакета

									{else}
<table class="d_table" width='800px;' cellspacing='0' cellpadding='0' align=center>	<thead>		<tr>			<td class='d_table_title' colspan='200'>касови пакети</td>		</tr>	</thead>		<tr class='header'>			<td> номер </td>			<td class='sep'>&nbsp;</td>			<td> дата </td>			<td class='sep'>&nbsp;</td>			<td> сума </td>
			<td class='sep'>&nbsp;</td>			<td> задел </td>
			<td class='sep'>&nbsp;</td>			<td> остат </td>
			<td class='sep'>&nbsp;</td>			<td> вносител </td>
			<td class='sep'>&nbsp;</td>			<td> длъжник </td>
			<td class='sep'>&nbsp;</td>			<td> дело </td>
					</tr>	<tbody>
		{foreach from=$LIST item=elem key=ekey}		<tr class="{$mycl}" id="tr{$elem.id}" marker="ttip" rel="#markttip" title="обща сума" onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >			<td > {$elem.serial}/{$elem.year} </td>			<td class='sep'>&nbsp;</td>			<td > {$elem.date|date_format:"%d.%m.%Y"} </td>			<td class='sep'>&nbsp;</td>			<td > {$elem.amount|tomoney} </td>			<td class='sep'>&nbsp;</td>			<td > {$elem.amountsep|tomoney2} </td>			{assign var="rest" value=$elem.amount-$elem.amountsep}			<td class='sep'>&nbsp;</td>			<td  marker="ssum" id="su{$elem.id}"> {$rest|tomoney} </td>			<td class='sep'>&nbsp;</td>			<td > {$elem.name} </td>			<td class='sep'>&nbsp;</td>			<td > {$elem.debtname} </td>			<td class='sep'>&nbsp;</td>			<td > {$elem.suseri}/{$elem.suyear} </td>						
			<tr>
		{/foreach}		</tbody>
	</table>

{/if}
{include file='_window.footer.tpl'}
{include file="_ajax.footer.tpl"}

