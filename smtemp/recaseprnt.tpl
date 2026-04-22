<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Регистър на заведените дела за 
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
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver" valign="middle"> изп.дело </td>
<td bgcolor="silver" valign="middle"> молба образуване </td>
<td bgcolor="silver" valign="middle"> дело източник </td>
<td bgcolor="silver" valign="middle"> име на ЧСИ </td>
<td bgcolor="silver" valign="middle"> № ЧСИ </td>
<td bgcolor="silver" valign="middle"> взискател </td>
<td bgcolor="silver" valign="middle"> длъжник </td>
<td bgcolor="silver" valign="middle"> вид и размер на вземането </td>
<td bgcolor="silver" valign="middle"> произход на вземането </td>
<td bgcolor="silver" width="100"> дата на спиране </td>
<td bgcolor="silver" width="100"> дата на възобновяване </td>
<td bgcolor="silver" width="100"> дата на свършване </td>
<td bgcolor="silver" width="100"> дата на прекратяване </td>
<td bgcolor="silver" width="100"> дата на изпращане </td>
	</tr>
		{foreach from=$LIST item=elem key=ekey}
	<tr>

<td align=left valign=top> {$elem.fullnumb}&nbsp;
<td align=left valign=top> 
	{if empty($elem.firstdocu.seri)}
&nbsp;
	{else}
{$elem.firstdocu.seri}/{$elem.firstdocu.year}-{$elem.firstdocu.crea|date_format:"%d.%m.%Y"} 
	{/if}
<td align=left valign=top> 
	{if empty($elem.conome) and empty($elem.coyear)}
&nbsp;
	{else}
{$ARSORT[$elem.idsort]} {$elem.conome}/{$elem.coyear} 
	{/if}
	{if empty($elem.idcofrom)}
&nbsp;
	{else}
{$ARFROM[$elem.idcofrom]}
	{/if}
<td align=left valign=top> {$ROOFFI.shortname}
<td align=left valign=top> {$ROOFFI.serial}
			{assign var=idcase value=$elem.id}
<td align=left valign=top> 
{include file="_recaseelem.tpl" DATALIST=$DATACLAI.$idcase}
<td align=left valign=top> 
{include file="_recaseelem.tpl" DATALIST=$DATADEBT.$idcase}
<td> {$elem.claimdescrip}
<td> {$ARCLAIORIG[$elem.idclaimorig]}
	{if empty($elem.statdate)}
	{else}
		{foreach from=$TXTRANSTAT item=txstat key=instat}
<td align=left valign=top> 
			{if $instat==$elem.statdate.indx}
{$elem.statdate.time|date_format:"%d.%m.%Y"}
			{else}
			{/if}
		{/foreach}
	{/if}

	</tr>
		{/foreach}
</table>
