<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='20'>списък на типовете вх.документи</td>
	</tr>
	<tr>
		<td class='d_table_button' colspan='20'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
		</td>
	</tr>
</thead>

<tr class='header'>
	<td>текст </td>	<td class='sep'>&nbsp;</td>
	<td>срок за<br />отговор </td>	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
	<td class='sep'>&nbsp;</td>
	<td>&nbsp;</td>
</tr>

{foreach from=$LIST item=elem key=ekey}
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
		<td> {$elem.name}</td>
		<td class='sep'>&nbsp;</td>
		<td align="center">{if $elem.deadline_days > 0} {$elem.deadline_days} дни{/if} </td>
		<td class='sep'>&nbsp;</td>
		<td align=center><a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
		<td class='sep'>&nbsp;</td>
	<td {if $elem.isassigned}class="issigreen"{/if} align=center><a href="{$elem.issi}" class="nyroModal" target="_blank" style="font-size: 9px">[ИССИ]</a></td>
	</tr>
	{/foreach}
{include file="_pagina.tr.tpl"}
</table>



