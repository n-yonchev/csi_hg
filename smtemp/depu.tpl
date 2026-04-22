<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>списък на деловодителите</td>
		</tr>
{*
		<tr>
			<td class='d_table_button' colspan='200'>
			{include file='_button.tpl' HREF="$ADDNEW" CLASS='nyroModal' TARGET='_blank' TITLE="добави"}
			</td>
		</tr>
*}
		</thead>
		<tr class='header'>
<td><span> име </span></td>
		<td class='sep'>&nbsp;</td>
<td><span> дела</span></td>
		<td class='sep'>&nbsp;</td>
<td>заместник</td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		</tr>
	<tbody>
		{foreach from=$USERLIST item=elem key=ekey}
		<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td> {$elem.name} </td>
		<td class='sep'>&nbsp;</td>
<td align=right> {$COUNLIST[$elem.id]}&nbsp; </td>
		<td class='sep'>&nbsp;</td>
<td> {$elem.namedepu}&nbsp; </td>
		<td class='sep'>&nbsp;</td>
<td class="none" align=center> 
				{if $elem.idconn==0}
{*
				{if $elem.idconn==0 and $COUNLIST[$elem.id]<>0}
					{if $elem.isnamedepu==0}
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
					{else}
<a href="{$elem.dele}" class="nyroModal" target="_blank"><img src="images/free.gif" title="прекрати"></a>
					{/if}
*}
					{if $elem.isnamedepu==0}
						{if $COUNLIST[$elem.id]==0}
						{else}
<a href="{$elem.edit}" class="nyroModal" target="_blank"><img src="images/makeeq.gif" title="определи заместник"></a>
						{/if}
					{else}
<a href="{$elem.dele}" class="nyroModal" target="_blank"><img src="images/restore.gif" title="прекрати заместването"></a>
					{/if}
				{else}
				{/if}
&nbsp;
</td>
		</tr>

		{/foreach}
	</tbody>
{*
	{include file="_pagina.tr.tpl"}
*}
</table>

