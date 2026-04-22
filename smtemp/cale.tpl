<br>
								<table align=center>
								<tr>
								<td>
											{if count($ARCOUN)==0}
<b class="bodyjq">няма въведени събития</b>
											{else}

		<div style="width:200px; height:400px; overflow-x:auto; overflow-y:auto;">
		<table class="d_table" cellspacing='0' cellpadding='0' align=right>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> избери месец </td>
		</tr>
		</thead>
		<tbody>
		<tr class='header'>
<td> месец </td>
		<td class='sep'>&nbsp;</td>
<td align=right> брой<br>съб </td>
		<tbody>
{foreach from=$ARMO item=elem key=mkey}
		<tr onmouseover='this.className="trhove";' onmouseout='this.className="";' style="cursor:pointer"
		onclick="$('#cont2').load('cale.ajax.php?m={$mkey}');">
<td> {$elem}
		<td class='sep'>&nbsp;</td>
<td align=right> {$ARCOUN.$mkey}
{/foreach}
		</tbody>
		</table>
		</div>
								<td width=20>
								<td id="cont2" valign=top>
{$LISTEVEN}
											{/if}
								</table>

