			<table class="d_table" cellspacing='0' cellpadding='0' align=center>
			<thead>
			<tr>
<td class='d_table_title' colspan='200'>събрани суми за ЧСИ по месеци
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		{if isset($NEXTMOYE)}
<a href="{$NEXTLINK}" style="font: bold 12pt verdana; color: red" title="следващи месеци"> &lt; </a>
		{else}
		{/if}
&nbsp;&nbsp;
<a href="{$PREVLINK}" style="font: bold 12pt verdana; color: red" title="предишни месеци"> &gt; </a>
					{if $FILTMOYE=="all"}
					{else}
<br>
<br>
<a style="font: normal 8pt verdana; color:black;">само делата със суми през месец <b>{$FILTMOYE}</b></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
{include file="_href.tpl" LINK=$LINKALL}> всички дела </a>
					{/if}
</td>
{*
			<tr>
<td class='d_table_button_center' colspan='200'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави'}
*}
			</thead>
			<tr class='header'>
<td> <b>общо</b> </td>
	{foreach from=$LISTMOYE item=elem}
			<td class='sep'>&nbsp;</td>
{*
<td align=right> <b>{$SUMOYE.$elem|tomo3}</b> </td>
*}
<td align=right>
		{if $FILTMOYE==$elem}
<a href="#" onclick="fuprin('collmoex.ajax.php?moye={$elem}');"><img src="images/excel.gif" title="изход Excel" border=0></a>
		{else}
		{/if}
<b>{$SUMOYE.$elem|tomo3}</b> 
</td>
	{/foreach}
{*
			<tr class='header'>
<td> </td>
	{foreach from=$LISTMOYE item=elem key=mkey}
			<td class='sep'>&nbsp;</td>
<td align=center>
<a href="#" onclick="fuprin('collmoex.ajax.php?moye={$elem}');"><img src="images/open.gif" title="изход Excel" border=0></a>
</td>
	{/foreach}
*}
			<tr class='header'>
<td> дело </td>
	{foreach from=$LISTMOYE item=elem key=mkey}
			<td class='sep'>&nbsp;</td>
<td align=right style="border-bottom: 1px solid {if $FILTMOYE==$elem}red{else}blue{/if}"> 
<a href="{$LISTMOYELINK.$mkey}"><b>{$elem}</b></a>
</td>
	{/foreach}
			<tbody>

	{foreach from=$LIST item=caseelem}
					{assign var=caseid value=$caseelem.id}
			<tr>
<td> {$caseelem.serial}/{$caseelem.year} </td>
		{foreach from=$LISTMOYE item=moye}
			<td class='sep'>&nbsp;</td>
<td align=right style="border:1px solid white;" 
onmouseover= "this.style.border='1px solid black';this.style.cursor='help';" onmouseout="this.style.border='1px solid white';"> 
<span class="suma" rel="collmo.ajax.php?caid={$caseid}&moye={$moye}" 
title="формиране на сумите за ЧСИ по дело {$caseelem.serial}/{$caseelem.year} от постъпленията през месец {$moye}"> 
{$GENEDATA.$caseid.$moye|tomo3}
</span>
		{/foreach}
	{/foreach}

			</tbody>
{include file="_pagina.tr.tpl"}
			</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {ldelim}
	$('.suma').cluetip({ldelim} width: 560 {rdelim});
{rdelim});
</script>
