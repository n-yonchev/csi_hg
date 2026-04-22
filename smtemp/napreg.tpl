<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'>списък на клоновете на НАП</td>
	</tr>
	<tr>
<td class='d_table_button' colspan='200'>
{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE='добави' }
	</td>
	</tr>
</thead>
{*---- съдържание ----------------------*}

<tr class='header'>
<td>текст </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
</tr>

	{foreach from=$LIST item=elem key=ekey}
<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
<td> {$elem.name}</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="{$elem.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
</td>
	{/foreach}

</table>



