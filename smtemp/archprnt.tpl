<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Архивна книга за 
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
{*
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
*}
</b></font>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> арх.№ </td>
<td bgcolor="silver"> изп.дело </td>
<td bgcolor="silver"> дата на <br>архивиране </td>
<td bgcolor="silver"> връзка № </td>
<td bgcolor="silver"> протокол <br>№ и дата</td>
<td bgcolor="silver"> запазени<br>документи</td>
<td bgcolor="silver"> том <br>год.и №</td>
<td bgcolor="silver"> забележка </td>
	</tr>
		{foreach from=$LIST item=elem key=ekey}
								{if $elem.serial== -1}
								{else}
	<tr>
<td valign="top" align="right"> {$elem.serial}&nbsp; </td>
<td valign="top" align="left"> {$elem.caseseri}&nbsp;/{$elem.caseyear}</td>
<td valign="top" align="left"> {$elem.date|date_format:"%d.%m.%Y"} </td>
<td valign="top" align="left"> {$elem.packet}
						{assign var="protda" value=$elem.protdate|date_format:"%d.%m.%Y"}
<td valign="top" align="left"> {$elem.protocol|cat:"/"|cat:$protda}
<td valign="top" align="left"> {$elem.doculist|nl2br}
<td valign="top" align="left"> {$elem.volume}
<td valign="top" align="left">
{$elem.notes|replace:";":"; "|replace:",":", "}
&nbsp;
	</tr>
								{/if}
		{/foreach}
</table>
