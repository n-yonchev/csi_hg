<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Входящ регистър за 
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
<td bgcolor="silver"> вх.номер </td>
<td bgcolor="silver" width=90> изп.дело </td>
<td bgcolor="silver"> подател </td>
<td bgcolor="silver"> описание </td>
<td bgcolor="silver"> бележки </td>
	</tr>
		{foreach from=$LIST item=elem key=ekey}
	<tr>
<td valign="top" align="left"> {$elem.created|date_format:"%d.%m.%Y"} </td>
<td valign="top" align="left"> {$elem.serial}&nbsp; </td>
<td valign="top" align="left">
						{*----
						{foreach from=$elem.caselist item=cuca}
							{$cuca}&nbsp;
						{/foreach}
						----*}
{$elem.caselist[0]}&nbsp;
	{if count($elem.caselist)>1}
...
	{else}
	{/if}
</td>
<td valign="top" align="left"> {$elem.from}</td>
<td valign="top" align="left"> {$elem.text}</td>
						{if $FLPRIN}
<td valign="top" align="left">
{$elem.notes|replace:";":"; "|replace:",":", "}
						{else}
						{/if}
	</tr>
		{/foreach}
</table>
