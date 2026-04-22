{*----
	параметър : $ID 
	източник : case.tpl 
----*}
									{if $FLAGARCHIVE}
<td class='sep'>&nbsp;</td>
										{if empty($elem.archive)}
<td>
&nbsp;
										{else}
<td align=right>
<img src="images/archive.gif" class="arch" rel="#arch{$ID}" title="данни за архива" style="cursor:help;">
{*---- съдържание на данните за архива ----*}
<span id="arch{$ID}" style="display: none">
последна корекция от <b>{$elem.archive.username}</b>
<br>
на <b>{$elem.archive.time|date_format:"%d.%m.%Y %H:%M"}</b>
	<table align=center>
	<tr>
<td align=left>номер/дата <td> <b>{$elem.archive.serial}/{$elem.archive.date|date_format:"%d.%m.%Y"}</b>
	<tr>
<td align=left>връзка № <td> <b>{$elem.archive.packet}</b>
	<tr>
<td align=left>протокол <td> <b>{$elem.archive.protocol}</b>
	<tr>
<td align=left>документи <td> <b>{$elem.archive.documents}</b>
	<tr>
<td align=left>том/година <td> <b>{$elem.archive.volume}/{$elem.archive.year}</b>
	<tr>
<td align=left>забележка <td> <b>{$elem.archive.notes}</b>
	</table>
</span>
										{/if}
</td>
									{else}
									{/if}
