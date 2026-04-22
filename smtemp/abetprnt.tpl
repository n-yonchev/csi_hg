{*----
	източник : abet.tpl
----*}

	<table align="center">

	<tr>
<td colspan="5"><font size=+1><b>
АЗБУЧНИК ЗА {$YEAR} ГОД.
</font></b>
</td>
								{assign var=firstletter value=""}
		{foreach from=$LIST item=elem key=ekey}
								{if $elem.lett==$firstletter}
								{else}
{*----
	<tr style="page-break-before: always">
----*}
	<tr>
<td bgcolor="silver" colspan="5"><font size=+1><b>
имена с буква "{$elem.lett}"
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> име </td>
<td bgcolor="silver"> тип </td>
<td bgcolor="silver"> ЕГН/булстат </td>
<td bgcolor="silver"> адрес </td>
<td bgcolor="silver"> роля </td>
	</tr>
									{assign var=firstletter value=$elem.lett}
								{/if}
	<tr>	
<td valign=top> {$elem.text}
					{if $elem.type==1}
						{assign var=txtype value="юл"}
					{elseif $elem.type==2}
						{assign var=txtype value="фл"}
					{else}
						{assign var=txtype value="друго"}
					{/if}
<td valign=top> {$txtype}
<td valign=top> {$elem.iden} &nbsp;
{*------ адресите ----------------------*}
<td valign=top> 
					{if count($elem.addr)==0}
&nbsp;
					{else}
		{foreach from=$elem.addr item=elemaddr}
{$elemaddr}
<br>
		{/foreach}
					{/if}
{*------ ролите ----------------------*}
<td valign=top>
					{if count($elem.suit)==0}
&nbsp;
					{else}
		{foreach from=$elem.suit item=elemsuit}
{if $elemsuit.role==1}взиск.{else}длъжник{/if} {$elemsuit.seri}/{$elemsuit.year}
<br>
		{/foreach}
					{/if}
	</tr>
		{/foreach}

	</table>
