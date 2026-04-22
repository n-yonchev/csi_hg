<table class="d_table" width='350px' cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>списък на потребителите</td>
	</tr>
</thead>

<tr class='header'>
	<td>име</td>
	<td class='sep'>&nbsp;</td>
	<td>докум.</td>
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

{foreach from=$LIST item=elem key=ekey}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> {$elem.name}</td>
		<td class='sep'>&nbsp;</td>
		<td align=center {if $elem.councase==0}{else}bgcolor="#dddddd"{/if}> <b>{$elem.councase}</b> </td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	{if $elem.councase==0}
	{else}
<a href="{$elem.view}"><img src="images/view.png" title="виж документите"></a>
	{/if}
</td>
	</tr>
	{/foreach}
{*----
{include file="_pagina.tr.tpl"}
----*}
</table>



