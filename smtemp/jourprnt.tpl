<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Дневник на извършените действия за 
				{if $FLPRIN}
	{if isset($DATE.date)}
		{if empty($DATE.date2)}
дата <b>{$DATE.date|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{else}
периода от <b>{$DATE.date|date_format:"%d.%m.%Y"}</b> до <b>{$DATE.date2|date_format:"%d.%m.%Y"}</b>
&nbsp;
		{/if}
	{else}
{$YEAR|cat:" год."}
	{/if}
				{else}
				{/if}
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> дата </td>
<td bgcolor="silver"> пор.№ </td>
<td bgcolor="silver" width=90> изп.дело </td>
<td bgcolor="silver"> описание </td>
<td bgcolor="silver"> задължено лице </td>
<td bgcolor="silver"> тип </td>
<td bgcolor="silver"> рег. </td>
	</tr>

{include file="_jour.tpl" PRIN=true}

</table>
