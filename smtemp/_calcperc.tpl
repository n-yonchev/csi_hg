		<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
		<thead>
		<tr>
<td class='d_table_title' colspan=100> Формиране на лихвата за периода
		</thead>
		<tr class='header'>
	<td> начало
	{include file="_sepa.tpl"}
	<td> край
	{include file="_sepa.tpl"}
	<td> дни
	{include file="_sepa.tpl"}
	<td> {$PERCTEXT}
	{include file="_sepa.tpl"}
	<td> ЗакЛ
	{include file="_sepa.tpl"}
	<td> днев%
	{include file="_sepa.tpl"}
	<td> лихва
		<tbody>
{foreach from=$INTELIST item=elem}
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> {$elem.d1}
	{include file="_sepa.tpl"}
<td> {$elem.d2}
	{include file="_sepa.tpl"}
<td> {$elem.days}
	{include file="_sepa.tpl"}
<td> {$elem.bnb}
	{include file="_sepa.tpl"}
<td> {$elem.zakono}
	{include file="_sepa.tpl"}
<td> {$elem.dnevna|tomoney:6}
	{include file="_sepa.tpl"}
<td> {$elem.result|tomoney:2}
{/foreach}
		</tbody>
		</table>
