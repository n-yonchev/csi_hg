<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>списък на потребителите</td>
		</tr>
		<tr>
			<td class='d_table_button' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE="добави"}
			</td>
		</tr>
	</thead>
		<tr class='header'>
			<td><span> име </span></td>
			<td class='sep'>&nbsp;</td>
<td> активен </td>
			<td class='sep'>&nbsp;</td>
<td> email </td>
			<td class='sep'>&nbsp;</td>
<td> телефон </td>
			<td class='sep'>&nbsp;</td>
			<td align=center> 
		</tr>
	<tbody>
		{foreach from=$USERLIST item=elem key=ekey}
			<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
			<td> {$elem.name} </td>
			<td class='sep'>&nbsp;</td>
			<td align=center> 
					{if $elem.inactive==0}
				<a href="{$elem.inac}"><img src='css/checkbox_checked.gif' alt='' /></a>
					{else}
					<a href="{$elem.acti}"><img src='css/checkbox.gif' alt='' /></a>
					{/if}
			</td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.email} </td>
			<td class='sep'>&nbsp;</td>
<td> {$elem.phone} </td>
			<td class='sep'>&nbsp;</td>
			<td class="none" align=center> 
				<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
			</td>
			</tr>

		{/foreach}
	</tbody>
	{include file="_pagina.tr.tpl"}
</table>
