<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>списък на годините</td>
	</tr>
</thead>

<tr class='header'>
	<td>година</td>
	<td class='sep'>&nbsp;</td>
	<td>докум.</td>
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

{foreach from=$LISTYEAR item=cuye}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> {$cuye}</td>
		<td class='sep'>&nbsp;</td>
		<td align=center {if $LIST.$cuye.coun==0}{else}bgcolor="#dddddd"{/if}> <b>{$LIST.$cuye.coun}</b> </td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	{if $LIST.$cuye.coun==0}
	{else}
<a href="{$LIST.$cuye.view}"><img src="images/view.png" title="виж документите"></a>
	{/if}
</td>
	</tr>
	{/foreach}
{*----
{include file="_pagina.tr.tpl"}
----*}
</table>



