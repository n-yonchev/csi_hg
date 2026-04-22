		<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='10'> входящи документи по стари дела
</td>
		</tr>
		</thead>
		<tr class='header'>
<td> дело </td>
	{include file="_sepa.tpl"}
<td> вх.номер </td>
	{include file="_sepa.tpl"}
<td> описание </td>
	{include file="_sepa.tpl"}
<td> подател </td>
	{include file="_sepa.tpl"}
<td> бележки </td>
		</tr>
		<tbody>

{foreach from=$LISTCASE item=elemcase key=ekey}
			{assign var="idcase" value=$elemcase.id}
			{assign var="firstrow" value=true}
	{foreach from=$LISTDOCU[$idcase] item=elemdocu}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			{if $firstrow}
<td> {$elemcase.serial}/{$elemcase.year}
			{else}
<td> 
			{/if}
	{include file="_sepa.tpl"}
<td> {$elemdocu.serial}/{$elemdocu.year}
	{include file="_sepa.tpl"}
<td> {$elemdocu.text}
	{include file="_sepa.tpl"}
<td> {$elemdocu.from}
	{include file="_sepa.tpl"}
<td> {$elemdocu.notes|replace:";":"; "}
			{assign var="firstrow" value=false}
	{/foreach}
{/foreach}

		</tbody>
{include file="_pagina.tr.tpl"}
		</table>
