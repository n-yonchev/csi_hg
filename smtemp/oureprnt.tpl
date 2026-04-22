<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Изходящ регистър за 
				{if $FLPRIN}
	{if !empty($DATE.date)}
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
	{if empty($DATE.adre)}
	{else}
адресат=<b>{$DATE.adre}</b>
&nbsp;
	{/if}
	{if empty($DATE.bele)}
	{else}
бележки=<b>{$DATE.bele}</b>
&nbsp;
	{/if}
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> дата </td>
<td bgcolor="silver"> изх.номер </td>
<td bgcolor="silver" width=90> изп.дело </td>
<td bgcolor="silver"> адресат </td>
<td bgcolor="silver"> описание </td>
<td bgcolor="silver"> бележки </td>
	</tr>
		{foreach from=$LIST item=elem key=ekey}
	<tr>
<td valign="top" align="left"> {$elem.created|date_format:"%d.%m.%Y"} </td>
<td valign="top" align="left"> {$elem.serial}&nbsp; </td>
<td valign="top" align="left"> {$elem.caseseri}&nbsp;/{$elem.caseyear}</td>
<td valign="top" align="left"> {$elem.adresat}</td>
					{if $elem.isentered}
<td> {$elem.descrip}
					{else}
<td> {$elem.descriptype}
					{/if}
						{if $FLPRIN}
<td valign="top" align="left">
{$elem.notes|replace:";":"; "|replace:",":", "}
						{else}
						{/if}
	</tr>
		{/foreach}
</table>
